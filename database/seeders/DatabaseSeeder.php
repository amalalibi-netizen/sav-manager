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
            'name' => 'Amine Ben Salem',
            'email' => 'amine.bensalem@sav.tn',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::query()->create([
            'name' => 'Sonia Trabelsi',
            'email' => 'sonia.trabelsi@sav.tn',
            'password' => Hash::make('password'),
            'role' => 'receptionist',
        ]);

        User::query()->create([
            'name' => 'Yassine Gharbi',
            'email' => 'yassine.gharbi@sav.tn',
            'password' => Hash::make('password'),
            'role' => 'technician',
        ]);

        User::query()->insert([
            ['name' => 'Hatem Jlassi', 'email' => 'hatem.jlassi@sav.tn', 'password' => Hash::make('password'), 'role' => 'technician', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Meriem Karray', 'email' => 'meriem.karray@sav.tn', 'password' => Hash::make('password'), 'role' => 'technician', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Walid Chaabane', 'email' => 'walid.chaabane@sav.tn', 'password' => Hash::make('password'), 'role' => 'technician', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Nour Ben Amor', 'email' => 'nour.benamor@sav.tn', 'password' => Hash::make('password'), 'role' => 'technician', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Ines Mejri', 'email' => 'ines.mejri@sav.tn', 'password' => Hash::make('password'), 'role' => 'receptionist', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Karim Saidi', 'email' => 'karim.saidi@sav.tn', 'password' => Hash::make('password'), 'role' => 'receptionist', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Olfa Dridi', 'email' => 'olfa.dridi@sav.tn', 'password' => Hash::make('password'), 'role' => 'receptionist', 'created_at' => now(), 'updated_at' => now()],
        ]);

        $clients = collect([
            ['first_name' => 'Mohamed', 'last_name' => 'Ben Youssef', 'phone' => '+216 20 458 731', 'email' => 'mohamed.benyoussef@gmail.com', 'address' => '12 rue du Lac Turkana', 'city' => 'Tunis', 'notes' => 'Préfère être contacté par téléphone.'],
            ['first_name' => 'Aïcha', 'last_name' => 'Mansouri', 'phone' => '+216 52 316 904', 'email' => 'aicha.mansouri@outlook.com', 'address' => '8 avenue de l Environnement', 'city' => 'Sfax', 'notes' => 'Demande un devis avant réparation.'],
            ['first_name' => 'Fares', 'last_name' => 'Bouazizi', 'phone' => '+216 98 742 165', 'email' => 'fares.bouazizi@gmail.com', 'address' => '25 rue de la République', 'city' => 'Sousse', 'notes' => 'Client professionnel.'],
            ['first_name' => 'Nesrine', 'last_name' => 'Khalfallah', 'phone' => '+216 27 890 412', 'email' => 'nesrine.khalfallah@yahoo.com', 'address' => '4 rue Ibn Khaldoun', 'city' => 'Ariana', 'notes' => 'Appareil utilisé pour le télétravail.'],
            ['first_name' => 'Sami', 'last_name' => 'Haddad', 'phone' => '+216 22 174 638', 'email' => 'sami.haddad@gmail.com', 'address' => '17 avenue Habib Bourguiba', 'city' => 'Nabeul', 'notes' => 'Récupération en boutique.'],
            ['first_name' => 'Rim', 'last_name' => 'Cherif', 'phone' => '+216 55 603 287', 'email' => 'rim.cherif@proton.me', 'address' => '31 rue de Marseille', 'city' => 'Ben Arous', 'notes' => 'Sauvegarde des données demandée.'],
        ])->map(fn (array $client) => Client::query()->create($client));

        $devices = collect([
            ['type' => 'smartphone', 'brand' => 'Samsung', 'model' => 'Galaxy S23', 'serial_number' => 'R58W91M7K3A', 'purchase_date' => '2023-04-18', 'warranty_status' => 'expired', 'notes' => 'Écran AMOLED et coque arrière endommagés.'],
            ['type' => 'smartphone', 'brand' => 'Apple', 'model' => 'iPhone 13', 'serial_number' => 'F2LQH8N7P1', 'purchase_date' => '2022-09-06', 'warranty_status' => 'expired', 'notes' => 'Chargeur fourni avec l appareil.'],
            ['type' => 'smartphone', 'brand' => 'Xiaomi', 'model' => 'Redmi Note 12 Pro', 'serial_number' => '2A4K9X7MPL', 'purchase_date' => '2023-07-22', 'warranty_status' => 'in_warranty', 'notes' => 'Acheté auprès d un revendeur local.'],
            ['type' => 'laptop', 'brand' => 'Dell', 'model' => 'Latitude 5420', 'serial_number' => 'DL5420TN8842', 'purchase_date' => '2021-11-12', 'warranty_status' => 'expired', 'notes' => 'Disque SSD conservé par le client.'],
            ['type' => 'laptop', 'brand' => 'HP', 'model' => 'Pavilion 15-eg', 'serial_number' => '5CD2148KQ9', 'purchase_date' => '2024-02-03', 'warranty_status' => 'in_warranty', 'notes' => 'Mot de passe Windows communiqué à l accueil.'],
            ['type' => 'laptop', 'brand' => 'Lenovo', 'model' => 'ThinkPad E14 Gen 4', 'serial_number' => 'PF4L8N2C7T', 'purchase_date' => '2022-05-27', 'warranty_status' => 'expired', 'notes' => 'Utilisé en entreprise.'],
            ['type' => 'tv', 'brand' => 'Sony', 'model' => 'Bravia KD-55X80K', 'serial_number' => 'SNY55TN23019', 'purchase_date' => '2022-12-15', 'warranty_status' => 'expired', 'notes' => 'Télécommande déposée avec le téléviseur.'],
            ['type' => 'smartphone', 'brand' => 'Samsung', 'model' => 'Galaxy A54', 'serial_number' => 'RF8T61C0V5N', 'purchase_date' => '2023-10-09', 'warranty_status' => 'in_warranty', 'notes' => 'Diagnostic sous garantie à confirmer.'],
            ['type' => 'laptop', 'brand' => 'HP', 'model' => 'EliteBook 840 G8', 'serial_number' => 'CND1487QW6', 'purchase_date' => '2021-08-30', 'warranty_status' => 'expired', 'notes' => 'Batterie très usée.'],
            ['type' => 'console', 'brand' => 'Sony', 'model' => 'PlayStation 5', 'serial_number' => 'FCM23TN64108', 'purchase_date' => '2021-03-19', 'warranty_status' => 'expired', 'notes' => 'Manette non incluse dans le dépôt.'],
        ])->map(fn (array $device, int $index) => Device::query()->create($device + ['client_id' => $clients[$index % $clients->count()]->id]));

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
                'problem_description' => ['Écran fissuré après une chute', 'Batterie se décharge en quelques heures', 'Le téléphone ne charge plus par USB-C', 'Ordinateur portable très lent au démarrage', 'Téléviseur sans image mais avec du son', 'Connexion Wi-Fi instable et coupures fréquentes'][$index % 6],
                'diagnosis' => ['Vitre et dalle AMOLED endommagées, remplacement requis', 'Capacité de batterie inférieure à 70 %, remplacement conseillé', 'Connecteur USB-C oxydé et nappe de charge à remplacer', 'SSD saturé et système à nettoyer, test matériel normal', 'Rétroéclairage LED défaillant, devis en attente', 'Carte Wi-Fi et pilote à contrôler après réinitialisation réseau'][$index % 6],
                'status' => ['received', 'diagnosis', 'waiting_parts', 'repairing', 'completed', 'delivered'][min($index, 5)],
                'priority' => ['low', 'medium', 'high', 'urgent'][min($index, 3)],
                'received_at' => now()->subDays(rand(1, 20)),
                'estimated_completion_at' => now()->addDays(rand(1, 6)),
                'completed_at' => $index > 2 ? now()->subDays(rand(1, 5)) : null,
                'delivered_at' => $index > 4 ? now()->subDays(rand(1, 3)) : null,
                'notes' => ['Client informé du délai estimatif.', 'Sauvegarde des données recommandée avant intervention.', 'Pièce disponible chez le fournisseur local.', 'Devis transmis par e-mail.', 'Appareil testé à la réception.', 'Client à rappeler dès validation du diagnostic.'][$index % 6],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Ticket::query()->insert($tickets);

        $technicians = collect([
            ['name' => 'Hichem Ben Romdhane', 'phone' => '+216 24 581 936', 'email' => 'hichem.benromdhane@sav.tn'],
            ['name' => 'Sabrine Ayari', 'phone' => '+216 29 437 802', 'email' => 'sabrine.ayari@sav.tn'],
            ['name' => 'Khaled Guesmi', 'phone' => '+216 53 762 418', 'email' => 'khaled.guesmi@sav.tn'],
            ['name' => 'Moez Ben Salem', 'phone' => '+216 26 195 374', 'email' => 'moez.bensalem@sav.tn'],
        ])->map(fn (array $technician) => Technician::query()->create($technician));
        $ticketIds = Ticket::query()->pluck('id')->all();
        $repairDetails = [
            ['diagnosis' => 'Dalle AMOLED et vitre tactile fissurées après impact.', 'repair_description' => 'Remplacement de l écran, montage du châssis et test tactile.', 'parts_used' => 'Écran AMOLED Samsung Galaxy S23', 'labor_cost' => 70, 'parts_cost' => 385, 'total_cost' => 455],
            ['diagnosis' => 'Batterie usée avec capacité mesurée à 68 %.', 'repair_description' => 'Remplacement de la batterie et contrôle de l autonomie sur cycle complet.', 'parts_used' => 'Batterie compatible iPhone 13', 'labor_cost' => 55, 'parts_cost' => 150, 'total_cost' => 205],
            ['diagnosis' => 'Connecteur USB-C oxydé, charge intermittente confirmée.', 'repair_description' => 'Nettoyage de la carte, remplacement de la nappe et test de charge rapide.', 'parts_used' => 'Connecteur de charge USB-C', 'labor_cost' => 45, 'parts_cost' => 28, 'total_cost' => 73],
            ['diagnosis' => 'SSD presque saturé et batterie en fin de vie.', 'repair_description' => 'Remplacement du SSD, installation système et transfert des données validé.', 'parts_used' => 'SSD NVMe 512 Go', 'labor_cost' => 90, 'parts_cost' => 145, 'total_cost' => 235],
        ];

        foreach ($ticketIds as $index => $ticketId) {
            if ($index >= count($technicians)) {
                break;
            }

            Repair::query()->create($repairDetails[$index] + [
                'ticket_id' => $ticketId,
                'technician_id' => $technicians[$index]->id,
                'status' => ['pending', 'in_progress', 'completed', 'waiting_parts', 'completed'][min($index, 4)],
            ]);
        }

        SparePart::query()->insert([
            [
                'name' => 'Écran AMOLED Samsung Galaxy S23',
                'description' => 'Dalle AMOLED avec châssis et vitre tactile pour Galaxy S23.',
                'reference_code' => 'SAM-S23-DAL',
                'unit_cost' => 385.00,
                'quantity_in_stock' => 8,
                'minimum_stock' => 3,
                'supplier' => 'Tunisia Mobile Parts - Tunis',
                'notes' => 'Stock prioritaire pour réparations smartphones.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Batterie Dell Latitude 5420',
                'description' => 'Batterie interne 63 Wh compatible Dell Latitude 5420.',
                'reference_code' => 'DEL-5420-BAT',
                'unit_cost' => 245.00,
                'quantity_in_stock' => 4,
                'minimum_stock' => 2,
                'supplier' => 'Sotetel Informatique - Ariana',
                'notes' => 'À commander si le stock passe sous deux unités.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Connecteur de charge USB-C',
                'description' => 'Port USB-C et nappe de charge pour smartphones Android.',
                'reference_code' => 'USB-C-AND-01',
                'unit_cost' => 28.00,
                'quantity_in_stock' => 18,
                'minimum_stock' => 5,
                'supplier' => 'GSM Distribution Sfax',
                'notes' => 'Très demandé pour les diagnostics de charge.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Nappe bouton volume iPhone 13',
                'description' => 'Nappe et boutons latéraux de remplacement pour iPhone 13.',
                'reference_code' => 'APL-IP13-VOL',
                'unit_cost' => 42.00,
                'quantity_in_stock' => 11,
                'minimum_stock' => 4,
                'supplier' => 'Apple Service Parts Tunisie',
                'notes' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        SparePart::query()->insert([
            [
                'name' => 'Batterie Xiaomi Redmi Note 12 Pro',
                'description' => 'Batterie interne 5000 mAh pour Redmi Note 12 Pro.',
                'reference_code' => 'XIA-RN12-BAT',
                'unit_cost' => 75.00,
                'quantity_in_stock' => 6,
                'minimum_stock' => 2,
                'supplier' => 'GSM Distribution Sfax',
                'notes' => 'Contrôler la capacité avant remise au client.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Clavier HP Pavilion 15-eg',
                'description' => 'Clavier AZERTY français avec rétroéclairage.',
                'reference_code' => 'HP-PAV15-KEY',
                'unit_cost' => 115.00,
                'quantity_in_stock' => 3,
                'minimum_stock' => 1,
                'supplier' => 'Sotetel Informatique - Ariana',
                'notes' => 'Vérifier la disposition AZERTY à la commande.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dalle écran Lenovo ThinkPad E14',
                'description' => 'Écran 14 pouces Full HD IPS compatible ThinkPad E14 Gen 4.',
                'reference_code' => 'LEN-E14-DAL',
                'unit_cost' => 290.00,
                'quantity_in_stock' => 2,
                'minimum_stock' => 1,
                'supplier' => 'Pro Laptop Services Tunis',
                'notes' => 'Pièce fragile, stockage dans l armoire dédiée.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bandes LED Sony Bravia 55 pouces',
                'description' => 'Kit de rétroéclairage LED pour Sony Bravia KD-55X80K.',
                'reference_code' => 'SNY-X80K-LED',
                'unit_cost' => 180.00,
                'quantity_in_stock' => 1,
                'minimum_stock' => 1,
                'supplier' => 'Electro Pièces Sousse',
                'notes' => 'Commander uniquement après confirmation du diagnostic.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'SSD NVMe 512 Go',
                'description' => 'Disque SSD NVMe PCIe 3.0 pour ordinateurs portables.',
                'reference_code' => 'SSD-NVME-512',
                'unit_cost' => 145.00,
                'quantity_in_stock' => 7,
                'minimum_stock' => 2,
                'supplier' => 'MyTek Business - Tunis',
                'notes' => 'Clonage des données à valider avec le client.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ventilateur PlayStation 5',
                'description' => 'Ventilateur de refroidissement de remplacement pour PlayStation 5.',
                'reference_code' => 'SNY-PS5-FAN',
                'unit_cost' => 165.00,
                'quantity_in_stock' => 2,
                'minimum_stock' => 1,
                'supplier' => 'Console Parts Nabeul',
                'notes' => 'Tester le niveau sonore après montage.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
