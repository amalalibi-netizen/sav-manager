<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Device;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Device>
 */
class DeviceFactory extends Factory
{
    protected $model = Device::class;

    public function definition(): array
    {
        return [
            'client_id' => Client::factory(),
            'type' => fake()->randomElement(['smartphone', 'tablet', 'laptop', 'console', 'tv']),
            'brand' => fake()->randomElement(['Apple', 'Samsung', 'HP', 'Lenovo', 'Dell', 'Sony']),
            'model' => fake()->word(),
            'serial_number' => fake()->bothify('SER###????'),
            'purchase_date' => fake()->date(),
            'warranty_status' => fake()->randomElement(['in_warranty', 'expired', 'not_applicable']),
            'notes' => fake()->sentence(),
        ];
    }
}
