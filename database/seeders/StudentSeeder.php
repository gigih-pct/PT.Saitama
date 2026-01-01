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
        // Clear existing students to ensure exact counts
        User::where('role', 'siswa')->delete();

        // Ensure classes exist
        $kelasNames = ['A1', 'A2', 'A3', 'B1', 'B2', 'B3'];
        
        $statuses = ['Respon', 'No Respon', 'Invalid', 'Jepang', 'seleksi', 'mau seleksi', 'ulang kelas', 'BLK', 'proses belajar', 'TG', 'kerja', 'keluar', 'cuti'];
        $followUps = ['Respon', 'No Respon', 'Invalid'];

        foreach ($kelasNames as $name) {
            $kelas = \App\Models\Kelas::firstOrCreate(
                ['nama_kelas' => $name],
                ['kapasitas' => 30]
            );

            // Create 30 students for this class
            User::factory()->count(30)->create([
                'role' => 'siswa',
                'kelas_id' => $kelas->id,
                'status' => function() use ($statuses) {
                    return $statuses[array_rand($statuses)];
                },
                'follow_up' => function() use ($followUps) {
                    return $followUps[array_rand($followUps)];
                },
                'created_at' => function() {
                    return now()->subDays(rand(0, 365));
                }
            ]);
        }

        // Add specific test users if needed (optional, creating them in addition or as part of the 30)
        // For now, let's stick to the batch generation as per request.
        
        /* 
        $fixedStudents = [ ... ];
        foreach ($fixedStudents as $student) { ... }
        */
    }
}
