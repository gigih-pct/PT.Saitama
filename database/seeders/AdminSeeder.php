<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $admins = [
            [
                'name' => 'Super Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ],
            [
                'name' => 'CRM Staff',
                'email' => 'crm@example.com',
                'password' => Hash::make('password'),
                'role' => 'CRM',
            ],
            [
                'name' => 'Finance Staff',
                'email' => 'keuangan@example.com',
                'password' => Hash::make('password'),
                'role' => 'Keuangan',
            ],
        ];

        foreach ($admins as $adminData) {
            Admin::updateOrCreate(
                ['email' => $adminData['email']],
                $adminData
            );
        }
    }
}
