<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\ClassRoom;
use App\Models\Program;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function index(Request $request): View
    {
        $authUser = $request->user();

        $query = Student::with([
            'branch',
            'classRoom',
            'program',
            'user',
            'schedules',
        ])->where('registration_status', 'approved');

        if ($authUser->isSuperAdmin()) {
            if ($request->filled('branch_id')) {
                $query->where('branch_id', $request->branch_id);
            }
        } else {
            $query->where('branch_id', $authUser->branch_id);
        }

        if ($request->filled('search')) {
            $search = trim($request->search);

            $query->where(function ($q) use ($search) {
                $q
                    ->where('name', 'like', "%{$search}%")
                    ->orWhere('identity_number', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('parent_name', 'like', "%{$search}%")
                    ->orWhere('parent_phone', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('class_room_id')) {
            $query->where('class_room_id', $request->class_room_id);
        }

        if ($request->filled('program_id')) {
            $query->where('program_id', $request->program_id);
        }

        $students = $query->latest()->paginate(10)->withQueryString();

        if ($authUser->isSuperAdmin()) {
            $branches = Branch::orderBy('name')->get();

            $classRooms = ClassRoom::with('branch')->orderBy('name')->get();

            $view = 'super-admin.students.index';
        } else {
            $branches = collect();

            $classRooms = ClassRoom::where('branch_id', $authUser->branch_id)->orderBy('name')->get();

            $view = 'admin.students.index';
        }

        $programs = Program::orderBy('name')->get();

        $statsQuery = Student::where('registration_status', 'approved');

        if (!$authUser->isSuperAdmin()) {
            $statsQuery->where('branch_id', $authUser->branch_id);
        }

        $totalStudents = (clone $statsQuery)->count();
        $activeStudents = (clone $statsQuery)->where('status', 'active')->count();
        $inactiveStudents = (clone $statsQuery)->where('status', 'inactive')->count();
        $linkedStudents = (clone $statsQuery)->whereNotNull('user_id')->count();

        return view($view, compact(
            'students',
            'branches',
            'classRooms',
            'programs',
            'totalStudents',
            'activeStudents',
            'inactiveStudents',
            'linkedStudents',
        ));
    }

    public function create(Request $request): View
    {
        $authUser = $request->user();

        if ($authUser->isSuperAdmin()) {
            $branches = Branch::where('is_active', true)->orderBy('name')->get();

            $classRooms = ClassRoom::with('branch')
                ->whereHas('branch', function ($query) {
                    $query->where('is_active', true);
                })
                ->orderBy('name')
                ->get();

            return view('super-admin.students.create', compact('branches', 'classRooms'));
        }

        $branches = collect();

        $classRooms = ClassRoom::where('branch_id', $authUser->branch_id)->orderBy('name')->get();

        return view('admin.students.create', compact('branches', 'classRooms'));
    }

    public function store(Request $request): RedirectResponse
    {
        $authUser = $request->user();

        $validated = $request->validate([
            'branch_id' => [
                $authUser->isSuperAdmin() ? 'required' : 'nullable',
                'exists:branches,id',
            ],
            'class_room_id' => [
                'required',
                'exists:class_rooms,id',
            ],
            'name' => ['required', 'string', 'max:255'],
            'identity_number' => ['nullable', 'string', 'max:50'],
            'gender' => ['required', 'in:male,female'],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:1000'],
            'status' => ['required', 'in:active,inactive'],
        ], [
            'branch_id.required' => 'Cabang wajib dipilih.',
            'branch_id.exists' => 'Cabang yang dipilih tidak valid.',
            'class_room_id.required' => 'Kelas wajib dipilih.',
            'class_room_id.exists' => 'Kelas yang dipilih tidak valid.',
            'name.required' => 'Nama lengkap wajib diisi.',
            'name.max' => 'Nama lengkap maksimal 255 karakter.',
            'identity_number.max' => 'Nomor identitas maksimal 50 karakter.',
            'gender.required' => 'Jenis kelamin wajib dipilih.',
            'gender.in' => 'Jenis kelamin tidak valid.',
            'phone.max' => 'Nomor telepon maksimal 20 karakter.',
            'address.max' => 'Alamat maksimal 1000 karakter.',
            'status.required' => 'Status wajib dipilih.',
            'status.in' => 'Status tidak valid.',
        ]);

        if (!$authUser->isSuperAdmin()) {
            $validated['branch_id'] = $authUser->branch_id;
        }

        $classRoom = ClassRoom::findOrFail($validated['class_room_id']);

        if ((int) $classRoom->branch_id !== (int) $validated['branch_id']) {
            return back()
                ->withInput()
                ->withErrors([
                    'class_room_id' => 'Kelas harus berasal dari cabang yang dipilih.',
                ]);
        }

        $validated['registration_status'] = 'approved';

        Student::create($validated);

        $redirectRoute = $authUser->isSuperAdmin() ? 'super-admin.students.index' : 'admin.students.index';

        return redirect()->route($redirectRoute)->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function show(Request $request, Student $student): View
    {
        $authUser = $request->user();

        $this->authorizeStudentAccess($authUser, $student);

        $student->load([
            'branch',
            'classRoom',
            'program',
            'user',
            'attendances.schedule',
        ]);

        $view = $authUser->isSuperAdmin() ? 'super-admin.students.show' : 'admin.students.show';

        return view($view, compact('student'));
    }

    public function edit(Student $student): View
    {
        $student->load([
            'branch',
            'classRoom',
            'program',
        ]);

        return view('super-admin.students.edit', [
            'student' => $student,
            'branches' => Branch::where('is_active', true)->orderBy('name')->get(),
            'classRooms' => ClassRoom::whereHas('branch', function ($query) {
                $query->where('is_active', true);
            })
                ->with('branch')
                ->orderBy('name')
                ->get(),
            'programs' => Program::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Student $student): RedirectResponse
    {
        $authUser = $request->user();

        $this->authorizeStudentAccess($authUser, $student);

        $validated = $request->validate([
            'branch_id' => [
                $authUser->isSuperAdmin() ? 'required' : 'nullable',
                'exists:branches,id',
            ],
            'class_room_id' => [
                'required',
                'exists:class_rooms,id',
            ],
            'name' => ['required', 'string', 'max:255'],
            'identity_number' => ['nullable', 'string', 'max:50'],
            'gender' => ['required', 'in:male,female'],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:1000'],
            'status' => ['required', 'in:active,inactive'],
        ], [
            'branch_id.required' => 'Cabang wajib dipilih.',
            'branch_id.exists' => 'Cabang yang dipilih tidak valid.',
            'class_room_id.required' => 'Kelas wajib dipilih.',
            'class_room_id.exists' => 'Kelas yang dipilih tidak valid.',
            'name.required' => 'Nama lengkap wajib diisi.',
            'name.max' => 'Nama lengkap maksimal 255 karakter.',
            'identity_number.max' => 'Nomor identitas maksimal 50 karakter.',
            'gender.required' => 'Jenis kelamin wajib dipilih.',
            'gender.in' => 'Jenis kelamin tidak valid.',
            'phone.max' => 'Nomor telepon maksimal 20 karakter.',
            'address.max' => 'Alamat maksimal 1000 karakter.',
            'status.required' => 'Status wajib dipilih.',
            'status.in' => 'Status tidak valid.',
        ]);

        if (!$authUser->isSuperAdmin()) {
            $validated['branch_id'] = $authUser->branch_id;
        }

        $classRoom = ClassRoom::findOrFail($validated['class_room_id']);

        if ((int) $classRoom->branch_id !== (int) $validated['branch_id']) {
            return back()
                ->withInput()
                ->withErrors([
                    'class_room_id' => 'Kelas harus berasal dari cabang yang dipilih.',
                ]);
        }

        $student->update($validated);

        $redirectRoute = $authUser->isSuperAdmin() ? 'super-admin.students.index' : 'admin.students.index';

        return redirect()->route($redirectRoute)->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function sendCredentialsWhatsapp(Request $request, Student $student): RedirectResponse
    {
        $admin = $request->user();

        abort_unless(
            $admin
            && $admin->isAdmin()
            && (int) $student->branch_id === (int) $admin->branch_id
            && $student->registration_status === 'approved'
            && $student->user_id,
            403,
        );

        $validated = $request->validate([
            'password' => [
                'required',
                'string',
                'min:10',
                'max:72',
                'confirmed',
            ],
        ], [
            'password.required' => 'Password awal wajib diisi.',
            'password.min' => 'Password minimal 10 karakter.',
            'password.max' => 'Password maksimal 72 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $student->load([
            'user',
            'program',
            'classRoom',
            'branch',
        ]);

        if (!$student->user || !$student->user->email) {
            return back()->withErrors([
                'account' => 'Akun siswa belum tersedia atau belum memiliki email.',
            ]);
        }

        $phone = $student->parent_phone ?: $student->phone;

        if (!$phone) {
            return back()->withErrors([
                'phone' => 'Nomor WhatsApp siswa atau orang tua belum tersedia.',
            ]);
        }

        $phone = preg_replace('/\D+/', '', $phone);

        if (str_starts_with($phone, '0')) {
            $phone = '62' . substr($phone, 1);
        } elseif (str_starts_with($phone, '8')) {
            $phone = '62' . $phone;
        }

        if (!preg_match('/^62\d{8,13}$/', $phone)) {
            return back()->withErrors([
                'phone' => 'Format nomor WhatsApp tidak valid. Periksa nomor siswa atau orang tua.',
            ]);
        }

        $student
            ->user
            ->forceFill([
                'password' => Hash::make($validated['password']),
            ])
            ->save();

        $message = implode("\n", [
            'Assalamu’alaikum Warahmatullahi Wabarakatuh.',
            '',
            'Yth. Bapak/Ibu Wali Siswa,',
            '',
            'Pendaftaran siswa di Bimbel Safa telah disetujui.',
            '',
            'Berikut informasi akun siswa:',
            'Nama: ' . $student->name,
            'Email: ' . $student->user->email,
            'Password awal: ' . $validated['password'],
            'Program: ' . ($student->program?->name ?? '-'),
            'Kelas: ' . ($student->classRoom?->name ?? '-'),
            'Cabang: ' . ($student->branch?->name ?? '-'),
            '',
            'Silakan login menggunakan email dan password awal tersebut.',
            'Demi keamanan, segera ganti password setelah berhasil login dan jangan membagikannya kepada orang lain.',
            '',
            'Terima kasih atas kepercayaan Bapak/Ibu kepada Bimbel Safa.',
            '',
            'Wassalamu’alaikum Warahmatullahi Wabarakatuh.',
            'Hormat kami,',
            'Admin Bimbel Safa',
        ]);

        $whatsappUrl = 'https://wa.me/' . $phone . '?text=' . urlencode($message);

        return redirect()->away($whatsappUrl);
    }

    public function destroy(Request $request, Student $student): RedirectResponse
    {
        $authUser = $request->user();

        $this->authorizeStudentAccess($authUser, $student);

        if ($student->attendances()->exists()) {
            return back()->with('error', 'Siswa tidak dapat dihapus karena sudah memiliki riwayat absensi.');
        }

        if ($student->user) {
            $student->user->delete();
        }

        $student->delete();

        $redirectRoute = $authUser->isSuperAdmin() ? 'super-admin.students.index' : 'admin.students.index';

        return redirect()->route($redirectRoute)->with('success', 'Data siswa berhasil dihapus.');
    }

    private function authorizeStudentAccess($authUser, Student $student): void
    {
        if ($authUser->isSuperAdmin()) {
            return;
        }

        if ((int) $student->branch_id !== (int) $authUser->branch_id) {
            abort(403);
        }

        if ($student->registration_status !== 'approved') {
            abort(404);
        }
    }
}
