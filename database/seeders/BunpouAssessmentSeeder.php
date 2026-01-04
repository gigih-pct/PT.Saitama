<?php

namespace Database\Seeders;

use App\Models\BunpouAssessment;
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class BunpouAssessmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Start fresh
        BunpouAssessment::truncate();

        $students = User::where('role', 'siswa')->get();

        foreach ($students as $student) {
            $data = [
                'user_id' => $student->id,
            ];

            // Seed 6 evaluations
            for ($i = 1; $i <= 6; $i++) {
                // 80% chance to have a score
                if (rand(0, 100) > 20) {
                    $data["eval{$i}"] = rand(65, 100);
                    $data["eval{$i}_at"] = Carbon::now()->subWeeks(7 - $i)->format('Y-m-d');
                }
            }

            // Seed final eval
            if (rand(0, 100) > 40) {
                $data['final_ujian'] = rand(70, 100);
                $data['final_nilai'] = rand(70, 100);
                $data['final_at'] = Carbon::now()->format('Y-m-d');
            }

            BunpouAssessment::create($data);
        }
    }
}
