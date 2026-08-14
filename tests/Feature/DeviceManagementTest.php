<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeviceManagementTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function test_devices_index_page_loads(): void
    {
        $response = $this->actingAs($this->user)->get('/devices');

        $response->assertOk();
    }

    public function test_device_can_be_created(): void
    {
        $client = Client::factory()->create();

        $response = $this->actingAs($this->user)->post('/devices', [
            'client_id' => $client->id,
            'type' => 'smartphone',
            'brand' => 'Apple',
            'model' => 'iPhone 14',
            'serial_number' => 'ABC123456',
            'purchase_date' => '2024-01-15',
            'warranty_status' => 'in_warranty',
            'notes' => 'Appareil sous garantie.',
        ]);

        $response->assertRedirect('/devices');
        $this->assertDatabaseHas('devices', [
            'brand' => 'Apple',
            'model' => 'iPhone 14',
            'serial_number' => 'ABC123456',
        ]);
    }
}
