<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Buat akun admin default
        User::firstOrCreate(
            ['email' => 'admin@reelreview.com'],
            [
                'name'     => 'Admin',
                'password' => Hash::make('admin123'),
                'role'     => 'admin',
            ]
        );
    }
}
