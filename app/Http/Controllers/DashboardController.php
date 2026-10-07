<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\Schedule;
use App\Models\SppBill;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'users' => User::count(),
            'teachers' => Teacher::where('status', 'active')->count(),
            'students' => Student::where('status', 'active')->count(),
            'classRooms' => ClassRoom::where('status', 'active')->count(),
            'schedules' => Schedule::where('status', 'active')->count(),
            'sppBills' => SppBill::count(),
            'sppPaid' => SppBill::where('status', 'paid')->count(),
            'sppUnpaid' => SppBill::where('status', 'unpaid')->count(),
            'sppPending' => SppBill::where('status', 'pending')->count(),
            'sppPaidAmount' => SppBill::where('status', 'paid')->sum('amount'),
            'sppUnpaidAmount' => SppBill::where('status', 'unpaid')->sum('amount'),
        ];

        $latestSchedules = Schedule::with(['classRoom', 'teacher'])
            ->where('status', 'active')
            ->orderByRaw("FIELD(day, 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday')")
            ->orderBy('start_time')
            ->limit(6)
            ->get();

        $latestTeachers = Teacher::latest()->limit(5)->get();

        $latestStudents = Student::with('classRoom')->latest()->limit(5)->get();

        return view('admin.dashboard', compact('stats', 'latestSchedules', 'latestTeachers', 'latestStudents'));
    }
}
