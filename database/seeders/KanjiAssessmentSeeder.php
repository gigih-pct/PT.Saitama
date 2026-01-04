<?php

namespace Database\Seeders;

use App\Models\KanjiAssessment;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KanjiAssessmentSeeder extends Seeder
{
    public function run()
    {
        // Truncate existing data to start fresh (optional, maybe safe while developing)
        KanjiAssessment::truncate();

        $students = User::where('role', 'siswa')->get();
        
        $questionsMap = [
            '1' => 15, '2' => 12, '3' => 18, '4' => 25, '5-6' => 20,
            '7' => 13, '8' => 19, '9' => 9, '10' => 14,
        ];

        foreach ($questionsMap as $babKey => $maxQuestions) {
            foreach ($students as $student) {
                // Generate realistic random correct answers
                // Bias towards passing (75%+) but include some failures
                $rand = rand(0, 100);
                if ($rand > 80) {
                    // High score
                    $correct = rand(ceil($maxQuestions * 0.8), $maxQuestions);
                } elseif ($rand > 20) {
                    // Average/Passing
                    $correct = rand(ceil($maxQuestions * 0.5), ceil($maxQuestions * 0.8));
                } else {
                    // Fail
                    $correct = rand(0, ceil($maxQuestions * 0.5));
                }
                
                // Ensure correct isn't greater than max (already handled by rand logic but good to be safe)
                $correct = min($correct, $maxQuestions);
                
                $score = $maxQuestions ? round(($correct / $maxQuestions) * 100, 2) : 0;
                
                // Random date in the last month
                $date = now()->subDays(rand(0, 30))->format('Y-m-d');

                KanjiAssessment::create([
                    'user_id' => $student->id,
                    'bab' => intval($babKey), // handle '5-6' as 5 for now? Or just stick to simple numeric babs in seeder
                    // The Controller uses casts to (int), so '5-6' becomes 5. 
                    // Let's stick to strict numeric keys for safety: 1, 2, 3, 4, 7, 8, 9, 10.
                    // '5-6' might resolve to 5.
                    'correct' => $correct,
                    'score' => $score,
                    'date' => $date
                ]);
            }
        }
    }
}
