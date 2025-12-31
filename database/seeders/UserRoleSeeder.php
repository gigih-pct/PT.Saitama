<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserRoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = ['siswa','sensei','orang tua','CRM','Keuangan'];

        foreach ($roles as $i => $role) {
            User::updateOrCreate([
                'email' => "{$role}@example.com",
            ], [
                'name' => ucfirst(str_replace(' ', '', $role)),
                'password' => Hash::make('password'),
                'role' => $role,
            ]);
        }
    }
}
