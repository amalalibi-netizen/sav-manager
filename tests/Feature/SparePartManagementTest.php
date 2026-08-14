<?php

namespace Tests\Feature;

use App\Models\SparePart;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SparePartManagementTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create(['role' => 'receptionist']);
    }

    public function test_spare_parts_index_page_loads(): void
    {
        $response = $this->actingAs($this->user)->get('/spare-parts');

        $response->assertOk();
    }

    public function test_spare_part_can_be_created(): void
    {
        $response = $this->actingAs($this->user)->post('/spare-parts', [
            'name' => 'Écran LCD',
            'reference_code' => 'LCD-001',
            'description' => 'Écran LCD pour smartphone',
            'unit_cost' => 45.50,
            'quantity_in_stock' => 10,
            'minimum_stock' => 3,
            'supplier' => 'Fournisseur XYZ',
        ]);

        $response->assertRedirect('/spare-parts');
        $this->assertDatabaseHas('spare_parts', [
            'name' => 'Écran LCD',
            'reference_code' => 'LCD-001',
        ]);
    }
}
