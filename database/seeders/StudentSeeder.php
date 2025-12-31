<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = [
            [
                'name' => 'Budi Santoso',
                'email' => 'budi@siswa.com',
                'password' => Hash::make('password'),
                'role' => 'siswa',
                'status' => 'pending',
            ],
            [
                'name' => 'Siti Aminah',
                'email' => 'siti@siswa.com',
                'password' => Hash::make('password'),
                'role' => 'siswa',
                'status' => 'pending',
            ],
            [
                'name' => 'Agus Pratama',
                'email' => 'agus@siswa.com',
                'password' => Hash::make('password'),
                'role' => 'siswa',
                'status' => 'pending',
            ],
            [
                'name' => 'Dewi Lestari',
                'email' => 'dewi@siswa.com',
                'password' => Hash::make('password'),
                'role' => 'siswa',
                'status' => 'approved',
            ],
        ];

        foreach ($students as $student) {
            User::updateOrCreate(
                ['email' => $student['email']],
                $student
            );
        }
    }
}
