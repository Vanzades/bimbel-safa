<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::with('classRoom');

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

        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('class_room_id')) {
            $query->where('class_room_id', $request->class_room_id);
        }

        $students = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $classRooms = ClassRoom::orderBy('name')->get();

        return view('admin.students.index', compact('students', 'classRooms'));
    }

    public function create()
    {
        $classRooms = ClassRoom::where('status', 'active')
            ->orderBy('name')
            ->get();

        return view('admin.students.create', compact('classRooms'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'identity_number' => ['required', 'string', 'max:50', 'unique:students,identity_number'],
            'gender' => ['required', Rule::in(['male', 'female'])],
            'class_room_id' => ['required', 'exists:class_rooms,id'],
            'phone' => ['nullable', 'string', 'max:30'],
            'address' => ['nullable', 'string'],
            'status' => ['required', Rule::in(['active', 'inactive'])],
        ]);

        Student::create($validated);

        return redirect()
            ->route('admin.students.index')
            ->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function show(Student $student)
    {
        $student->load('classRoom');

        return view('admin.students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        $classRooms = ClassRoom::orderBy('name')->get();

        return view('admin.students.edit', compact('student', 'classRooms'));
    }

    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'identity_number' => [
                'required',
                'string',
                'max:50',
                Rule::unique('students', 'identity_number')->ignore($student->id),
            ],
            'gender' => ['required', Rule::in(['male', 'female'])],
            'class_room_id' => ['required', 'exists:class_rooms,id'],
            'phone' => ['nullable', 'string', 'max:30'],
            'address' => ['nullable', 'string'],
            'status' => ['required', Rule::in(['active', 'inactive'])],
        ]);

        $student->update($validated);

        return redirect()
            ->route('admin.students.index')
            ->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()
            ->route('admin.students.index')
            ->with('success', 'Data siswa berhasil dihapus.');
    }
}
