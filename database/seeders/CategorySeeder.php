<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Server', 
                'description' => 'Serveurs physiques dédiés (Blade, Rack, Tower)'
            ],
            [
                'name' => 'Virtual Machine', 
                'description' => 'Machines virtuelles (vCPU, RAM, Stockage)'
            ],
            [
                'name' => 'Storage', 
                'description' => 'Espace de stockage (SAN, NAS, Object Storage)'
            ],
            [
                'name' => 'Network Equipment', 
                'description' => 'Switch, Routeur, Firewall, Load Balancer'
            ],
        ];

        foreach ($categories as $category) {
            \App\Models\Category::create($category);
        }
    }
}
