<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Uuid;

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
            'product_id' => Uuid::uuid4()->toString(),
            'product_name' => $this->faker->word(),
            'product_price' => $this->faker->randomFloat(2, 100, 10000),
            'product_state' => 'available',
        ];
    }
}
