<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\Schedule;
use App\Models\Teacher;
use App\Notifications\SystemNotification;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $branchId = auth()->user()->branch_id;

        abort_if(!$branchId, 403, 'Akun admin belum terhubung dengan cabang.');

        $query = Schedule::with(['classRoom', 'teacher'])->whereHas('classRoom', function ($q) use ($branchId) {
            $q->where('branch_id', $branchId);
        });

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q
                    ->where('subject', 'like', "%{$search}%")
                    ->orWhere('room', 'like', "%{$search}%")
                    ->orWhereHas('teacher', function ($teacherQuery) use ($search) {
                        $teacherQuery->where('name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('classRoom', function ($classQuery) use ($search) {
                        $classQuery->where('name', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('day')) {
            $query->where('day', $request->day);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('class_room_id')) {
            $query->where('class_room_id', $request->class_room_id);
        }

        $schedules = $query
            ->orderByRaw("FIELD(day, 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday')")
            ->orderBy('start_time')
            ->paginate(10)
            ->withQueryString();

        $classRooms = ClassRoom::where('branch_id', $branchId)->orderBy('name')->get();

        return view('admin.schedules.index', compact('schedules', 'classRooms'));
    }

    public function create()
    {
        $branchId = auth()->user()->branch_id;

        abort_if(!$branchId, 403, 'Akun admin belum terhubung dengan cabang.');

        $classRooms = ClassRoom::where('branch_id', $branchId)->where('status', 'active')->orderBy('name')->get();

        $teachers = Teacher::where('branch_id', $branchId)->where('status', 'active')->orderBy('name')->get();

        return view('admin.schedules.create', compact('classRooms', 'teachers'));
    }

    public function store(Request $request)
    {
        $branchId = auth()->user()->branch_id;

        abort_if(!$branchId, 403, 'Akun admin belum terhubung dengan cabang.');

        $validated = $request->validate([
            'class_room_id' => [
                'required',
                Rule::exists('class_rooms', 'id')->where(fn($query) => $query->where('branch_id', $branchId)),
            ],
            'teacher_id' => [
                'required',
                Rule::exists('teachers', 'id')->where(fn($query) => $query->where('branch_id', $branchId)),
            ],
            'subject' => ['required', 'string', 'max:255'],
            'day' => [
                'required',
                Rule::in([
                    'monday',
                    'tuesday',
                    'wednesday',
                    'thursday',
                    'friday',
                    'saturday',
                ]),
            ],
            'start_time' => ['required', 'date_format:H:i'],
            'end_time' => ['required', 'date_format:H:i', 'after:start_time'],
            'room' => ['nullable', 'string', 'max:100'],
            'status' => ['required', Rule::in(['active', 'inactive'])],
        ]);

        $conflict = $this->findConflict($validated);

        if ($conflict) {
            return back()->withErrors([
                'start_time' => $conflict,
            ])->withInput();
        }

        $schedule = Schedule::create($validated);

        $schedule->load(['classRoom.students.user', 'teacher.user']);

        $teacher = $schedule->teacher;

        if ($teacher?->user) {
            $teacher->user->notify(
                new SystemNotification(
                    'Jadwal Baru Ditambahkan',
                    'Anda mendapatkan jadwal '
                    . $schedule->subject
                    . ' untuk kelas '
                    . ($schedule->classRoom?->name ?? '-')
                    . ' pada '
                    . $this->formatDay($schedule->day)
                    . ', pukul '
                    . substr($schedule->start_time, 0, 5)
                    . '–'
                    . substr($schedule->end_time, 0, 5)
                    . ($schedule->room ? ', ruang ' . $schedule->room : '')
                    . '.',
                    route('teacher.schedules'),
                    'info',
                ),
            );
        }

        foreach ($schedule->classRoom->students as $student) {
            if (!$student->user) {
                continue;
            }

            $student->user->notify(
                new SystemNotification(
                    'Jadwal Baru Ditambahkan',
                    'Jadwal '
                    . $schedule->subject
                    . ' untuk kelas '
                    . ($schedule->classRoom?->name ?? '-')
                    . ' telah ditambahkan pada '
                    . $this->formatDay($schedule->day)
                    . ', pukul '
                    . substr($schedule->start_time, 0, 5)
                    . '–'
                    . substr($schedule->end_time, 0, 5)
                    . ($schedule->room ? ', ruang ' . $schedule->room : '')
                    . '.',
                    route('student.dashboard'),
                    'info',
                ),
            );
        }

        return redirect()->route('admin.schedules.index')->with('success', 'Jadwal kelas berhasil ditambahkan.');
    }

    public function show(Schedule $schedule)
    {
        $this->ensureBranchAccess($schedule);

        $schedule->load(['classRoom', 'teacher']);

        return view('admin.schedules.show', compact('schedule'));
    }

    public function edit(Schedule $schedule)
    {
        $this->ensureBranchAccess($schedule);

        $branchId = auth()->user()->branch_id;

        $classRooms = ClassRoom::where('branch_id', $branchId)->orderBy('name')->get();

        $teachers = Teacher::where('branch_id', $branchId)->orderBy('name')->get();

        return view('admin.schedules.edit', compact('schedule', 'classRooms', 'teachers'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $this->ensureBranchAccess($schedule);

        $branchId = auth()->user()->branch_id;

        $validated = $request->validate([
            'class_room_id' => [
                'required',
                Rule::exists('class_rooms', 'id')->where(fn($query) => $query->where('branch_id', $branchId)),
            ],
            'teacher_id' => [
                'required',
                Rule::exists('teachers', 'id')->where(fn($query) => $query->where('branch_id', $branchId)),
            ],
            'subject' => ['required', 'string', 'max:255'],
            'day' => [
                'required',
                Rule::in([
                    'monday',
                    'tuesday',
                    'wednesday',
                    'thursday',
                    'friday',
                    'saturday',
                ]),
            ],
            'start_time' => ['required', 'date_format:H:i'],
            'end_time' => ['required', 'date_format:H:i', 'after:start_time'],
            'room' => ['nullable', 'string', 'max:100'],
            'status' => ['required', Rule::in(['active', 'inactive'])],
        ]);

        // Lanjutkan kode update lama mulai dari pemeriksaan findConflict().
    }

    public function destroy(Schedule $schedule)
    {
        $this->ensureBranchAccess($schedule);

        $schedule->delete();

        return redirect()->route('admin.schedules.index')->with('success', 'Jadwal kelas berhasil dihapus.');
    }

    private function ensureBranchAccess(Schedule $schedule): void
    {
        $branchId = auth()->user()->branch_id;

        abort_if(!$branchId || (int) $schedule->classRoom()->value('branch_id') !== (int) $branchId, 404);
    }

    private function findConflict(array $data, ?int $scheduleId = null): ?string
    {
        $query = Schedule::where('day', $data['day'])
            ->where('status', 'active')
            ->where('start_time', '<', $data['end_time'])
            ->where('end_time', '>', $data['start_time']);

        if ($scheduleId) {
            $query->where('id', '!=', $scheduleId);
        }

        $classConflict = (clone $query)->where('class_room_id', $data['class_room_id'])->exists();

        if ($classConflict) {
            return 'Jadwal kelas tersebut bentrok dengan jadwal lain pada hari dan waktu yang sama.';
        }

        $teacherConflict = $query->where('teacher_id', $data['teacher_id'])->exists();

        if ($teacherConflict) {
            return 'Guru tersebut sudah memiliki jadwal lain pada hari dan waktu yang sama.';
        }

        return null;
    }

    private function formatDay(string $day): string
    {
        return (
            [
                'monday' => 'Senin',
                'tuesday' => 'Selasa',
                'wednesday' => 'Rabu',
                'thursday' => 'Kamis',
                'friday' => 'Jumat',
                'saturday' => 'Sabtu',
            ][$day] ?? $day
        );
    }
}
