<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AgenteSeeder::class);

        // Obtener el primer agente de la tabla
        $primerAgente = \App\Models\Agente::first();

        if ($primerAgente) {
            User::factory()->create([
                'email' => 'admin@gmail.com',
                'rol' => 'administrador',
                'persona_id' => $primerAgente->id, // Usar el ID dinámico
                'password' => Hash::make('12345678'),
            ]);
        }
    }
}
