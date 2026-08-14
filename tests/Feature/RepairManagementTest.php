<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\Device;
use App\Models\Technician;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RepairManagementTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create(['role' => 'technician']);
    }

    public function test_repairs_index_page_loads(): void
    {
        $response = $this->actingAs($this->user)->get('/repairs');

        $response->assertOk();
    }

    public function test_repair_can_be_created(): void
    {
        $client = Client::factory()->create();
        $device = Device::factory()->create(['client_id' => $client->id]);
        $technician = Technician::factory()->create();
        $ticket = Ticket::factory()->create([
            'client_id' => $client->id,
            'device_id' => $device->id,
        ]);

        $response = $this->actingAs($this->user)->post('/repairs', [
            'ticket_id' => $ticket->id,
            'technician_id' => $technician->id,
            'diagnosis' => 'Carte mère défectueuse',
            'repair_description' => 'Remplacement de la carte mère',
            'parts_used' => 'Carte mère',
            'labor_cost' => 45.00,
            'parts_cost' => 120.50,
            'total_cost' => 165.50,
            'status' => 'in_progress',
        ]);

        $response->assertRedirect('/repairs');
        $this->assertDatabaseHas('repairs', [
            'diagnosis' => 'Carte mère défectueuse',
            'status' => 'in_progress',
        ]);
    }
}
