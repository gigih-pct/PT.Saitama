<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserRoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = ['siswa', 'sensei', 'orangtua'];

        foreach ($roles as $role) {
            User::updateOrCreate([
                'email' => "{$role}@example.com",
            ], [
                'name' => ucfirst($role),
                'password' => Hash::make('password'),
                'role' => $role,
            ]);
        }
    }
}
