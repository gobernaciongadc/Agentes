<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role; // Asegúrate de importar correctamente la clase
use App\Models\User;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Crear roles si no existen
        $adminRole = Role::firstOrCreate(['name' => 'Administrador']);
        $agenteRole = Role::firstOrCreate(['name' => 'Agente']);

        $this->command->info('Roles creados o ya existentes: "Administrador" y "Agente".');


        // Asignar rol 'Administrador' al usuario con ID 1
        $admin = User::find(1);
        if ($admin) {
            $admin->assignRole($adminRole);
            $this->command->info('Rol "Administrador" asignado al usuario con ID 1.');
        } else {
            $this->command->warn('El usuario con ID 1 no existe. No se asignó el rol.');
        }
    }
}
