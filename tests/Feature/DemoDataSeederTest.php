<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\SparePart;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class DemoDataSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_demo_seeders_create_admin_accounts_and_sample_data(): void
    {
        Artisan::call('db:seed');

        $this->assertDatabaseHas('users', [
            'email' => 'amine.bensalem@sav.tn',
            'role' => 'admin',
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'sonia.trabelsi@sav.tn',
            'role' => 'receptionist',
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'yassine.gharbi@sav.tn',
            'role' => 'technician',
        ]);

        $this->assertGreaterThanOrEqual(3, Client::count());
        $this->assertGreaterThanOrEqual(3, Ticket::count());
        $this->assertGreaterThanOrEqual(3, SparePart::count());
        $this->assertGreaterThanOrEqual(1, User::query()->whereIn('role', ['admin', 'receptionist', 'technician'])->count());
    }
}
