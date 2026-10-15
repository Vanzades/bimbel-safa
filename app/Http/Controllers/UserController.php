<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use App\Notifications\SystemNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();

        $query = User::with(['teacher', 'student', 'branch'])->where('role', '!=', 'super_admin');

        if ($user->isSuperAdmin()) {
            $view = 'super-admin.users.index';
        } else {
            $query->where('branch_id', $user->branch_id);
            $view = 'admin.users.index';
        }

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        if ($request->filled('branch_id') && $user->isSuperAdmin()) {
            $query->where('branch_id', $request->branch_id);
        }

        $users = $query->latest()->paginate(10)->withQueryString();

        if ($user->isSuperAdmin()) {
            $branches = Branch::where('is_active', true)->orderBy('name')->get();
        } else {
            $branches = collect();
        }

        return view($view, compact('users', 'branches'));
    }

    public function create(Request $request): View
    {
        $user = $request->user();

        if ($user->isSuperAdmin()) {
            $branches = Branch::where('is_active', true)->orderBy('name')->get();

            $teachers = Teacher::whereNull('user_id')
                ->where('status', 'active')
                ->with('branch')
                ->orderBy('name')
                ->get();

            $students = Student::whereNull('user_id')
                ->where('status', 'active')
                ->with('branch')
                ->orderBy('name')
                ->get();

            return view('super-admin.users.create', compact('branches', 'teachers', 'students'));
        }

        $teachers = Teacher::whereNull('user_id')
            ->where('status', 'active')
            ->where('branch_id', $user->branch_id)
            ->orderBy('name')
            ->get();

        $students = Student::whereNull('user_id')
            ->where('status', 'active')
            ->where('branch_id', $user->branch_id)
            ->orderBy('name')
            ->get();

        return view('admin.users.create', compact('teachers', 'students'));
    }

    public function store(Request $request): RedirectResponse
    {
        $authUser = $request->user();
        $isSuperAdmin = $authUser->isSuperAdmin();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', Rule::in(['admin', 'guru', 'siswa'])],
            'branch_id' => [
                $isSuperAdmin ? 'required' : 'nullable',
                'exists:branches,id',
            ],
            'teacher_id' => ['nullable', 'exists:teachers,id'],
            'student_id' => ['nullable', 'exists:students,id'],
        ]);

        $branchId = $isSuperAdmin ? $validated['branch_id'] : $authUser->branch_id;

        if (!$isSuperAdmin && !$branchId) {
            return back()->withErrors(['branch_id' => 'Akun administrator belum memiliki cabang.'])->withInput();
        }

        if ($validated['role'] === 'guru' && empty($validated['teacher_id'])) {
            return back()->withErrors(['teacher_id' => 'Pilih data guru untuk akun ini.'])->withInput();
        }

        if ($validated['role'] === 'siswa' && empty($validated['student_id'])) {
            return back()->withErrors(['student_id' => 'Pilih data siswa untuk akun ini.'])->withInput();
        }

        if ($validated['role'] === 'admin' && (!empty($validated['teacher_id']) || !empty($validated['student_id']))) {
            return back()->withErrors([
                'role' => 'Akun admin tidak dapat dihubungkan dengan data guru atau siswa.',
            ])->withInput();
        }

        if (!empty($validated['teacher_id'])) {
            $teacher = Teacher::findOrFail($validated['teacher_id']);

            if ($teacher->branch_id != $branchId) {
                return back()->withErrors([
                    'teacher_id' => 'Guru yang dipilih tidak berada di cabang tersebut.',
                ])->withInput();
            }

            if ($teacher->user_id) {
                return back()->withErrors([
                    'teacher_id' => 'Guru tersebut sudah memiliki akun.',
                ])->withInput();
            }
        }

        if (!empty($validated['student_id'])) {
            $student = Student::findOrFail($validated['student_id']);

            if ($student->branch_id != $branchId) {
                return back()->withErrors([
                    'student_id' => 'Siswa yang dipilih tidak berada di cabang tersebut.',
                ])->withInput();
            }

            if ($student->user_id) {
                return back()->withErrors([
                    'student_id' => 'Siswa tersebut sudah memiliki akun.',
                ])->withInput();
            }
        }

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'branch_id' => $branchId,
        ]);

        if (!empty($validated['teacher_id'])) {
            Teacher::whereKey($validated['teacher_id'])->update(['user_id' => $user->id]);
        }

        if (!empty($validated['student_id'])) {
            Student::whereKey($validated['student_id'])->update(['user_id' => $user->id]);
        }

        if ($user->isGuru()) {
            $user->notify(
                new SystemNotification(
                    'Akun Guru Dibuat',
                    'Akun guru Anda telah berhasil dibuat oleh administrator. Silakan login menggunakan email dan password yang telah diberikan.',
                    route('teacher.dashboard'),
                    'success',
                ),
            );
        }

        if ($user->isSiswa()) {
            $user->notify(
                new SystemNotification(
                    'Akun Siswa Dibuat',
                    'Akun siswa Anda telah berhasil dibuat oleh administrator. Silakan login menggunakan email dan password yang telah diberikan.',
                    route('student.dashboard'),
                    'success',
                ),
            );
        }

        $route = $isSuperAdmin ? 'super-admin.users.index' : 'admin.users.index';

        return redirect()->route($route)->with('success', 'Akun berhasil dibuat.');
    }

    public function show(Request $request, User $user): View
    {
        $this->authorizeUserAccess($request, $user);

        $user->load(['teacher', 'student', 'branch']);

        $view = $request->user()->isSuperAdmin() ? 'super-admin.users.show' : 'admin.users.show';

        return view($view, compact('user'));
    }

    public function edit(Request $request, User $user): View
    {
        $this->authorizeUserAccess($request, $user);

        $authUser = $request->user();

        if ($authUser->isSuperAdmin()) {
            $branches = Branch::where('is_active', true)->orderBy('name')->get();

            $teachers = Teacher::where(function ($query) use ($user) {
                $query->whereNull('user_id')->orWhere('user_id', $user->id);
            })->orderBy('name')->get();

            $students = Student::where(function ($query) use ($user) {
                $query->whereNull('user_id')->orWhere('user_id', $user->id);
            })->orderBy('name')->get();

            return view('super-admin.users.edit', compact('user', 'branches', 'teachers', 'students'));
        }

        $teachers = Teacher::where(function ($query) use ($user, $authUser) {
            $query->whereNull('user_id')->orWhere('user_id', $user->id);
        })
            ->where('branch_id', $authUser->branch_id)
            ->orderBy('name')
            ->get();

        $students = Student::where(function ($query) use ($user, $authUser) {
            $query->whereNull('user_id')->orWhere('user_id', $user->id);
        })
            ->where('branch_id', $authUser->branch_id)
            ->orderBy('name')
            ->get();

        return view('admin.users.edit', compact('user', 'teachers', 'students'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $this->authorizeUserAccess($request, $user);

        $authUser = $request->user();
        $isSuperAdmin = $authUser->isSuperAdmin();

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
            'branch_id' => [
                $isSuperAdmin ? 'required' : 'nullable',
                'exists:branches,id',
            ],
            'teacher_id' => ['nullable', 'exists:teachers,id'],
            'student_id' => ['nullable', 'exists:students,id'],
        ]);

        $branchId = $isSuperAdmin ? $validated['branch_id'] : $authUser->branch_id;

        if ($validated['role'] === 'guru' && empty($validated['teacher_id'])) {
            return back()->withErrors(['teacher_id' => 'Pilih data guru untuk akun ini.'])->withInput();
        }

        if ($validated['role'] === 'siswa' && empty($validated['student_id'])) {
            return back()->withErrors(['student_id' => 'Pilih data siswa untuk akun ini.'])->withInput();
        }

        if ($validated['role'] === 'admin' && (!empty($validated['teacher_id']) || !empty($validated['student_id']))) {
            return back()->withErrors([
                'role' => 'Akun admin tidak dapat dihubungkan dengan data guru atau siswa.',
            ])->withInput();
        }

        if (!empty($validated['teacher_id'])) {
            $teacher = Teacher::findOrFail($validated['teacher_id']);

            if ($teacher->branch_id != $branchId) {
                return back()->withErrors([
                    'teacher_id' => 'Guru yang dipilih tidak berada di cabang tersebut.',
                ])->withInput();
            }

            if ($teacher->user_id && $teacher->user_id !== $user->id) {
                return back()->withErrors([
                    'teacher_id' => 'Guru tersebut sudah memiliki akun lain.',
                ])->withInput();
            }
        }

        if (!empty($validated['student_id'])) {
            $student = Student::findOrFail($validated['student_id']);

            if ($student->branch_id != $branchId) {
                return back()->withErrors([
                    'student_id' => 'Siswa yang dipilih tidak berada di cabang tersebut.',
                ])->withInput();
            }

            if ($student->user_id && $student->user_id !== $user->id) {
                return back()->withErrors([
                    'student_id' => 'Siswa tersebut sudah memiliki akun lain.',
                ])->withInput();
            }
        }

        Teacher::where('user_id', $user->id)->update(['user_id' => null]);

        Student::where('user_id', $user->id)->update(['user_id' => null]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->role = $validated['role'];
        $user->branch_id = $branchId;

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        if (!empty($validated['teacher_id'])) {
            Teacher::whereKey($validated['teacher_id'])->update(['user_id' => $user->id]);
        }

        if (!empty($validated['student_id'])) {
            Student::whereKey($validated['student_id'])->update(['user_id' => $user->id]);
        }

        $route = $isSuperAdmin ? 'super-admin.users.index' : 'admin.users.index';

        return redirect()->route($route)->with('success', 'Akun berhasil diperbarui.');
    }

    public function resetPassword(Request $request, User $user): RedirectResponse
    {
        $this->authorizeUserAccess($request, $user);

        $validated = $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'password.required' => 'Password baru wajib diisi.',
            'password.min' => 'Password baru minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $user->password = Hash::make($validated['password']);
        $user->remember_token = null;
        $user->save();

        $route = $request->user()->isSuperAdmin() ? 'super-admin.users.show' : 'admin.users.show';

        return redirect()->route($route, $user)->with('success', 'Password akun berhasil diatur ulang.');
    }

    public function destroy(Request $request, User $user): RedirectResponse
    {
        $this->authorizeUserAccess($request, $user);

        if ($user->isSuperAdmin()) {
            abort(403);
        }

        if ($user->isAdmin() && !$request->user()->isSuperAdmin()) {
            return redirect()
                ->route('admin.users.index')
                ->with('error', 'Akun administrator tidak dapat dihapus melalui halaman ini.');
        }

        $route = $request->user()->isSuperAdmin() ? 'super-admin.users.index' : 'admin.users.index';

        $user->delete();

        return redirect()->route($route)->with('success', 'Akun berhasil dihapus.');
    }

    private function authorizeUserAccess(Request $request, User $user): void
    {
        $authUser = $request->user();

        if ($user->isSuperAdmin()) {
            abort(403);
        }

        if (!$authUser->isSuperAdmin() && $user->branch_id !== $authUser->branch_id) {
            abort(403);
        }
    }
}
