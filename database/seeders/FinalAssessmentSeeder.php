<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\FinalAssessment;
use Carbon\Carbon;

class FinalAssessmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = User::where('role', 'siswa')->get();
        $subjects = ['hiragana', 'katakana', 'bunpou', 'kerja', 'sifat', 'benda', 'terjemah', 'dengar', 'bicara'];

        foreach ($students as $student) {
            $data = [
                'user_id' => $student->id,
                'date' => Carbon::now()->subDays(rand(0, 30)),
            ];

            $sum = 0;
            foreach ($subjects as $subject) {
                // Generate score between 60 and 100
                $score = rand(60, 100);
                $data[$subject] = $score;
                $sum += $score;
            }

            $rata_rata = $sum / count($subjects);
            $data['rata_rata'] = round($rata_rata, 2);

            // Grade logic using revised scale
            if ($rata_rata >= 90) $data['grade'] = 'A';
            elseif ($rata_rata >= 85) $data['grade'] = 'B+';
            elseif ($rata_rata >= 80) $data['grade'] = 'B';
            elseif ($rata_rata >= 75) $data['grade'] = 'C+';
            elseif ($rata_rata >= 10) $data['grade'] = 'C';
            else $data['grade'] = 'TU';

            // Attitude & Attendance
            $data['sikap'] = collect(['A', 'B'])->random();
            $data['kehadiran'] = rand(85, 100);

            FinalAssessment::create($data);
        }
    }
}
