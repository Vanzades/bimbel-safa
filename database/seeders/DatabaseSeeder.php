<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $branch = Branch::create([
            'name' => 'Bimbel Safa Depok',
            'address' => 'Depok, Jawa Barat',
            'phone' => '081234567890',
            'is_active' => true,
        ]);

        User::create([
            'name' => 'Super Admin Bimbel Safa',
            'email' => 'superadmin@bimbelsafa.com',
            'password' => Hash::make('superadmin123'),
            'role' => 'super_admin',
            'branch_id' => null,
        ]);

        User::create([
            'name' => 'Admin Bimbel Depok',
            'email' => 'admin.depok@bimbelsafa.com',
            'password' => Hash::make('admindepok123'),
            'role' => 'admin',
            'branch_id' => $branch->id,
        ]);

        $guruUser = User::create([
            'name' => 'Guru Bimbel Depok',
            'email' => 'guru.depok@bimbelsafa.com',
            'password' => Hash::make('gurudepok123'),
            'role' => 'guru',
            'branch_id' => $branch->id,
        ]);

        Teacher::create([
            'user_id' => $guruUser->id,
            'branch_id' => $branch->id,
            'name' => 'Guru Bimbel Depok',
            'identity_number' => 'G001',
            'gender' => 'female',
            'phone' => '081234567892',
            'address' => 'Depok, Jawa Barat',
            'status' => 'active',
        ]);

        $this->call([
            ProgramSeeder::class,
            ClassRoomSeeder::class,
            ScheduleSeeder::class,
            StudentSeeder::class,
        ]);
    }
}