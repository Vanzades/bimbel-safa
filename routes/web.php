<?php

use App\Http\Controllers\AdminNotificationController;
use App\Http\Controllers\AdminTeacherAttendanceController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\ClassRoomController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\SalarySlipController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SppBillController;
use App\Http\Controllers\StudentAttendanceController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\StudentProfileController;
use App\Http\Controllers\StudentRegistrationController;
use App\Http\Controllers\StudentSppController;
use App\Http\Controllers\TeacherAttendanceController;
use App\Http\Controllers\TeacherAttendanceReportController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TeacherDashboardController;
use App\Http\Controllers\TeacherProfileController;
use App\Http\Controllers\TeacherScheduleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/tentang', function () {
    return view('pages.tentang');
})->name('tentang');

Route::get('/program', function () {
    return view('pages.program');
})->name('program');

Route::get('/program/{program}', function (string $program) {
    abort_unless(in_array($program, ['sd', 'smp', 'sma']), 404);

    return view('pages.program-detail', compact('program'));
})->name('program.detail');

Route::get('/kontak', function () {
    return view('pages.kontak');
})->name('kontak');

Route::middleware(['auth', 'role:super_admin'])
    ->prefix('super-admin')
    ->name('super-admin.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'superAdmin'])->name('dashboard');

        Route::post('/users/{user}/reset-password', [UserController::class, 'resetPassword'])->name(
            'users.reset-password',
        );

        Route::resource('branches', BranchController::class);
        Route::resource('programs', ProgramController::class);
        Route::resource('users', UserController::class);
        Route::resource('teachers', TeacherController::class);
        Route::resource('students', StudentController::class);
        Route::resource('salary-slips', SalarySlipController::class);
        Route::get('/class-rooms', [ClassRoomController::class, 'superAdminIndex'])->name('class-rooms.index');
        Route::get('/teacher-attendance', [TeacherAttendanceReportController::class, 'index'])->name(
            'teacher-attendance.index',
        );
        Route::get('/spp-bills/report', [SppBillController::class, 'report'])->name('spp-bills.report');
    });

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/student-registrations', [StudentRegistrationController::class, 'index'])->name(
            'student-registrations.index',
        );

        Route::post('/users/{user}/reset-password', [UserController::class, 'resetPassword'])->name(
            'users.reset-password',
        );

        Route::get('/student-registrations/{student}', [StudentRegistrationController::class, 'show'])->name(
            'student-registrations.show',
        );

        Route::post('/student-registrations/{student}/approve', [
            StudentRegistrationController::class,
            'approve',
        ])->name('student-registrations.approve');

        Route::post('/student-registrations/{student}/reject', [StudentRegistrationController::class, 'reject'])->name(
            'student-registrations.reject',
        );

        Route::get('/student-registrations/{student}/whatsapp', [
            StudentRegistrationController::class,
            'whatsapp',
        ])->name('student-registrations.whatsapp');

        Route::post('/students/{student}/whatsapp-credentials', [
            StudentController::class,
            'sendCredentialsWhatsapp',
        ])->name('students.whatsapp-credentials');

        Route::resource('teachers', TeacherController::class);
        Route::resource('students', StudentController::class);
        Route::resource('class-rooms', ClassRoomController::class);
        Route::resource('programs', ProgramController::class);
        Route::resource('users', UserController::class);
        Route::resource('schedules', ScheduleController::class);
        Route::resource('spp-bills', SppBillController::class);

        Route::get('/teacher-attendance', [AdminTeacherAttendanceController::class, 'index'])->name(
            'teacher-attendance.index',
        );

        Route::post('/teacher-attendance', [AdminTeacherAttendanceController::class, 'store'])->name(
            'teacher-attendance.store',
        );

        Route::get('/notifications/create', [AdminNotificationController::class, 'create'])->name(
            'notifications.create',
        );

        Route::post('/notifications', [AdminNotificationController::class, 'store'])->name('notifications.store');
    });

Route::middleware(['auth', 'role:siswa'])->group(function () {
    Route::get('/student/dashboard', [StudentDashboardController::class, 'index'])->name('student.dashboard');

    Route::get('/student/profile', [StudentProfileController::class, 'edit'])->name('student.profile');

    Route::patch('/student/profile', [StudentProfileController::class, 'update'])->name('student.profile.update');

    Route::get('/student/attendance', [StudentAttendanceController::class, 'index'])->name('student.attendance');

    Route::get('/student/spp', [StudentSppController::class, 'index'])->name('student.spp');

    Route::get('/student/spp/{id}', [StudentSppController::class, 'show'])->name('student.spp.show');
});

Route::middleware(['auth', 'role:guru'])->group(function () {
    Route::get('/teacher/dashboard', [TeacherDashboardController::class, 'index'])->name('teacher.dashboard');

    Route::get('/teacher/schedules', [TeacherScheduleController::class, 'index'])->name('teacher.schedules');

    Route::get('/teacher/attendance', [TeacherAttendanceController::class, 'index'])->name('teacher.attendance.index');

    Route::post('/teacher/attendance', [TeacherAttendanceController::class, 'store'])->name('teacher.attendance.store');

    Route::get('/teacher/attendance/history', [TeacherAttendanceController::class, 'history'])->name(
        'teacher.attendance.history',
    );

    Route::get('/teacher/attendance/recap', [TeacherAttendanceController::class, 'recap'])->name(
        'teacher.attendance.recap',
    );

    Route::get('/teacher/salary-slips', [SalarySlipController::class, 'teacherIndex'])->name('teacher.salary-slips');

    Route::get('/teacher/salary-slips/{salarySlip}', [SalarySlipController::class, 'teacherShow'])->name(
        'teacher.salary-slips.show',
    );

    Route::get('/teacher/profile', [TeacherProfileController::class, 'edit'])->name('teacher.profile');

    Route::patch('/teacher/profile', [TeacherProfileController::class, 'update'])->name('teacher.profile.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');

    Route::post('/notifications/{id}/read', [NotificationController::class, 'read'])->name('notifications.read');

    Route::post('/notifications/read-all', [NotificationController::class, 'readAll'])->name('notifications.read-all');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
