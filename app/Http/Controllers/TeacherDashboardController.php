<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TeacherDashboardController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();

        $teacher = $user->teacher()->firstOrFail();

        $schedules = $teacher->schedules()
            ->with('classRoom.students')
            ->where('status', 'active')
            ->get();

        $classes = $schedules
            ->pluck('classRoom')
            ->filter()
            ->unique('id')
            ->values();

        $students = $classes
            ->flatMap(fn($classRoom) => $classRoom->students)
            ->unique('id')
            ->values();

        $today = strtolower(now()->format('l'));

        $todaySchedules = $schedules
            ->where('day', $today)
            ->sortBy('start_time')
            ->values();

        $todayScheduleIds = $todaySchedules->pluck('id');

        $todayAttendances = Attendance::whereIn('schedule_id', $todayScheduleIds)
            ->whereDate('date', today())
            ->get();

        $attendanceStats = [
            'total' => $todayAttendances->count(),
            'present' => $todayAttendances->where('status', 'present')->count(),
            'permission' => $todayAttendances->where('status', 'permission')->count(),
            'sick' => $todayAttendances->where('status', 'sick')->count(),
            'absent' => $todayAttendances->where('status', 'absent')->count(),
        ];

        $stats = [
            'students' => $students->count(),
            'classes' => $classes->count(),
            'schedules' => $schedules->count(),
            'todaySchedules' => $todaySchedules->count(),
        ];

        return view('teacher.dashboard', compact(
            'teacher',
            'stats',
            'todaySchedules',
            'attendanceStats'
        ));
    }
}