<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ClassRoomController extends Controller
{
    public function index(Request $request)
    {
        $query = ClassRoom::withCount('students');

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $classRooms = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

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

        ClassRoom::create($validated);

        return redirect()
            ->route('admin.class-rooms.index')
            ->with('success', 'Data kelas berhasil ditambahkan.');
    }

    public function show(ClassRoom $classRoom)
    {
        $classRoom->load('students');

        return view('admin.class-rooms.show', compact('classRoom'));
    }

    public function edit(ClassRoom $classRoom)
    {
        return view('admin.class-rooms.edit', compact('classRoom'));
    }

    public function update(Request $request, ClassRoom $classRoom)
    {
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

        return redirect()
            ->route('admin.class-rooms.index')
            ->with('success', 'Data kelas berhasil diperbarui.');
    }

    public function destroy(ClassRoom $classRoom)
    {
        if ($classRoom->students()->exists()) {
            return redirect()
                ->route('admin.class-rooms.index')
                ->with('error', 'Kelas tidak dapat dihapus karena masih memiliki siswa.');
        }

        $classRoom->delete();

        return redirect()
            ->route('admin.class-rooms.index')
            ->with('success', 'Data kelas berhasil dihapus.');
    }
}