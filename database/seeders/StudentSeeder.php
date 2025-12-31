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
        // Ensure some classes exist
        $kelasNames = ['A1', 'A2', 'A3', 'B1', 'B2', 'B3'];
        $kelases = [];
        
        foreach ($kelasNames as $name) {
            $kelases[] = \App\Models\Kelas::firstOrCreate(
                ['nama_kelas' => $name],
                ['kapasitas' => 30]
            );
        }

        // Create 50 students
        User::factory()->count(50)->create([
            'role' => 'siswa',
            'kelas_id' => function() use ($kelases) {
                return $kelases[array_rand($kelases)]->id;
            }
        ]);

        // Add the specific students from before to ensure they exist for testing
        $fixedStudents = [
            [
                'name' => 'Budi Santoso',
                'email' => 'budi@siswa.com',
                'password' => Hash::make('password'),
                'role' => 'siswa',
                'status' => 'pending',
                'kelas_id' => $kelases[0]->id,
            ],
            [
                'name' => 'Siti Aminah',
                'email' => 'siti@siswa.com',
                'password' => Hash::make('password'),
                'role' => 'siswa',
                'status' => 'pending',
                'kelas_id' => $kelases[1]->id,
            ],
        ];

        foreach ($fixedStudents as $student) {
            User::updateOrCreate(
                ['email' => $student['email']],
                $student
            );
        }
    }
}
