<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\ClassRoom;
use App\Models\Program;
use Illuminate\Database\Seeder;

class ClassRoomSeeder extends Seeder
{
    public function run(): void
    {
        $branch = Branch::where('name', 'Bimbel Safa Depok')->firstOrFail();

        $rooms = [
            ['program' => 'KB', 'code' => 'DPK-KB-01', 'name' => 'Kelas Bermain Depok'],
            ['program' => 'CAL', 'code' => 'DPK-CAL-01', 'name' => 'Kelas Calistung Depok'],
            ['program' => 'SD', 'code' => 'DPK-SD-01', 'name' => 'Kelas SD Depok'],
            ['program' => 'SMP', 'code' => 'DPK-SMP-01', 'name' => 'Kelas SMP Depok'],
            ['program' => 'SMA', 'code' => 'DPK-SMA-01', 'name' => 'Kelas SMA Depok'],
            ['program' => 'PU', 'code' => 'DPK-PU-01', 'name' => 'Kelas Paket Ujian Depok'],
        ];

        foreach ($rooms as $room) {
            $program = Program::where('code', $room['program'])->firstOrFail();

            ClassRoom::create([
                'branch_id' => $branch->id,
                'program_id' => $program->id,
                'code' => $room['code'],
                'name' => $room['name'],
                'status' => 'active',
            ]);
        }
    }
}
