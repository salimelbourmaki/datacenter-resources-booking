<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin
        User::updateOrCreate(
            ['email' => 'admin@datacenter.com'],
            [
                'name' => 'Admin User',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role' => 'admin',
                'is_active' => true,
            ]
        );

        // Responsable
        User::updateOrCreate(
            ['email' => 'responsable@datacenter.com'],
            [
                'name' => 'Responsable Unit',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role' => 'responsable',
                'is_active' => true,
            ]
        );

        // User
        User::updateOrCreate(
            ['email' => 'user@datacenter.com'],
            [
                'name' => 'Standard User',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role' => 'user',
                'is_active' => true,
            ]
        );

        // Creator (Salim)
        $creator = User::updateOrCreate(
            ['email' => 'salim@datacenter.com'],
            [
                'name' => 'Salim (Creator)',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role' => 'admin',
                'is_active' => true,
            ]
        );

        // --- SEEDING RESOURCES ---
        $responsable = User::where('email', 'responsable@datacenter.com')->first();
        
        if ($responsable) {
            $resources = [
                [
                    'name' => 'Serveur Dell PowerEdge R740',
                    'type' => 'Physique',
                    'category' => 'Server',
                    'cpu' => 32,
                    'ram' => 128,
                    'storage_capacity' => 2000,
                    'storage_type' => 'SSD NVMe',
                    'location' => 'Salle A - Rack 01',
                    'status' => 'disponible',
                ],
                [
                    'name' => 'HP ProLiant DL380 Gen10',
                    'type' => 'Physique',
                    'category' => 'Server',
                    'cpu' => 24,
                    'ram' => 64,
                    'storage_capacity' => 4000,
                    'storage_type' => 'HDD SAS',
                    'location' => 'Salle A - Rack 02',
                    'status' => 'disponible',
                ],
                [
                    'name' => 'VM-Web-Production-01',
                    'type' => 'Virtuel',
                    'category' => 'Virtual Machine',
                    'cpu' => 4,
                    'ram' => 16,
                    'storage_capacity' => 100,
                    'storage_type' => 'SSD',
                    'os' => 'Ubuntu 22.04 LTS',
                    'location' => 'Cluster Proxmox A',
                    'status' => 'disponible',
                ],
                [
                    'name' => 'VM-Database-PostgreSQL',
                    'type' => 'Virtuel',
                    'category' => 'Virtual Machine',
                    'cpu' => 8,
                    'ram' => 32,
                    'storage_capacity' => 500,
                    'storage_type' => 'SSD',
                    'os' => 'Debian 12',
                    'location' => 'Cluster Proxmox A',
                    'status' => 'disponible',
                ],
                [
                    'name' => 'Baie SAN EMC Unity 300',
                    'type' => 'Hardware',
                    'category' => 'Storage',
                    'storage_capacity' => 50000,
                    'storage_type' => 'Mixed SSD/HDD',
                    'location' => 'Salle B - Rack 05',
                    'status' => 'disponible',
                ],
                [
                    'name' => 'NAS TrueNAS Sauvegarde',
                    'type' => 'Hardware',
                    'category' => 'Storage',
                    'storage_capacity' => 100000,
                    'storage_type' => 'HDD SATA',
                    'location' => 'Salle C - Rack 01',
                    'status' => 'disponible',
                ],
                [
                    'name' => 'Switch Cisco Nexus 9300',
                    'type' => 'Reseau',
                    'category' => 'Network Equipment',
                    'bandwidth' => '40 Gbps',
                    'location' => 'Salle A - Top of Rack',
                    'status' => 'disponible',
                ],
                [
                    'name' => 'Pare-feu FortiGate 100F',
                    'type' => 'Reseau',
                    'category' => 'Network Equipment',
                    'bandwidth' => '20 Gbps',
                    'location' => 'Entrée Data Center',
                    'status' => 'disponible',
                ],
                [
                    'name' => 'Routeur Juniper MX204',
                    'type' => 'Reseau',
                    'category' => 'Network Equipment',
                    'bandwidth' => '100 Gbps',
                    'location' => 'Cœur de Réseau',
                    'status' => 'disponible',
                ],
                [
                    'name' => 'VM-Dev-Environment',
                    'type' => 'Virtuel',
                    'category' => 'Virtual Machine',
                    'cpu' => 2,
                    'ram' => 8,
                    'storage_capacity' => 50,
                    'storage_type' => 'SSD',
                    'os' => 'CentOS Stream 9',
                    'location' => 'Cluster Dev',
                    'status' => 'maintenance',
                ],
            ];

            foreach ($resources as $resData) {
                \App\Models\Resource::updateOrCreate(
                    ['name' => $resData['name']],
                    array_merge($resData, ['manager_id' => $responsable->id])
                );
            }
        }
    }
}
