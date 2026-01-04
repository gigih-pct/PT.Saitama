<?php

namespace Database\Seeders;

use App\Models\KotobaAssessment;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KotobaAssessmentSeeder extends Seeder
{
    public function run()
    {
        // Truncate existing data
        KotobaAssessment::truncate();

        $students = User::where('role', 'siswa')->get();
        
        $questionsMap = [
            '1' => 35, '2' => 59, '3' => 59, '4' => 59, '5' => 59, '6' => 59,
            '7' => 59, '8' => 41, '9' => 41, '10' => 22,
        ];

        foreach ($questionsMap as $babKey => $maxQuestions) {
            foreach ($students as $student) {
                // Determine varied performance
                $rand = rand(0, 100);
                if ($rand > 75) {
                    $correct = rand(ceil($maxQuestions * 0.8), $maxQuestions); // High
                } elseif ($rand > 30) {
                    $correct = rand(ceil($maxQuestions * 0.5), ceil($maxQuestions * 0.8)); // Medium
                } else {
                    $correct = rand(0, ceil($maxQuestions * 0.5)); // Low
                }
                
                $correct = min($correct, $maxQuestions);
                $score = $maxQuestions ? round(($correct / $maxQuestions) * 100, 2) : 0;
                $date = now()->subDays(rand(0, 30))->format('Y-m-d');

                KotobaAssessment::create([
                    'user_id' => $student->id,
                    'bab' => (string)$babKey,
                    'correct' => $correct,
                    'score' => $score,
                    'date' => $date
                ]);
            }
        }
    }
}
