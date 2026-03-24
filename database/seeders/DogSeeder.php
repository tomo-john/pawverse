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
        // Admin John Dog
        $user1 = User::find(1);

        Dog::factory()->create([
            'user_id' => $user1->id,
            'name' => '伝説のボスじょん',
            'color' => '#D4AF37',
            'size_level' => 9,
            'is_public' => true,
        ]);

        // User John Dogs
        $user2   = User::find(2);
        $sizes   = array_keys(Dog::SIZE_CLASSES);
        $minSize = min($sizes);
        $maxSize = max($sizes);

        Dog::factory()->create([
            'user_id' => $user2->id,
            'name' => '最小のじょん',
            'size_level' => $minSize,
            'is_public' => true,
        ]);

        Dog::factory()->create([
            'user_id' => $user2->id,
            'name' => '最大のじょん',
            'size_level' => $maxSize,
            'is_public' => true,
        ]);

        Dog::factory()->count(4)->create([
            'user_id' => $user2->id,
        ]);


        // その他ユーザー
        $otherUsers = User::whereNotIn('id', [1, 2])->get();

        foreach ($otherUsers as $user) {
            Dog::factory()->count(6)->create([
                'user_id' => $user->id,
            ]);
        }
    }
}
