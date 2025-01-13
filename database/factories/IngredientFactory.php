<?php

namespace Database\Factories;

use App\Models\IngredientType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ingredient>
 */
class IngredientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::query()->inRandomOrder()->value('id') ?? 1,
            'ingredient_type_id' => IngredientType::query()->inRandomOrder()->value('id') ?? 1,
            'description' => $this->faker->sentence(1),
            'quantity_type' => $this->faker->randomElement(['g', 'kg', 'l']),
            'quantity' => $this->faker->randomFloat(2, 0, 100),
            'weight' => $this->faker->randomFloat(2, 0, 1000),
            'calories' => $this->faker->randomFloat(1, 0, 500),
            'protein' => $this->faker->randomFloat(1, 0, 100),
            'carbs' => $this->faker->randomFloat(1, 0, 1000),
            'sugar' => $this->faker->randomFloat(1, 0, 50),
            'fiber' => $this->faker->randomFloat(1, 0, 50),
            'fat' => $this->faker->randomFloat(1, 0, 50),
            'expires_at' => $this->faker->dateTimeBetween('+1 day', '+1 year'),
        ];
    }
}
