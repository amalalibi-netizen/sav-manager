<?php

namespace Database\Factories;

use App\Models\Repair;
use App\Models\Technician;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Repair>
 */
class RepairFactory extends Factory
{
    protected $model = Repair::class;

    public function definition(): array
    {
        return [
            'ticket_id' => Ticket::factory(),
            'technician_id' => Technician::factory(),
            'diagnosis' => fake()->sentence(),
            'repair_description' => fake()->sentence(),
            'parts_used' => fake()->sentence(),
            'labor_cost' => fake()->randomFloat(2, 10, 200),
            'parts_cost' => fake()->randomFloat(2, 10, 200),
            'total_cost' => fake()->randomFloat(2, 30, 300),
            'status' => fake()->randomElement(['pending', 'in_progress', 'completed', 'waiting_parts', 'cancelled']),
        ];
    }
}
