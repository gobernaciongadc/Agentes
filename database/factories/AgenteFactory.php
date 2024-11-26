<?php

namespace Database\Factories;

use App\Models\Municipio;
use App\Models\Persona;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Agente>
 */
class AgenteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'persona_id' => Persona::factory(),                   // Relación con persona
            'municipio_id' => Municipio::factory(),               // Relación con municipio
            'tipo_agente' => $this->faker->randomElement(['Notarios de Fe Pública', 'Jueces y Secretarios del Tribunal Departamental de Justicia', 'SEPREC', 'Derechos Reales', 'proceso sancionador administrativo']), // Tipo de agente
            'respaldo' => $this->faker->sentence(3),              // Respaldo como texto ficticio
            'estado' => $this->faker->numberBetween(0, 1),        // Estado activo/inactivo
            'created_at' => now(),                                // Fecha de creación
            'updated_at' => now(),                                // Fecha de actualización
        ];
    }
}
