<?php

namespace Database\Seeders;

use App\Models\Agente;
use App\Models\Municipio;
use App\Models\Persona;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AgenteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Crear 10 municipios
        Municipio::factory(10)->create()->each(function ($municipio) {
            // Para cada municipio, crear 5 personas
            $personas = Persona::factory(5)->create();

            // Para cada persona, crear un agente relacionado con el municipio
            $personas->each(function ($persona) use ($municipio) {
                Agente::factory()->create([
                    'persona_id' => $persona->id,
                    'municipio_id' => $municipio->id,
                ]);
            });
        });
    }
}