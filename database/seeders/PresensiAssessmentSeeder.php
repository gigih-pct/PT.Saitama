<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\PresensiAssessment;
use Carbon\Carbon;

class PresensiAssessmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = User::where('role', 'siswa')->get();
        $now = Carbon::now();
        $daysInMonth = $now->daysInMonth;
        $statuses = ['H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'A', 'S', 'I']; // Weighted towards 'H'

        foreach ($students as $student) {
            for ($d = 1; $d <= $daysInMonth; $d++) {
                // Skip weekends for more realism
                $date = Carbon::create($now->year, $now->month, $d);
                if ($date->isWeekend()) continue;

                PresensiAssessment::create([
                    'user_id' => $student->id,
                    'day' => $d,
                    'month' => $now->month,
                    'year' => $now->year,
                    'status' => collect($statuses)->random(),
                    'phone' => $student->no_wa_pribadi ?? '08123456789',
                    'date' => $date->toDateString(),
                ]);
            }
        }
    }
}
