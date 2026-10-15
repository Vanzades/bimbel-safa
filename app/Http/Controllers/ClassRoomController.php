<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\ClassRoom;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ClassRoomController extends Controller
{
    private function isSuperAdmin(): bool
    {
        return auth()->user()->role === 'super_admin';
    }

    private function ensureBranchAccess(ClassRoom $classRoom): void
    {
        if (!$this->isSuperAdmin() && (int) $classRoom->branch_id !== (int) auth()->user()->branch_id) {
            abort(404);
        }
    }

    public function index(Request $request)
    {
        $query = ClassRoom::withCount('students');

        if (!$this->isSuperAdmin()) {
            $query->where('branch_id', auth()->user()->branch_id);
        }

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")->orWhere('code', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $classRooms = $query->latest()->paginate(10)->withQueryString();

        return view('admin.class-rooms.index', compact('classRooms'));
    }

    public function create()
    {
        return view('admin.class-rooms.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:50', 'unique:class_rooms,code'],
            'description' => ['nullable', 'string'],
            'status' => ['required', Rule::in(['active', 'inactive'])],
        ]);

        $validated['branch_id'] = $this->isSuperAdmin()
            ? $request->validate([
                'branch_id' => ['required', 'exists:branches,id'],
            ])['branch_id']
            : auth()->user()->branch_id;

        ClassRoom::create($validated);

        return redirect()->route('admin.class-rooms.index')->with('success', 'Data kelas berhasil ditambahkan.');
    }

    public function show(ClassRoom $classRoom)
    {
        $this->ensureBranchAccess($classRoom);

        $classRoom->load('students');

        return view('admin.class-rooms.show', compact('classRoom'));
    }

    public function edit(ClassRoom $classRoom)
    {
        $this->ensureBranchAccess($classRoom);

        return view('admin.class-rooms.edit', compact('classRoom'));
    }

    public function update(Request $request, ClassRoom $classRoom)
    {
        $this->ensureBranchAccess($classRoom);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'code' => [
                'required',
                'string',
                'max:50',
                Rule::unique('class_rooms', 'code')->ignore($classRoom->id),
            ],
            'description' => ['nullable', 'string'],
            'status' => ['required', Rule::in(['active', 'inactive'])],
        ]);

        $classRoom->update($validated);

        return redirect()->route('admin.class-rooms.index')->with('success', 'Data kelas berhasil diperbarui.');
    }

    public function destroy(ClassRoom $classRoom)
    {
        $this->ensureBranchAccess($classRoom);

        if ($classRoom->students()->exists()) {
            return redirect()
                ->route('admin.class-rooms.index')
                ->with('error', 'Kelas tidak dapat dihapus karena masih memiliki siswa.');
        }

        $classRoom->delete();

        return redirect()->route('admin.class-rooms.index')->with('success', 'Data kelas berhasil dihapus.');
    }

    public function superAdminIndex(Request $request): View
    {
        $query = ClassRoom::with('branch')->withCount('students', 'schedules');

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($classQuery) use ($search) {
                $classQuery->where('name', 'like', "%{$search}%")->orWhere('code', 'like', "%{$search}%");
            });
        }

        if ($request->filled('branch_id')) {
            $query->where('branch_id', $request->branch_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $classRooms = $query->latest()->paginate(10)->withQueryString();

        $branches = Branch::orderBy('name')->get();

        $totalClasses = ClassRoom::count();
        $activeClasses = ClassRoom::where('status', 'active')->count();
        $inactiveClasses = ClassRoom::where('status', 'inactive')->count();
        $totalStudents = Student::count();

        return view('super-admin.class-rooms.index', compact(
            'classRooms',
            'branches',
            'totalClasses',
            'activeClasses',
            'inactiveClasses',
            'totalStudents',
        ));
    }
}
