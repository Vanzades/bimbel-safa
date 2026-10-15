<?php

namespace Database\Seeders;

use App\Models\ClassRoom;
use App\Models\Schedule;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    public function run(): void
    {
        $teacher = Teacher::whereHas('user', function ($query) {
            $query->where('email', 'guru.depok@bimbelsafa.com');
        })->first();

        if (!$teacher) {
            return;
        }

        $schedules = [
            ['room' => 'DPK-KB-01', 'subject' => 'Aktivitas Bermain Edukatif', 'day' => 'monday', 'start' => '09:00', 'end' => '10:00'],
            ['room' => 'DPK-CAL-01', 'subject' => 'Membaca dan Berhitung', 'day' => 'tuesday', 'start' => '10:00', 'end' => '11:30'],
            ['room' => 'DPK-SD-01', 'subject' => 'Matematika', 'day' => 'wednesday', 'start' => '15:30', 'end' => '17:00'],
            ['room' => 'DPK-SMP-01', 'subject' => 'Matematika', 'day' => 'thursday', 'start' => '16:00', 'end' => '17:30'],
            ['room' => 'DPK-SMA-01', 'subject' => 'Matematika', 'day' => 'friday', 'start' => '16:00', 'end' => '17:30'],
            ['room' => 'DPK-PU-01', 'subject' => 'Latihan dan Pembahasan Soal', 'day' => 'saturday', 'start' => '09:00', 'end' => '10:30'],
        ];

        foreach ($schedules as $item) {
            $classRoom = ClassRoom::where('code', $item['room'])->first();

            if (!$classRoom) {
                continue;
            }

            Schedule::create([
                'class_room_id' => $classRoom->id,
                'teacher_id' => $teacher->id,
                'subject' => $item['subject'],
                'day' => $item['day'],
                'start_time' => $item['start'],
                'end_time' => $item['end'],
                'room' => $classRoom->name,
                'status' => 'active',
            ]);
        }
    }
}