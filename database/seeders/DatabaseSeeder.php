<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Device;
use App\Models\Repair;
use App\Models\SparePart;
use App\Models\Technician;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::query()->create([
            'name' => 'Admin SAV',
            'email' => 'admin@savmanager.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::query()->create([
            'name' => 'Réception SAV',
            'email' => 'reception@savmanager.test',
            'password' => Hash::make('password'),
            'role' => 'receptionist',
        ]);

        User::query()->create([
            'name' => 'Technicien SAV',
            'email' => 'tech@savmanager.test',
            'password' => Hash::make('password'),
            'role' => 'technician',
        ]);

        User::factory()->count(4)->create(['role' => 'technician']);
        User::factory()->count(3)->create(['role' => 'receptionist']);

        $clients = Client::factory()->count(6)->create();
        $devices = Device::factory()->count(10)->create();

        foreach ($clients as $index => $client) {
            $device = $devices->shuffle()->first();
            if ($device) {
                $device->update(['client_id' => $client->id]);
            }
        }

        $tickets = [];
        foreach ($clients as $index => $client) {
            $device = Device::query()->where('client_id', $client->id)->first() ?? Device::query()->inRandomOrder()->first();

            $tickets[] = [
                'ticket_number' => 'SAV-' . now()->format('Y') . '-' . str_pad((string) ($index + 1), 4, '0', STR_PAD_LEFT),
                'client_id' => $client->id,
                'device_id' => $device?->id,
                'problem_description' => ['Écran fissuré', 'Batterie ne tient plus la charge', 'Problème de charge USB', 'Smartphone ne démarre plus', 'Son défectueux', 'Connexion Wi-Fi instable'][$index % 6],
                'diagnosis' => ['Remplacement d’écran requis', 'Batterie à remplacer', 'Contrôleur de charge défectueux', 'Problème logiciel réinitialisation nécessaire', 'Enceinte défectueuse', 'Carte réseau à vérifier'][$index % 6],
                'status' => ['received', 'diagnosis', 'waiting_parts', 'repairing', 'completed', 'delivered'][min($index, 5)],
                'priority' => ['low', 'medium', 'high', 'urgent'][min($index, 3)],
                'received_at' => now()->subDays(rand(1, 20)),
                'estimated_completion_at' => now()->addDays(rand(1, 6)),
                'completed_at' => $index > 2 ? now()->subDays(rand(1, 5)) : null,
                'delivered_at' => $index > 4 ? now()->subDays(rand(1, 3)) : null,
                'notes' => 'Données de démonstration SAV Manager.',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Ticket::query()->insert($tickets);

        $technicians = Technician::factory()->count(4)->create();
        $ticketIds = Ticket::query()->pluck('id')->all();

        foreach ($ticketIds as $index => $ticketId) {
            if ($index >= count($technicians)) {
                break;
            }

            Repair::factory()->create([
                'ticket_id' => $ticketId,
                'technician_id' => $technicians[$index]->id,
                'status' => ['pending', 'in_progress', 'completed', 'waiting_parts', 'completed'][min($index, 4)],
                'labor_cost' => rand(30, 180),
                'parts_cost' => rand(12, 120),
                'total_cost' => rand(60, 250),
            ]);
        }

        SparePart::query()->insert([
            [
                'name' => 'Écran smartphone 6.1',
                'description' => 'Écran tactile compatible modèles récents.',
                'reference_code' => 'ECR-6-1',
                'unit_cost' => 54.90,
                'quantity_in_stock' => 8,
                'minimum_stock' => 3,
                'supplier' => 'Apex Components',
                'notes' => 'Stock prioritaire.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Batterie portable 15 pouces',
                'description' => 'Batterie haute capacité pour ordinateurs portables.',
                'reference_code' => 'BAT-15',
                'unit_cost' => 62.50,
                'quantity_in_stock' => 4,
                'minimum_stock' => 2,
                'supplier' => 'PowerCell',
                'notes' => 'À commander si baisse.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cable USB-C',
                'description' => 'Câble de charge rapide.',
                'reference_code' => 'USB-C-1M',
                'unit_cost' => 12.00,
                'quantity_in_stock' => 18,
                'minimum_stock' => 5,
                'supplier' => 'ConnectPro',
                'notes' => 'Très demandé.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bouton de volume',
                'description' => 'Pièce de remplacement pour smartphones.',
                'reference_code' => 'VOL-01',
                'unit_cost' => 8.75,
                'quantity_in_stock' => 11,
                'minimum_stock' => 4,
                'supplier' => 'TechReplace',
                'notes' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        SparePart::factory()->count(6)->create();
    }
}
