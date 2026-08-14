<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClientManagementTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function test_clients_index_page_loads(): void
    {
        $response = $this->actingAs($this->user)->get('/clients');

        $response->assertOk();
    }

    public function test_client_can_be_created(): void
    {
        $response = $this->actingAs($this->user)->post('/clients', [
            'first_name' => 'Amine',
            'last_name' => 'Ben Ali',
            'phone' => '+216 12 345 678',
            'email' => 'amine@example.com',
            'address' => 'Avenue de la République 123',
            'city' => 'Tunis',
            'notes' => 'Client VIP',
        ]);

        $response->assertRedirect('/clients');
        $this->assertDatabaseHas('clients', [
            'first_name' => 'Amine',
            'last_name' => 'Ben Ali',
            'city' => 'Tunis',
        ]);
    }
}
