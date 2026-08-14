<?php

namespace Database\Factories;

use App\Models\SparePart;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SparePart>
 */
class SparePartFactory extends Factory
{
    protected $model = SparePart::class;

    public function definition(): array
    {
        return [
            'name' => fake()->word() . ' ' . fake()->word(),
            'description' => fake()->sentence(),
            'reference_code' => strtoupper(fake()->bothify('??-###')),
            'unit_cost' => fake()->randomFloat(2, 5, 200),
            'quantity_in_stock' => fake()->numberBetween(0, 100),
            'minimum_stock' => fake()->numberBetween(1, 20),
            'supplier' => fake()->company(),
            'notes' => fake()->sentence(),
        ];
    }
}
