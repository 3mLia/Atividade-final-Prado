<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            ['name' => 'Corte Masculino', 'description' => 'Corte na tesoura ou máquina', 'price' => 45.00, 'duration_minutes' => 30],
            ['name' => 'Barba Tradicional', 'description' => 'Barba com toalha quente', 'price' => 30.00, 'duration_minutes' => 20],
            ['name' => 'Corte + Barba', 'description' => 'Pacote completo', 'price' => 70.00, 'duration_minutes' => 50],
            ['name' => 'Sobrancelha', 'description' => 'Alinhamento com navalha ou pinça', 'price' => 15.00, 'duration_minutes' => 10],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}