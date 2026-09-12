<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 固定の管理者ユーザー (Admin)
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);

        // 固定の一般ユーザー (User john)
        User::factory()->create([
            'name' => 'john',
            'email' => 'john@gmail.com',
            'password' => Hash::make('password'),
        ]);

        // 固定の一般ユーザー (User pyon)
        User::factory()->create([
            'name' => 'pyon',
            'email' => 'pyon@gmail.com',
            'password' => Hash::make('password'),
        ]);
    }
}
