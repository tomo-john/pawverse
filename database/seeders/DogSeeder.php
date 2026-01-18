<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Dog;

class DogSeeder extends Seeder
{
    public function run(): void
    {
        // 管理者ユーザーに犬を持たせる
        $admin = User::where('role', 'admin')->first();
        if ($admin) {
            Dog::factory()
                ->count(6)
                ->create([
                    'user_id' => $admin->id,
                ]);
        }

        // 一般ユーザーに犬を持たせる
        User::where('role', 'user')->each(function ($user) {
            Dog::factory()
                ->count(rand(1, 5))
                ->create([
                    'user_id' => $user->id,
                ]);
        });
    }
}
