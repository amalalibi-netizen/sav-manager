<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\Device;
use App\Models\SparePart;
use App\Models\Technician;
use App\Models\Ticket;
use App\Models\User;
use App\Notifications\LowStockNotification;
use App\Notifications\RepairCreatedNotification;
use App\Notifications\StatusChangedNotification;
use App\Notifications\TicketCreatedNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class EmailNotificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_ticket_creation_sends_email_to_client(): void
    {
        Notification::fake();

        $user = User::factory()->create();
        $client = Client::factory()->create(['email' => 'client@example.com']);
        $device = Device::factory()->create(['client_id' => $client->id]);

        $this->actingAs($user)->post('/tickets', [
            'client_id' => $client->id,
            'device_id' => $device->id,
            'problem_description' => 'Écran cassé',
            'status' => 'received',
            'priority' => 'high',
            'received_at' => now()->format('Y-m-d H:i:s'),
        ])->assertRedirect('/tickets');

        Notification::assertSentOnDemand(TicketCreatedNotification::class);
    }

    public function test_ticket_status_change_sends_existing_notification(): void
    {
        Notification::fake();

        $user = User::factory()->create();
        $client = Client::factory()->create(['email' => 'client@example.com']);
        $device = Device::factory()->create(['client_id' => $client->id]);
        $ticket = Ticket::factory()->create([
            'client_id' => $client->id,
            'device_id' => $device->id,
            'status' => 'received',
        ]);

        $this->actingAs($user)->put("/tickets/{$ticket->id}", [
            'client_id' => $client->id,
            'device_id' => $device->id,
            'problem_description' => $ticket->problem_description,
            'status' => 'diagnosis',
            'priority' => $ticket->priority,
        ])->assertRedirect('/tickets');

        Notification::assertSentOnDemand(StatusChangedNotification::class);
    }

    public function test_repair_creation_sends_email_to_client(): void
    {
        Notification::fake();

        $user = User::factory()->create(['role' => 'technician']);
        $client = Client::factory()->create(['email' => 'client@example.com']);
        $device = Device::factory()->create(['client_id' => $client->id]);
        $technician = Technician::factory()->create();
        $ticket = Ticket::factory()->create([
            'client_id' => $client->id,
            'device_id' => $device->id,
        ]);

        $this->actingAs($user)->post('/repairs', [
            'ticket_id' => $ticket->id,
            'technician_id' => $technician->id,
            'diagnosis' => 'Carte mère défectueuse',
            'repair_description' => 'Remplacement de la carte mère',
            'parts_used' => 'Carte mère',
            'labor_cost' => 45.00,
            'parts_cost' => 120.50,
            'total_cost' => 165.50,
            'status' => 'in_progress',
        ])->assertRedirect('/repairs');

        Notification::assertSentOnDemand(RepairCreatedNotification::class);
    }

    public function test_low_stock_notifies_admins_on_spare_part_update(): void
    {
        Notification::fake();

        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create(['role' => 'receptionist']);
        $sparePart = SparePart::factory()->create([
            'quantity_in_stock' => 10,
            'minimum_stock' => 3,
        ]);

        $this->actingAs($user)->put("/spare-parts/{$sparePart->id}", [
            'name' => $sparePart->name,
            'reference_code' => $sparePart->reference_code,
            'description' => $sparePart->description,
            'unit_cost' => $sparePart->unit_cost,
            'quantity_in_stock' => 2,
            'minimum_stock' => 3,
            'supplier' => $sparePart->supplier,
        ])->assertRedirect('/spare-parts');

        Notification::assertSentTo($admin, LowStockNotification::class);
    }
}
