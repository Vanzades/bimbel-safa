<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Teacher;
use App\Models\TeacherAttendance;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TeacherAttendanceReportController extends Controller
{
    public function index(Request $request): View
    {
        $query = TeacherAttendance::with([
            'teacher',
            'branch',
        ]);

        if ($request->filled('branch_id')) {
            $query->where('branch_id', $request->branch_id);
        }

        if ($request->filled('teacher_id')) {
            $query->where('teacher_id', $request->teacher_id);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('date', '<=', $request->date_to);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $attendances = $query
            ->latest('date')
            ->latest('id')
            ->paginate(15)
            ->withQueryString();

        $summaryQuery = TeacherAttendance::query();

        if ($request->filled('branch_id')) {
            $summaryQuery->where('branch_id', $request->branch_id);
        }

        if ($request->filled('teacher_id')) {
            $summaryQuery->where('teacher_id', $request->teacher_id);
        }

        if ($request->filled('date_from')) {
            $summaryQuery->whereDate('date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $summaryQuery->whereDate('date', '<=', $request->date_to);
        }

        $totalAttendance = (clone $summaryQuery)->count();

        $presentCount = (clone $summaryQuery)
            ->where('status', 'present')
            ->count();

        $permissionCount = (clone $summaryQuery)
            ->where('status', 'permission')
            ->count();

        $sickCount = (clone $summaryQuery)
            ->where('status', 'sick')
            ->count();

        $absentCount = (clone $summaryQuery)
            ->where('status', 'absent')
            ->count();

        $branches = Branch::orderBy('name')->get();

        $teachers = Teacher::with('branch')
            ->orderBy('name')
            ->get();

        $teacherRecaps = TeacherAttendance::with([
            'teacher',
            'branch',
        ])
            ->when($request->filled('branch_id'), function ($query) use ($request) {
                $query->where('branch_id', $request->branch_id);
            })
            ->when($request->filled('teacher_id'), function ($query) use ($request) {
                $query->where('teacher_id', $request->teacher_id);
            })
            ->when($request->filled('date_from'), function ($query) use ($request) {
                $query->whereDate('date', '>=', $request->date_from);
            })
            ->when($request->filled('date_to'), function ($query) use ($request) {
                $query->whereDate('date', '<=', $request->date_to);
            })
            ->get()
            ->groupBy('teacher_id')
            ->map(function ($items) {
                $teacher = $items->first()->teacher;

                return [
                    'teacher' => $teacher,
                    'branch' => $items->first()->branch,
                    'total' => $items->count(),
                    'present' => $items->where('status', 'present')->count(),
                    'permission' => $items->where('status', 'permission')->count(),
                    'sick' => $items->where('status', 'sick')->count(),
                    'absent' => $items->where('status', 'absent')->count(),
                ];
            })
            ->values();

        return view('super-admin.teacher-attendance.index', compact(
            'attendances',
            'branches',
            'teachers',
            'teacherRecaps',
            'totalAttendance',
            'presentCount',
            'permissionCount',
            'sickCount',
            'absentCount'
        ));
    }
}