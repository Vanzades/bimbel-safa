<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class TeacherController extends Controller
{
    public function index(Request $request): View
    {
        $authUser = $request->user();

        $query = Teacher::with(['branch', 'user']);

        if ($authUser->isSuperAdmin()) {
            $view = 'super-admin.teachers.index';
        } else {
            $query->where('branch_id', $authUser->branch_id);
            $view = 'admin.teachers.index';
        }

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('identity_number', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('branch_id') && $authUser->isSuperAdmin()) {
            $query->where('branch_id', $request->branch_id);
        }

        $teachers = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        if ($authUser->isSuperAdmin()) {
            $branches = Branch::orderBy('name')->get();
        } else {
            $branches = collect();
        }

        $baseQuery = Teacher::query();

        if (!$authUser->isSuperAdmin()) {
            $baseQuery->where('branch_id', $authUser->branch_id);
        }

        $totalTeachers = (clone $baseQuery)->count();
        $activeTeachers = (clone $baseQuery)->where('status', 'active')->count();
        $inactiveTeachers = (clone $baseQuery)->where('status', 'inactive')->count();
        $linkedTeachers = (clone $baseQuery)->whereNotNull('user_id')->count();

        return view($view, compact(
            'teachers',
            'branches',
            'totalTeachers',
            'activeTeachers',
            'inactiveTeachers',
            'linkedTeachers'
        ));
    }

    public function create(Request $request): View
    {
        $authUser = $request->user();

        if ($authUser->isSuperAdmin()) {
            $branches = Branch::where('is_active', true)
                ->orderBy('name')
                ->get();

            return view('super-admin.teachers.create', compact('branches'));
        }

        return view('admin.teachers.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $authUser = $request->user();
        $isSuperAdmin = $authUser->isSuperAdmin();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'identity_number' => ['nullable', 'string', 'max:100'],
            'gender' => ['required', Rule::in(['male', 'female'])],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:1000'],
            'status' => ['required', Rule::in(['active', 'inactive'])],
            'branch_id' => [
                $isSuperAdmin ? 'required' : 'nullable',
                'exists:branches,id',
            ],
        ]);

        if (!$isSuperAdmin) {
            $validated['branch_id'] = $authUser->branch_id;
        }

        if (!$validated['branch_id']) {
            return back()
                ->withErrors([
                    'branch_id' => 'Akun administrator belum memiliki cabang.',
                ])
                ->withInput();
        }

        Teacher::create($validated);

        $route = $isSuperAdmin
            ? 'super-admin.teachers.index'
            : 'admin.teachers.index';

        return redirect()
            ->route($route)
            ->with('success', 'Data guru berhasil ditambahkan.');
    }

    public function show(Request $request, Teacher $teacher): View
    {
        $this->authorizeTeacherAccess($request, $teacher);

        $teacher->load([
            'branch',
            'user',
            'schedules.classRoom',
        ]);

        $view = $request->user()->isSuperAdmin()
            ? 'super-admin.teachers.show'
            : 'admin.teachers.show';

        return view($view, compact('teacher'));
    }

    public function edit(Request $request, Teacher $teacher): View
    {
        $this->authorizeTeacherAccess($request, $teacher);

        $authUser = $request->user();

        if ($authUser->isSuperAdmin()) {
            $branches = Branch::where('is_active', true)
                ->orderBy('name')
                ->get();

            return view('super-admin.teachers.edit', compact(
                'teacher',
                'branches'
            ));
        }

        return view('admin.teachers.edit', compact('teacher'));
    }

    public function update(Request $request, Teacher $teacher): RedirectResponse
    {
        $this->authorizeTeacherAccess($request, $teacher);

        $authUser = $request->user();
        $isSuperAdmin = $authUser->isSuperAdmin();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'identity_number' => ['nullable', 'string', 'max:100'],
            'gender' => ['required', Rule::in(['male', 'female'])],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:1000'],
            'status' => ['required', Rule::in(['active', 'inactive'])],
            'branch_id' => [
                $isSuperAdmin ? 'required' : 'nullable',
                'exists:branches,id',
            ],
        ]);

        if (!$isSuperAdmin) {
            $validated['branch_id'] = $authUser->branch_id;
        }

        $teacher->update($validated);

        $route = $isSuperAdmin
            ? 'super-admin.teachers.index'
            : 'admin.teachers.index';

        return redirect()
            ->route($route)
            ->with('success', 'Data guru berhasil diperbarui.');
    }

    public function destroy(Request $request, Teacher $teacher): RedirectResponse
    {
        $this->authorizeTeacherAccess($request, $teacher);

        if ($teacher->schedules()->exists()) {
            return back()->with(
                'error',
                'Data guru tidak dapat dihapus karena masih memiliki jadwal.'
            );
        }

        if ($teacher->user) {
            $teacher->user()->delete();
        }

        $teacher->delete();

        $route = $request->user()->isSuperAdmin()
            ? 'super-admin.teachers.index'
            : 'admin.teachers.index';

        return redirect()
            ->route($route)
            ->with('success', 'Data guru berhasil dihapus.');
    }

    private function authorizeTeacherAccess(Request $request, Teacher $teacher): void
    {
        $authUser = $request->user();

        if (
            !$authUser->isSuperAdmin() &&
            $teacher->branch_id !== $authUser->branch_id
        ) {
            abort(403);
        }
    }
}