<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\ClassRoom;
use App\Models\Schedule;
use App\Models\SppBill;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();

        abort_unless($user, 401);
        abort_unless($user->role === 'admin', 403);
        abort_unless($user->branch_id, 403, 'Akun admin belum terhubung dengan cabang.');

        $branchId = $user->branch_id;

        $branchUsers = User::query()
            ->where('branch_id', $branchId);

        $branchTeachers = Teacher::query()
            ->where('branch_id', $branchId);

        $branchStudents = Student::query()
            ->whereHas('classRoom', function ($query) use ($branchId) {
                $query->where('branch_id', $branchId);
            });

        $branchClassRooms = ClassRoom::query()
            ->where('branch_id', $branchId);

        $branchSchedules = Schedule::query()
            ->whereHas('classRoom', function ($query) use ($branchId) {
                $query->where('branch_id', $branchId);
            });

        $branchSppBills = SppBill::query()
            ->whereHas('student.classRoom', function ($query) use ($branchId) {
                $query->where('branch_id', $branchId);
            });

        $stats = [
            'users' => (clone $branchUsers)->count(),
            'teachers' => (clone $branchTeachers)
                ->where('status', 'active')
                ->count(),
            'students' => (clone $branchStudents)
                ->where('status', 'active')
                ->count(),
            'classRooms' => (clone $branchClassRooms)
                ->where('status', 'active')
                ->count(),
            'schedules' => (clone $branchSchedules)
                ->where('status', 'active')
                ->count(),

            'sppBills' => (clone $branchSppBills)->count(),
            'sppPaid' => (clone $branchSppBills)
                ->where('status', 'paid')
                ->count(),
            'sppUnpaid' => (clone $branchSppBills)
                ->where('status', 'unpaid')
                ->count(),
            'sppPending' => (clone $branchSppBills)
                ->where('status', 'pending')
                ->count(),
            'sppPaidAmount' => (clone $branchSppBills)
                ->where('status', 'paid')
                ->sum('amount'),
            'sppUnpaidAmount' => (clone $branchSppBills)
                ->where('status', 'unpaid')
                ->sum('amount'),
        ];

        $latestSchedules = Schedule::with(['classRoom', 'teacher'])
            ->where('status', 'active')
            ->whereHas('classRoom', function ($query) use ($branchId) {
                $query->where('branch_id', $branchId);
            })
            ->orderByRaw(
                "FIELD(day, 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday')"
            )
            ->orderBy('start_time')
            ->limit(6)
            ->get();

        $latestTeachers = Teacher::where('branch_id', $branchId)
            ->latest()
            ->limit(5)
            ->get();

        $latestStudents = Student::with('classRoom')
            ->whereHas('classRoom', function ($query) use ($branchId) {
                $query->where('branch_id', $branchId);
            })
            ->latest()
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'stats',
            'latestSchedules',
            'latestTeachers',
            'latestStudents'
        ));
    }

    public function superAdmin(): View
    {
        $branchCount = Branch::count();
        $activeBranchCount = Branch::where('is_active', true)->count();
        $inactiveBranchCount = Branch::where('is_active', false)->count();
        $adminCount = User::where('role', 'admin')->count();
        $teacherCount = Teacher::count();
        $studentCount = Student::count();
        $classRoomCount = ClassRoom::count();
        $scheduleCount = Schedule::count();

        $latestBranches = Branch::withCount([
            'users',
            'teachers',
            'students',
            'classRooms',
            'schedules',
        ])
            ->latest()
            ->take(5)
            ->get();

        $latestUsers = User::with('branch')
            ->whereIn('role', ['admin', 'guru', 'siswa'])
            ->latest()
            ->take(6)
            ->get();

        return view('super-admin.dashboard', compact(
            'branchCount',
            'activeBranchCount',
            'inactiveBranchCount',
            'adminCount',
            'teacherCount',
            'studentCount',
            'classRoomCount',
            'scheduleCount',
            'latestBranches',
            'latestUsers',
        ));
    }
}
