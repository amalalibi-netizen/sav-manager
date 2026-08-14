<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\Device;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TicketManagementTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function test_tickets_index_page_loads(): void
    {
        $response = $this->actingAs($this->user)->get('/tickets');

        $response->assertOk();
    }

    public function test_ticket_can_be_created(): void
    {
        $client = Client::factory()->create();
        $device = Device::factory()->create(['client_id' => $client->id]);

        $response = $this->actingAs($this->user)->post('/tickets', [
            'client_id' => $client->id,
            'device_id' => $device->id,
            'problem_description' => 'Écran cassé',
            'status' => 'received',
            'priority' => 'high',
            'received_at' => now()->format('Y-m-d H:i:s'),
        ]);

        $response->assertRedirect('/tickets');
        $this->assertDatabaseHas('tickets', [
            'problem_description' => 'Écran cassé',
            'status' => 'received',
            'priority' => 'high',
        ]);
    }
}
