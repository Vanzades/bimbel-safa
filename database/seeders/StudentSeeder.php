<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\ClassRoom;
use App\Models\Program;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $branch = Branch::where('name', 'Bimbel Safa Depok')->firstOrFail();
        $program = Program::where('code', 'SD')->firstOrFail();
        $classRoom = ClassRoom::where('code', 'DPK-SD-01')->firstOrFail();

        $user = User::create([
            'name' => 'Murid Contoh Depok',
            'email' => 'murid.depok@bimbelsafa.com',
            'password' => Hash::make('muriddepok123'),
            'role' => 'siswa',
            'branch_id' => $branch->id,
        ]);

        Student::create([
            'user_id' => $user->id,
            'branch_id' => $branch->id,
            'class_room_id' => $classRoom->id,
            'program_id' => $program->id,
            'name' => 'Murid Contoh Depok',
            'identity_number' => 'S001',
            'gender' => 'male',
            'birth_place' => 'Depok',
            'birth_date' => '2015-05-10',
            'phone' => '081234567893',
            'email' => 'murid.depok@bimbelsafa.com',
            'address' => 'Depok, Jawa Barat',
            'parent_name' => 'Orang Tua Murid',
            'parent_phone' => '081234567894',
            'parent_address' => 'Depok, Jawa Barat',
            'parent_occupation' => 'Karyawan Swasta',
            'previous_tutoring' => false,
            'special_needs' => false,
            'notes' => 'Data dummy untuk pengujian sistem.',
            'status' => 'active',
            'registration_status' => 'approved',
        ]);
    }
}