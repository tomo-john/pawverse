<?php

namespace Database\Factories;

use App\Models\Dog;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dog>
 */
class DogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->firstName(),
            'color' => fake()->randomElement(array_keys(Dog::colors())),
            'size' => fake()->randomElement(array_keys(Dog::sizes())),
            'is_public' => fake()->boolean(70), // 70%true
            // user_idはSeeder側で指定
        ];
    }
}
