<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentAttendanceController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $student = $user->student()->firstOrFail();

        $query = Attendance::with('schedule.classRoom')
            ->where('student_id', $student->id);

        if ($request->filled('month')) {
            $query->whereMonth('date', $request->month);
        }

        if ($request->filled('year')) {
            $query->whereYear('date', $request->year);
        }

        $attendances = $query
            ->orderByDesc('date')
            ->orderByDesc('id')
            ->get();

        $stats = [
            'total' => $attendances->count(),
            'present' => $attendances->where('status', 'present')->count(),
            'permission' => $attendances->where('status', 'permission')->count(),
            'sick' => $attendances->where('status', 'sick')->count(),
            'absent' => $attendances->where('status', 'absent')->count(),
        ];

        $years = Attendance::where('student_id', $student->id)
            ->selectRaw('YEAR(date) as year')
            ->distinct()
            ->orderByDesc('year')
            ->pluck('year');

        return view('student.attendance', compact(
            'student',
            'attendances',
            'stats',
            'years'
        ));
    }
}