<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use App\Notifications\SystemNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with(['teacher', 'student']);

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        $users = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $teachers = Teacher::whereNull('user_id')
            ->where('status', 'active')
            ->orderBy('name')
            ->get();

        $students = Student::whereNull('user_id')
            ->where('status', 'active')
            ->orderBy('name')
            ->get();

        return view('admin.users.create', compact('teachers', 'students'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', Rule::in(['admin', 'guru', 'siswa'])],
            'teacher_id' => ['nullable', 'exists:teachers,id'],
            'student_id' => ['nullable', 'exists:students,id'],
        ]);

        if ($validated['role'] === 'guru' && empty($validated['teacher_id'])) {
            return back()
                ->withErrors(['teacher_id' => 'Pilih data guru untuk akun ini.'])
                ->withInput();
        }

        if ($validated['role'] === 'siswa' && empty($validated['student_id'])) {
            return back()
                ->withErrors(['student_id' => 'Pilih data siswa untuk akun ini.'])
                ->withInput();
        }

        if ($validated['role'] === 'admin' && (!empty($validated['teacher_id']) || !empty($validated['student_id']))) {
            return back()
                ->withErrors(['role' => 'Akun admin tidak dapat dihubungkan dengan data guru atau siswa.'])
                ->withInput();
        }

        if (!empty($validated['teacher_id'])) {
            $teacher = Teacher::findOrFail($validated['teacher_id']);

            if ($teacher->user_id) {
                return back()
                    ->withErrors(['teacher_id' => 'Guru tersebut sudah memiliki akun.'])
                    ->withInput();
            }
        }

        if (!empty($validated['student_id'])) {
            $student = Student::findOrFail($validated['student_id']);

            if ($student->user_id) {
                return back()
                    ->withErrors(['student_id' => 'Siswa tersebut sudah memiliki akun.'])
                    ->withInput();
            }
        }

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        if (!empty($validated['teacher_id'])) {
            Teacher::whereKey($validated['teacher_id'])
                ->update(['user_id' => $user->id]);
        }

        if (!empty($validated['student_id'])) {
            Student::whereKey($validated['student_id'])
                ->update(['user_id' => $user->id]);
        }

        if ($user->isGuru()) {
            $user->notify(
                new SystemNotification(
                    'Akun Guru Dibuat',
                    'Akun guru Anda telah berhasil dibuat oleh administrator. Silakan login menggunakan email dan password yang telah diberikan.',
                    route('teacher.dashboard'),
                    'success'
                )
            );
        }

        if ($user->isSiswa()) {
            $user->notify(
                new SystemNotification(
                    'Akun Siswa Dibuat',
                    'Akun siswa Anda telah berhasil dibuat oleh administrator. Silakan login menggunakan email dan password yang telah diberikan.',
                    route('student.dashboard'),
                    'success'
                )
            );
        }

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Akun berhasil dibuat.');
    }

    public function show(User $user)
    {
        $user->load(['teacher', 'student']);

        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $teachers = Teacher::where(function ($query) use ($user) {
            $query->whereNull('user_id')
                ->orWhere('user_id', $user->id);
        })
            ->orderBy('name')
            ->get();

        $students = Student::where(function ($query) use ($user) {
            $query->whereNull('user_id')
                ->orWhere('user_id', $user->id);
        })
            ->orderBy('name')
            ->get();

        return view('admin.users.edit', compact('user', 'teachers', 'students'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'role' => ['required', Rule::in(['admin', 'guru', 'siswa'])],
            'teacher_id' => ['nullable', 'exists:teachers,id'],
            'student_id' => ['nullable', 'exists:students,id'],
        ]);

        if ($validated['role'] === 'guru' && empty($validated['teacher_id'])) {
            return back()
                ->withErrors(['teacher_id' => 'Pilih data guru untuk akun ini.'])
                ->withInput();
        }

        if ($validated['role'] === 'siswa' && empty($validated['student_id'])) {
            return back()
                ->withErrors(['student_id' => 'Pilih data siswa untuk akun ini.'])
                ->withInput();
        }

        if ($validated['role'] === 'admin' && (!empty($validated['teacher_id']) || !empty($validated['student_id']))) {
            return back()
                ->withErrors(['role' => 'Akun admin tidak dapat dihubungkan dengan data guru atau siswa.'])
                ->withInput();
        }

        if (!empty($validated['teacher_id'])) {
            $teacher = Teacher::findOrFail($validated['teacher_id']);

            if ($teacher->user_id && $teacher->user_id !== $user->id) {
                return back()
                    ->withErrors(['teacher_id' => 'Guru tersebut sudah memiliki akun lain.'])
                    ->withInput();
            }
        }

        if (!empty($validated['student_id'])) {
            $student = Student::findOrFail($validated['student_id']);

            if ($student->user_id && $student->user_id !== $user->id) {
                return back()
                    ->withErrors(['student_id' => 'Siswa tersebut sudah memiliki akun lain.'])
                    ->withInput();
            }
        }

        Teacher::where('user_id', $user->id)->update(['user_id' => null]);
        Student::where('user_id', $user->id)->update(['user_id' => null]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->role = $validated['role'];

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        if (!empty($validated['teacher_id'])) {
            Teacher::whereKey($validated['teacher_id'])
                ->update(['user_id' => $user->id]);
        }

        if (!empty($validated['student_id'])) {
            Student::whereKey($validated['student_id'])
                ->update(['user_id' => $user->id]);
        }

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Akun berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        if ($user->isAdmin()) {
            return redirect()
                ->route('admin.users.index')
                ->with('error', 'Akun administrator tidak dapat dihapus melalui halaman ini.');
        }

        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Akun berhasil dihapus.');
    }
}