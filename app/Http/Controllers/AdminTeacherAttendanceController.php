<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\TeacherAttendance;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminTeacherAttendanceController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();

        $teachers = Teacher::where('branch_id', $user->branch_id)
            ->where('status', 'active')
            ->orderBy('name')
            ->get();

        $selectedDate = $request->input(
            'input_date',
            now()->format('Y-m-d')
        );

        $todayAttendances = TeacherAttendance::where(
            'branch_id',
            $user->branch_id
        )
            ->whereDate('date', $selectedDate)
            ->get()
            ->keyBy('teacher_id');

        $query = TeacherAttendance::with([
            'teacher',
            'branch',
        ])
            ->where('branch_id', $user->branch_id);

        if ($request->filled('date')) {
            $query->whereDate('date', $request->date);
        }

        if ($request->filled('teacher_id')) {
            $query->where('teacher_id', $request->teacher_id);
        }

        $attendances = $query
            ->latest('date')
            ->latest('id')
            ->paginate(15)
            ->withQueryString();

        return view('admin.teacher-attendance.index', compact(
            'teachers',
            'attendances',
            'todayAttendances',
            'selectedDate'
        ));
    }

    public function store(Request $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'date' => ['required', 'date'],
            'attendance' => ['required', 'array'],
            'attendance.*.teacher_id' => ['required', 'integer'],
            'attendance.*.status' => [
                'required',
                'in:present,permission,sick,absent',
            ],
            'attendance.*.notes' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ], [
            'date.required' => 'Tanggal absensi wajib diisi.',
            'date.date' => 'Tanggal absensi tidak valid.',
            'attendance.required' => 'Data absensi guru wajib tersedia.',
            'attendance.array' => 'Format data absensi tidak valid.',
            'attendance.*.teacher_id.required' => 'Guru wajib dipilih.',
            'attendance.*.status.required' => 'Status absensi wajib dipilih.',
            'attendance.*.status.in' => 'Status absensi tidak valid.',
            'attendance.*.notes.max' => 'Keterangan maksimal 1000 karakter.',
        ]);

        foreach ($validated['attendance'] as $item) {
            $teacher = Teacher::where('id', $item['teacher_id'])
                ->where('branch_id', $user->branch_id)
                ->where('status', 'active')
                ->first();

            if (!$teacher) {
                continue;
            }

            TeacherAttendance::updateOrCreate(
                [
                    'teacher_id' => $teacher->id,
                    'date' => $validated['date'],
                ],
                [
                    'branch_id' => $user->branch_id,
                    'status' => $item['status'],
                    'notes' => $item['notes'] ?? null,
                ]
            );
        }

        return redirect()
            ->route('admin.teacher-attendance.index')
            ->with('success', 'Absensi guru berhasil disimpan.');
    }
}