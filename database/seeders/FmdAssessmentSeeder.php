<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\FmdAssessment;
use Carbon\Carbon;

class FmdAssessmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = User::where('role', 'siswa')->get();
        $types = ['mtk', 'lari', 'pushup'];

        foreach ($students as $student) {
            foreach ($types as $type) {
                $data = [
                    'user_id' => $student->id,
                    'type' => $type,
                    'date' => Carbon::now(),
                ];

                $totalScore = 0;
                for ($w = 1; $w <= 5; $w++) {
                    // Random value (e.g., number of pushups or score)
                    $val = rand(20, 50);
                    $ket = ($val >= 37) ? 'LULUS' : 'TIDAK LULUS';
                    $score = ($ket === 'LULUS') ? 1 : 0;

                    $data["week{$w}_val"] = $val;
                    $data["week{$w}_ket"] = $ket;
                    $data["week{$w}_score"] = $score;
                    $totalScore += $score;
                }

                $data['total_score'] = $totalScore;
                FmdAssessment::create($data);
            }
        }
    }
}
