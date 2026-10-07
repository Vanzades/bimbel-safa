<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class TeacherScheduleController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $teacher = $user->teacher()->firstOrFail();

        $schedules = $teacher->schedules()->with('classRoom')->orderBy('day')->orderBy('start_time')->get();

        return view('teacher.schedules.index', compact('teacher', 'schedules'));
    }
}
