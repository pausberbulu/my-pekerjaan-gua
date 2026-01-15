<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Gua Superdmin',
            'email' => 'superadmin@mypekerjaan.com',
            'password' => Hash::make('superadmin'),
            'username' => 'guasuperadmin',
            'role' => 'superadmin',
        ]);
    }
}
