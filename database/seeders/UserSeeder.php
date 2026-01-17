<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 管理者ユーザー
        User::Create([
            'name' => 'john',
            'email' => 'john@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // 一般ユーザー
        User::Create([
            'name' => 'pyon',
            'email' => 'pyon@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        // ランダムユーザー
        User::factory()->count(2)->create();
    }
}
