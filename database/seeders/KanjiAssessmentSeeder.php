<?php

namespace Database\Seeders;

use App\Models\KanjiAssessment;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KanjiAssessmentSeeder extends Seeder
{
    public function run()
    {
        // Truncate existing data to start fresh
        KanjiAssessment::truncate();

        $students = User::where('role', 'siswa')->get();
        $totalBab = 34;
        
        // Define specific question counts for known babs, else default to 15
        $questionsMap = [
            '1' => 15, '2' => 12, '3' => 18, '4' => 25, '5' => 20, '6' => 20,
            '7' => 13, '8' => 19, '9' => 9, '10' => 14,
            '11' => 15, '12' => 18, '13' => 10, '14' => 12, '15' => 20,
            '16' => 15, '17' => 18, '18' => 14, '19' => 12, '20' => 22,
            '21' => 15, '22' => 18, '23' => 10, '24' => 12, '25' => 20,
            '26' => 15, '27' => 18, '28' => 14, '29' => 12, '30' => 22,
            '31' => 15, '32' => 18, '33' => 10, '34' => 12
        ];

        foreach ($students as $student) {
            // Seed babs 1 to 34 for each student
            for ($bab = 1; $bab <= $totalBab; $bab++) {
                $maxQuestions = $questionsMap[(string)$bab] ?? 15;
                
                // Generate realistic random correct answers
                // Bias towards passing (75%+) but include some failures and uncompleted ones
                $rand = rand(0, 100);
                
                // Skip some babs randomly to simulate students in progress (e.g. 10% chance to skip)
                if ($rand < 10 && $bab > 5) {
                    continue; 
                }

                if ($rand > 70) {
                    // High score (Passed)
                    $correct = rand(ceil($maxQuestions * 0.8), $maxQuestions);
                } elseif ($rand > 30) {
                    // Average/Passing (Passed)
                    $correct = rand(ceil($maxQuestions * 0.75), ceil($maxQuestions * 0.85));
                } else {
                    // Fail
                    $correct = rand(0, ceil($maxQuestions * 0.7));
                }
                
                $correct = min($correct, $maxQuestions);
                $score = $maxQuestions ? round(($correct / $maxQuestions) * 100, 2) : 0;
                
                // Random date: spread across several months
                $date = Carbon::now()->subMonths(3)->addDays(rand(0, 90))->format('Y-m-d');

                KanjiAssessment::create([
                    'user_id' => $student->id,
                    'bab' => $bab,
                    'correct' => $correct,
                    'score' => $score,
                    'date' => $date
                ]);
            }
        }
    }
}
