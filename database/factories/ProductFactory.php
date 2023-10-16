<?php

namespace Database\Factories;

use App\Models\Stand;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $standsId = Stand::all()->pluck('id');

        return [
            'sales_stand_id' => fake()->randomElement($standsId),
            'name' => fake()->word,
        ];
    }
}
