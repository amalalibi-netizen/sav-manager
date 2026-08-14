<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_receptionist_cannot_access_technician_management(): void
    {
        $user = User::factory()->create([
            'role' => 'receptionist',
        ]);

        $this->actingAs($user)
            ->get(route('technicians.create'))
            ->assertStatus(403);
    }

    public function test_technician_can_access_repair_management(): void
    {
        $user = User::factory()->create([
            'role' => 'technician',
        ]);

        $this->actingAs($user)
            ->get(route('repairs.index'))
            ->assertOk();
    }
}
