<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Persona>
 */
class PersonaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombres' => $this->faker->firstName(),  // Nombre aleatorio
            'apellidos' => $this->faker->lastName(), // Apellido aleatorio
            'carnet' => $this->faker->unique()->numberBetween(1000000, 9999999), // Número único simulado
            'correo_electronico' => $this->faker->unique()->safeEmail(), // Correo electrónico único
            'telefono' => $this->faker->phoneNumber(), // Teléfono aleatorio
            'direccion' => $this->faker->address(), // Dirección aleatoria
            'created_at' => now(), // Fecha y hora actual
            'updated_at' => now(), // Fecha y hora actual
        ];
    }
}
