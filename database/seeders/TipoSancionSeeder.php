<?php

namespace Database\Seeders;

use App\Models\TipoSancion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoSancionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $tipos = [
            ['nombre' => 'Leve', 'descripcion' => 'Sanciones menores.'],
            ['nombre' => 'Grave', 'descripcion' => 'Sanciones que requieren atención.'],
            ['nombre' => 'Muy Grave', 'descripcion' => 'Sanciones críticas.']
        ];

        foreach ($tipos as $tipo) {
            TipoSancion::create($tipo);
        }
    }
}
