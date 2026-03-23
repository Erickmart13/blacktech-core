<?php

namespace Database\Seeders;

use App\Models\Admin\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        // === Crear roles ===
        $admin = Role::firstOrCreate(['name' => 'Administrador']);
        $operador = Role::firstOrCreate(['name' => 'Operador']);

        // === Asignar permisos ===
        $admin->syncPermissions(\Spatie\Permission\Models\Permission::all());
       

        // === Asignar rol al usuario 1 ===
        $user = User::find(1);
        if ($user && !$user->hasRole('Administrador')) {
            $user->assignRole('Administrador');
        }

        $this->command->info('✅ Permisos y roles actualizados correctamente.');
    }
}
