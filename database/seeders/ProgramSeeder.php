<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    public function run(): void
    {
        $programs = [
            [
                'name' => 'Kelas Bermain',
                'code' => 'KB',
                'description' => 'Program pembelajaran dasar melalui aktivitas bermain yang edukatif.',
            ],
            [
                'name' => 'Calistung',
                'code' => 'CAL',
                'description' => 'Program belajar membaca, menulis, dan berhitung.',
            ],
            [
                'name' => 'Program SD',
                'code' => 'SD',
                'description' => 'Program bimbingan belajar untuk siswa Sekolah Dasar.',
            ],
            [
                'name' => 'Program SMP',
                'code' => 'SMP',
                'description' => 'Program bimbingan belajar untuk siswa Sekolah Menengah Pertama.',
            ],
            [
                'name' => 'Program SMA',
                'code' => 'SMA',
                'description' => 'Program bimbingan belajar untuk siswa Sekolah Menengah Atas.',
            ],
            [
                'name' => 'Paket Ujian',
                'code' => 'PU',
                'description' => 'Program persiapan ujian dan latihan soal sesuai kebutuhan siswa.',
            ],
        ];

        foreach ($programs as $program) {
            Program::create([
                ...$program,
                'status' => 'active',
            ]);
        }
    }
}
