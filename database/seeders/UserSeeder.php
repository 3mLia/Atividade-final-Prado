<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Administrador para testes
        User::updateOrCreate(
            ['email' => 'admin@barbearia.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // Cliente para testes
        User::updateOrCreate(
            ['email' => 'cliente@barbearia.com'],
            [
                'name' => 'Cliente Teste',
                'password' => Hash::make('password'),
                'role' => 'cliente',
            ]
        );
    }
}