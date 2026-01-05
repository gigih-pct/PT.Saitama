<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\WawancaraAssessment;
use Carbon\Carbon;

class WawancaraAssessmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = User::where('role', 'siswa')->get();

        foreach ($students as $student) {
            $program = rand(1, 3);
            $umum = rand(1, 3);
            $jepang = rand(1, 3);
            $indo = rand(1, 3);
            $sum = $program + $umum + $jepang + $indo;
            $percent = round(($sum / 12) * 100, 2);

            $cara_duduk = rand(1, 3);
            $suara = rand(1, 3);
            $fokus = rand(1, 3);
            $sum_sikap = $cara_duduk + $suara + $fokus;
            $percent_sikap = round(($sum_sikap / 9) * 100, 2);

            WawancaraAssessment::updateOrCreate(
                ['user_id' => $student->id],
                [
                    'program' => $program,
                    'umum' => $umum,
                    'jepang' => $jepang,
                    'indo' => $indo,
                    'sum' => $sum,
                    'percent' => $percent,
                    'cara_duduk' => $cara_duduk,
                    'suara' => $suara,
                    'fokus' => $fokus,
                    'sum_sikap' => $sum_sikap,
                    'percent_sikap' => $percent_sikap,
                    'note' => 'Motivasi belajar cukup baik. Perlu peningkatan pada kosakata bahasa Jepang.',
                    'note_sikap' => 'Sikap selama wawancara cukup baik, perhatikan kontak mata.',
                    'date' => Carbon::now()->subDays(rand(1, 30)),
                ]
            );
        }
    }
}
