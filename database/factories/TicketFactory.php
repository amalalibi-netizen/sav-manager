<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Device;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Ticket>
 */
class TicketFactory extends Factory
{
    protected $model = Ticket::class;

    public function definition(): array
    {
        return [
            'ticket_number' => 'SAV-' . now()->format('Y') . '-' . str_pad((string) (random_int(1, 9999)), 4, '0', STR_PAD_LEFT),
            'client_id' => Client::factory(),
            'device_id' => Device::factory(),
            'problem_description' => fake()->sentence(),
            'diagnosis' => fake()->sentence(),
            'status' => fake()->randomElement(['received', 'diagnosis', 'waiting_parts', 'repairing', 'completed', 'delivered', 'cancelled']),
            'priority' => fake()->randomElement(['low', 'medium', 'high', 'urgent']),
            'received_at' => now(),
            'estimated_completion_at' => now()->addDays(3),
            'completed_at' => null,
            'delivered_at' => null,
            'notes' => fake()->sentence(),
        ];
    }
}
