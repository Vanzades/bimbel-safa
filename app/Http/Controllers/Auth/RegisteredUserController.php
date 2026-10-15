<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\Schedule;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        $programs = Program::query()->where('status', 'active')->orderBy('name')->get();

        $schedules = Schedule::query()
            ->with(['classRoom.branch', 'classRoom.program'])
            ->where('status', 'active')
            ->orderByRaw("FIELD(day, 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday')")
            ->orderBy('start_time')
            ->get();

        return view('auth.register', compact('programs', 'schedules'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'in:male,female'],
            'birth_place' => ['required', 'string', 'max:255'],
            'birth_date' => ['required', 'date'],
            'address' => ['required', 'string'],
            'phone' => ['nullable', 'string', 'max:30'],
            'email' => ['required', 'email', 'max:255'],
            'parent_name' => ['required', 'string', 'max:255'],
            'parent_phone' => ['required', 'string', 'max:30'],
            'parent_address' => ['nullable', 'string'],
            'parent_occupation' => ['required', 'string', 'max:255'],
            'program_ids' => ['required', 'array', 'min:1'],
            'program_ids.*' => ['required', 'integer', 'distinct', 'exists:programs,id'],
            'schedule_ids' => ['required', 'array'],
            'previous_tutoring' => ['required', 'boolean'],
            'special_needs' => ['required', 'boolean'],
            'notes' => ['nullable', 'string'],
        ], [
            'program_ids.required' => 'Pilih minimal satu program.',
            'program_ids.min' => 'Pilih minimal satu program.',
            'program_ids.*.exists' => 'Program yang dipilih tidak valid.',
            'program_ids.*.distinct' => 'Program yang sama tidak boleh dipilih berulang.',
            'schedule_ids.required' => 'Pilih jadwal untuk setiap program.',
        ]);

        $programIds = array_values(array_unique(array_map('intval', $validated['program_ids'])));

        $activePrograms = Program::query()->whereIn('id', $programIds)->where('status', 'active')->get()->keyBy('id');

        if ($activePrograms->count() !== count($programIds)) {
            throw ValidationException::withMessages([
                'program_ids' => 'Salah satu program yang dipilih sudah tidak aktif atau tidak valid.',
            ]);
        }

        $scheduleInput = $validated['schedule_ids'];

        foreach ($programIds as $programId) {
            if (!isset($scheduleInput[$programId]) || $scheduleInput[$programId] === '') {
                throw ValidationException::withMessages([
                    "schedule_ids.$programId" => 'Pilih jadwal untuk program ini.',
                ]);
            }
        }

        $scheduleIds = [];

        foreach ($programIds as $programId) {
            $scheduleId = $scheduleInput[$programId];

            if (!is_scalar($scheduleId) || !ctype_digit((string) $scheduleId)) {
                throw ValidationException::withMessages([
                    "schedule_ids.$programId" => 'Jadwal yang dipilih tidak valid.',
                ]);
            }

            $scheduleIds[$programId] = (int) $scheduleId;
        }

        $schedules = Schedule::query()
            ->with(['classRoom.branch', 'classRoom.program'])
            ->whereIn('id', array_values($scheduleIds))
            ->where('status', 'active')
            ->get()
            ->keyBy('id');

        if ($schedules->count() !== count(array_unique($scheduleIds))) {
            throw ValidationException::withMessages([
                'schedule_ids' => 'Salah satu jadwal yang dipilih tidak tersedia.',
            ]);
        }

        $branchId = null;

        foreach ($scheduleIds as $programId => $scheduleId) {
            $schedule = $schedules->get($scheduleId);

            if (!$schedule->classRoom || (int) $schedule->classRoom->program_id !== (int) $programId) {
                throw ValidationException::withMessages([
                    "schedule_ids.$programId" => 'Jadwal harus sesuai dengan program yang dipilih.',
                ]);
            }

            $scheduleBranchId = (int) $schedule->classRoom->branch_id;

            if ($branchId !== null && $branchId !== $scheduleBranchId) {
                throw ValidationException::withMessages([
                    'schedule_ids' => 'Untuk pendaftaran ini, semua jadwal harus berasal dari cabang yang sama.',
                ]);
            }

            $branchId = $scheduleBranchId;
        }

        if (User::where('email', $validated['email'])->exists()) {
            return back()
                ->withInput()
                ->withErrors([
                    'email' => 'Email tersebut sudah terdaftar. Silakan gunakan email lain.',
                ]);
        }

        $pendingRegistration = Student::query()
            ->where('email', $validated['email'])
            ->where('registration_status', 'pending')
            ->exists();

        if ($pendingRegistration) {
            return back()
                ->withInput()
                ->withErrors([
                    'email' => 'Email tersebut sedang digunakan pada pendaftaran yang masih menunggu pemeriksaan.',
                ]);
        }

        DB::transaction(function () use ($validated, $programIds, $scheduleIds, $schedules, $branchId) {
            $firstProgramId = $programIds[0];
            $firstSchedule = $schedules->get($scheduleIds[$firstProgramId]);

            $student = Student::create([
                'user_id' => null,
                'branch_id' => $branchId,
                'class_room_id' => $firstSchedule->class_room_id,
                'program_id' => $firstProgramId,
                'name' => $validated['name'],
                'identity_number' => null,
                'gender' => $validated['gender'],
                'birth_place' => $validated['birth_place'],
                'birth_date' => $validated['birth_date'],
                'phone' => $validated['phone'] ?? null,
                'email' => $validated['email'],
                'address' => $validated['address'],
                'parent_name' => $validated['parent_name'],
                'parent_phone' => $validated['parent_phone'],
                'parent_address' => $validated['parent_address'] ?? null,
                'parent_occupation' => $validated['parent_occupation'],
                'previous_tutoring' => $validated['previous_tutoring'],
                'special_needs' => $validated['special_needs'],
                'notes' => $validated['notes'] ?? null,
                'status' => 'inactive',
                'registration_status' => 'pending',
            ]);

            $student->programs()->sync($programIds);
            $student->schedules()->sync(array_values($scheduleIds));
        });

        return redirect()->route('register.success');
    }
}
