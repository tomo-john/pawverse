<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Dog;

class DogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        // 固定のDog
        Dog::factory()->create([
            'user_id' => $users->first()->id,
            'name' => '伝説のボスじょん',
            'color' => '#D4AF37',
            'size_level' => 9,
            'met_at' => now(),
            'is_public' => true,
        ]);

        // 全てサイズのDogを生成
        $user   = User::find(2);
        $sizes = array_keys(Dog::SIZE_CLASSES);

        foreach ($sizes as $size) {
            Dog::factory()->create([
                'user_id' => $user->id,
                'name' => 'じょん(Size ' . $size . ')',
                'size_level' => $size,
                'met_at' => null,
                'is_public' => true,
            ]);
        }

        // ランダムDog(1ユーザーで2~6匹)
        foreach ($users as $user) {
            Dog::factory()->count(rand(2, 6))
                          ->create(['user_id' => $user->id,]);
        }
    }
}
