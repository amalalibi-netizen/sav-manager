<?php

namespace Tests\Feature;

use App\Models\Technician;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TechnicianManagementTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create(['role' => 'admin']);
    }

    public function test_technicians_index_page_loads(): void
    {
        $response = $this->actingAs($this->user)->get('/technicians');

        $response->assertOk();
    }

    public function test_technician_can_be_created(): void
    {
        $response = $this->actingAs($this->user)->post('/technicians', [
            'name' => 'Jean Dupont',
            'phone' => '06 12 34 56 78',
            'email' => 'jean@example.com',
        ]);

        $response->assertRedirect('/technicians');
        $this->assertDatabaseHas('technicians', [
            'name' => 'Jean Dupont',
            'phone' => '06 12 34 56 78',
            'email' => 'jean@example.com',
        ]);
    }
}
