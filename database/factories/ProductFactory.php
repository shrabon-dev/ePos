<?php

namespace Database\Factories;

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
        return [
            'name' => fake()->name(),
            'code' => fake()->randomDigit(6),
            'category' => fake()->word(),
            'brand' => fake()->word(),
            'unit' => fake()->word(),
            'warehouse' => fake()->word(),
            'status' => fake()->randomElement(['active']),
            'description' => fake()->realText($maxNbChars = 60, $indexSize = 2),
            'image' => fake()->imageUrl($width = 640, $height = 480,'cats'),
            'sku' => fake()->word(),
            'barcode' => fake()->ean8(),
            'price' => fake()->numberBetween($min = 100, $max = 500),
            'discount_type' => fake()->randomElement(['Percentage', 'Fixed Amount', 'Buy One Get One (BOGO)', 'Free Shipping', 'Gift Card']),
            'discount' => fake()->numberBetween($min = 10, $max = 25),
            'tax' => fake()->numberBetween($min = 10, $max = 20),
            'quantity' => fake()->numberBetween($min = 160, $max = 200),
            'alert_quantity' => fake()->numberBetween($min = 50, $max = 100),
        ];
    }
}
