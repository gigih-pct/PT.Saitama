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

        $statuses = ['Respon', 'No Respon', 'Invalid', 'Jepang', 'seleksi', 'mau seleksi', 'ulang kelas', 'BLK', 'proses belajar', 'TG', 'kerja', 'keluar', 'cuti'];
        $followUps = ['Respon', 'No Respon', 'Invalid'];

        // Create 50 students
        User::factory()->count(50)->create([
            'role' => 'siswa',
            'status' => function() use ($statuses) {
                return $statuses[array_rand($statuses)];
            },
            'follow_up' => function() use ($followUps) {
                return $followUps[array_rand($followUps)];
            },
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
                'status' => 'Jepang',
                'follow_up' => 'Respon',
                'kelas_id' => $kelases[0]->id,
            ],
            [
                'name' => 'Siti Aminah',
                'email' => 'siti@siswa.com',
                'password' => Hash::make('password'),
                'role' => 'siswa',
                'status' => 'seleksi',
                'follow_up' => 'No Respon',
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
