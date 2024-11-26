<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Municipio>
 */
class MunicipioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->city(),              // Nombre de ciudad
            'provincia' => $this->faker->randomElement(['Arani', 'Arque', 'Ayopaya', 'Bolívar', 'Campero', 'Capinota', 'Carrasco', 'Cercado', 'chapare', 'Esteban Arze', 'Germán Jordán', 'Mizque', 'Punata', 'Quillacollo', 'Tapacarí', 'Tiraque']), // Provincias 
            'estado' => $this->faker->numberBetween(0, 1), // Estado activo/inactivo
            'created_at' => now(),                         // Fecha de creación
            'updated_at' => now(),                         // Fecha de actualización
        ];
    }
}
