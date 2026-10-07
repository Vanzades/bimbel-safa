<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Schedule;
use App\Notifications\SystemNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherAttendanceController extends Controller
{
    public function index(Request $request)
    {
        $teacher = Auth::user()->teacher;

        $schedules = Schedule::with('classRoom')
            ->where('teacher_id', $teacher->id)
            ->orderBy('day')
            ->orderBy('start_time')
            ->get();

        $schedule = null;
        $attendances = collect();

        if ($request->filled('schedule_id')) {
            $schedule = $schedules->firstWhere('id', $request->schedule_id);

            if ($schedule) {
                $attendances = Attendance::with('student')
                    ->where('schedule_id', $schedule->id)
                    ->whereDate('date', $request->input('date', today()))
                    ->get()
                    ->keyBy('student_id');
            }
        }

        return view('teacher.attendance.index', compact('teacher', 'schedules', 'schedule', 'attendances'));
    }

    public function store(Request $request)
    {
        $teacher = Auth::user()->teacher;

        $validated = $request->validate([
            'schedule_id' => ['required', 'exists:schedules,id'],
            'date' => ['required', 'date'],
            'attendance' => ['required', 'array'],
            'attendance.*.status' => ['required', 'in:present,permission,sick,absent'],
            'attendance.*.notes' => ['nullable', 'string'],
        ]);

        $schedule = Schedule::with('classRoom.students')
            ->where('id', $validated['schedule_id'])
            ->where('teacher_id', $teacher->id)
            ->firstOrFail();

        $statusLabels = [
            'present' => 'Hadir',
            'permission' => 'Izin',
            'sick' => 'Sakit',
            'absent' => 'Alpa',
        ];

        foreach ($schedule->classRoom->students as $student) {
            if (!isset($validated['attendance'][$student->id])) {
                continue;
            }

            $attendanceInput = $validated['attendance'][$student->id];

            $attendance = Attendance::where([
                'student_id' => $student->id,
                'schedule_id' => $schedule->id,
                'date' => $validated['date'],
            ])->first();

            $oldStatus = $attendance?->status;
            $oldNotes = $attendance?->notes;

            $attendance = Attendance::updateOrCreate([
                'student_id' => $student->id,
                'schedule_id' => $schedule->id,
                'date' => $validated['date'],
            ], [
                'status' => $attendanceInput['status'],
                'notes' => $attendanceInput['notes'] ?? null,
            ]);

            $isNew = $oldStatus === null && $oldNotes === null;
            $isChanged = $oldStatus !== null && (
                $oldStatus !== $attendance->status ||
                $oldNotes !== $attendance->notes
            );

            if (($isNew || $isChanged) && $student->user_id) {
                $statusLabel = $statusLabels[$attendance->status] ?? $attendance->status;

                $message = 'Absensi kamu pada '
                    . $attendance->date->translatedFormat('d F Y')
                    . ' tercatat sebagai '
                    . $statusLabel
                    . '.';

                if ($attendance->notes) {
                    $message .= ' Catatan: ' . $attendance->notes;
                }

                $student->user->notify(
                    new SystemNotification(
                        'Absensi Diperbarui',
                        $message,
                        route('student.attendance'),
                        'info'
                    )
                );
            }
        }

        return redirect()
            ->route('teacher.attendance.index', [
                'schedule_id' => $schedule->id,
                'date' => $validated['date'],
            ])
            ->with('success', 'Absensi siswa berhasil disimpan.');
    }

    public function history(Request $request)
    {
        $teacher = Auth::user()->teacher;

        $schedules = Schedule::with('classRoom')
            ->where('teacher_id', $teacher->id)
            ->orderBy('day')
            ->orderBy('start_time')
            ->get();

        $query = Attendance::with([
            'student.classRoom',
            'schedule.classRoom',
        ])->whereHas('schedule', function ($query) use ($teacher) {
            $query->where('teacher_id', $teacher->id);
        });

        if ($request->filled('date')) {
            $query->whereDate('date', $request->date);
        }

        if ($request->filled('schedule_id')) {
            $query->where('schedule_id', $request->schedule_id);
        }

        $attendances = $query->orderByDesc('date')->orderBy('schedule_id')->get();

        return view('teacher.attendance.history', compact('teacher', 'schedules', 'attendances'));
    }

    public function recap(Request $request)
    {
        $teacher = Auth::user()->teacher;

        $schedules = Schedule::with('classRoom')
            ->where('teacher_id', $teacher->id)
            ->orderBy('day')
            ->orderBy('start_time')
            ->get();

        $startDate = $request->input('start_date', now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->input('end_date', now()->format('Y-m-d'));

        $query = Attendance::with([
            'student.classRoom',
            'schedule.classRoom',
        ])->whereHas('schedule', function ($query) use ($teacher) {
            $query->where('teacher_id', $teacher->id);
        })->whereBetween('date', [$startDate, $endDate]);

        if ($request->filled('schedule_id')) {
            $query->where('schedule_id', $request->schedule_id);
        }

        $attendances = $query->get();

        $recap = $attendances
            ->groupBy('student_id')
            ->map(function ($items) {
                $student = $items->first()->student;

                return [
                    'student' => $student,
                    'class_room' => $student->classRoom,
                    'present' => $items->where('status', 'present')->count(),
                    'permission' => $items->where('status', 'permission')->count(),
                    'sick' => $items->where('status', 'sick')->count(),
                    'absent' => $items->where('status', 'absent')->count(),
                    'total' => $items->count(),
                ];
            })
            ->sortBy(fn($item) => $item['student']->name)
            ->values();

        return view('teacher.attendance.recap', compact('teacher', 'schedules', 'recap', 'startDate', 'endDate'));
    }
}