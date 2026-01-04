<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Seed admin user and sample role users
        $this->call([
            \Database\Seeders\AdminSeeder::class,
            \Database\Seeders\UserRoleSeeder::class,
            \Database\Seeders\StudentSeeder::class,
            \Database\Seeders\KanjiAssessmentSeeder::class,
            \Database\Seeders\KotobaAssessmentSeeder::class,
            \Database\Seeders\BunpouAssessmentSeeder::class,
        ]);
    }
}
