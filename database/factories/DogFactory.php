<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Dog;

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

        $level = fake()->numberBetween(1, count(Dog::SIZE_CLASSES));

        return [
          'name' => "seeder(size:{$level})",
          'color' => fake()->hexColor(),
          'size_level' => $level,
          'is_public' => fake()->boolean(70),
        ];
    }
}
