<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\View\View;

class StudentRegistrationController extends Controller
{
    public function index(Request $request): View
    {
        $query = Student::query()
            ->with(['program', 'classRoom', 'branch', 'schedules'])
            ->where('registration_status', 'pending')
            ->where('branch_id', $request->user()->branch_id);

        if ($request->filled('search')) {
            $search = trim($request->search);

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('parent_name', 'like', "%{$search}%")
                    ->orWhere('parent_phone', 'like', "%{$search}%");
            });
        }

        $registrations = $query->latest()->paginate(10)->withQueryString();

        return view('admin.student-registrations.index', compact('registrations'));
    }

    public function show(Student $student): View
    {
        $this->authorizeBranch($student);

        $student->load([
            'program',
            'classRoom',
            'branch',
            'schedules.teacher',
            'user',
        ]);

        return view('admin.student-registrations.show', compact('student'));
    }

    public function approve(Student $student): RedirectResponse
    {
        $this->authorizeRegistration($student);

        if (!$student->email) {
            return redirect()
                ->route('admin.student-registrations.show', $student)
                ->withErrors([
                    'email' => 'Email siswa belum tersedia. Akun belum dapat dibuat.',
                ]);
        }

        if ($student->user_id || User::where('email', $student->email)->exists()) {
            return redirect()
                ->route('admin.student-registrations.show', $student)
                ->withErrors([
                    'email' => 'Email sudah terhubung dengan akun lain atau siswa sudah memiliki akun.',
                ]);
        }

        DB::transaction(function () use ($student) {
            $user = User::create([
                'name' => $student->name,
                'email' => $student->email,
                'password' => Hash::make(Str::random(64)),
                'role' => 'siswa',
                'status' => 'active',
                'branch_id' => $student->branch_id,
            ]);

            $student->update([
                'user_id' => $user->id,
                'registration_status' => 'approved',
                'status' => 'active',
            ]);
        });

        return redirect()
            ->route('admin.student-registrations.show', $student)
            ->with('success', 'Pendaftaran berhasil disetujui. Silakan gunakan tombol Kirim WhatsApp untuk mengirim informasi akun kepada siswa atau wali.');
    }

    public function reject(Request $request, Student $student): RedirectResponse
    {
        $this->authorizeRegistration($student);

        $validated = $request->validate([
            'rejection_reason' => ['nullable', 'string', 'max:1000'],
        ]);

        DB::transaction(function () use ($student, $validated) {
            $student->update([
                'registration_status' => 'rejected',
                'status' => 'inactive',
                'notes' => $validated['rejection_reason'] ?? $student->notes,
            ]);
        });

        return redirect()
            ->route('admin.student-registrations.index')
            ->with('success', 'Pendaftaran siswa berhasil ditolak.');
    }

    public function whatsapp(Student $student): RedirectResponse
    {
        $this->authorizeBranch($student);

        abort_unless(
            $student->registration_status === 'approved' && $student->user_id,
            403,
        );

        $student->load('user');

        if (!$student->user || !$student->user->email) {
            return redirect()
                ->route('admin.student-registrations.show', $student)
                ->withErrors([
                    'email' => 'Data akun siswa belum lengkap.',
                ]);
        }

        $phone = $student->parent_phone ?: $student->phone;

        if (!$phone) {
            return redirect()
                ->route('admin.student-registrations.show', $student)
                ->withErrors([
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
            return redirect()
                ->route('admin.student-registrations.show', $student)
                ->withErrors([
                    'phone' => 'Format nomor WhatsApp tidak valid. Periksa nomor siswa atau orang tua.',
                ]);
        }

        $token = Password::broker()->createToken($student->user);

        $resetUrl = route('password.reset', [
            'token' => $token,
            'email' => $student->user->email,
        ]);

        $message = implode("\n", [
            'Assalamu’alaikum Warahmatullahi Wabarakatuh.',
            '',
            'Yth. Bapak/Ibu Wali Siswa,',
            '',
            'Kami informasikan bahwa pendaftaran siswa di Bimbel Safa telah disetujui.',
            '',
            'Informasi akun siswa:',
            'Nama: ' . $student->name,
            'Email akun: ' . $student->user->email,
            'Program: ' . ($student->program?->name ?? 'Sesuai data pendaftaran'),
            'Kelas: ' . ($student->classRoom?->name ?? 'Sesuai penetapan admin'),
            'Cabang: ' . ($student->branch?->name ?? 'Bimbel Safa'),
            '',
            'Untuk mulai menggunakan akun, silakan buat kata sandi pribadi melalui tautan berikut:',
            $resetUrl,
            '',
            'Demi keamanan, jangan membagikan tautan ini kepada siapa pun. Bimbel Safa tidak akan meminta kata sandi Anda melalui WhatsApp.',
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

    private function authorizeBranch(Student $student): void
    {
        $user = auth()->user();

        abort_unless(
            $user
            && $user->isAdmin()
            && (int) $student->branch_id === (int) $user->branch_id,
            403,
        );
    }

    private function authorizeRegistration(Student $student): void
    {
        $this->authorizeBranch($student);

        abort_unless($student->registration_status === 'pending', 403);
    }
}