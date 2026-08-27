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

    public function test_spare_part_can_be_updated_without_changing_reference_code(): void
    {
        $sparePart = SparePart::factory()->create([
            'name' => 'Écran LCD',
            'reference_code' => 'LCD-001',
            'quantity_in_stock' => 10,
        ]);

        $response = $this->actingAs($this->user)->put("/spare-parts/{$sparePart->id}", [
            'name' => 'Écran LCD 6.1',
            'reference_code' => 'LCD-001',
            'description' => 'Écran mis à jour',
            'unit_cost' => 49.90,
            'quantity_in_stock' => 8,
            'minimum_stock' => 3,
            'supplier' => 'Fournisseur XYZ',
        ]);

        $response->assertRedirect('/spare-parts');
        $this->assertDatabaseHas('spare_parts', [
            'id' => $sparePart->id,
            'name' => 'Écran LCD 6.1',
            'reference_code' => 'LCD-001',
            'quantity_in_stock' => 8,
        ]);
    }

    public function test_spare_part_update_rejects_duplicate_reference_code(): void
    {
        SparePart::factory()->create(['reference_code' => 'LCD-001']);
        $sparePart = SparePart::factory()->create(['reference_code' => 'BAT-015']);

        $response = $this->actingAs($this->user)->from("/spare-parts/{$sparePart->id}/edit")->put("/spare-parts/{$sparePart->id}", [
            'name' => $sparePart->name,
            'reference_code' => 'LCD-001',
            'description' => $sparePart->description,
            'unit_cost' => $sparePart->unit_cost,
            'quantity_in_stock' => $sparePart->quantity_in_stock,
            'minimum_stock' => $sparePart->minimum_stock,
            'supplier' => $sparePart->supplier,
        ]);

        $response->assertRedirect("/spare-parts/{$sparePart->id}/edit");
        $response->assertSessionHasErrors('reference_code');
        $this->assertDatabaseHas('spare_parts', [
            'id' => $sparePart->id,
            'reference_code' => 'BAT-015',
        ]);
    }
}
