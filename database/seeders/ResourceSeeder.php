<?php

namespace Database\Seeders;

use App\Models\Admin\Module;
use App\Models\Admin\Resource;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ResourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $admin = Module::where('code', 'administracion')->first();
        $sistema = Module::where('code', 'sistema')->first();
        $dashboardM = Module::where('code', 'dashboard')->first();
        // Dashboard
        $dashboard = Resource::firstOrCreate([
            'code' => 'dashboard_dashboard',
        ], [
            'module_id' => $dashboardM->id,
            'name' => 'DashBoard',
            'order' => 1,
            'is_active' => 1,
        ]);
        $dashboard->generatePermissions();
        // Usuarios
        $usuarios = Resource::firstOrCreate([
            'code' => 'administracion_usuarios',
        ], [
            'module_id' => $admin->id,
            'name' => 'Usuarios',
            'order' => 2,
            'is_active' => 1,
        ]);
        $usuarios->generatePermissions(); // 🔥 CLAVE
        // Roles
        $roles = Resource::firstOrCreate([
            'code' => 'administracion_roles',
        ], [
            'module_id' => $admin->id,
            'name' => 'Roles',
            'order' => 3,
            'is_active' => 1,
        ]);
        $roles->generatePermissions();
        // Permisos
        $permisos = Resource::firstOrCreate([
            'code' => 'administracion_permisos',
        ], [
            'module_id' => $admin->id,
            'name' => 'Permisos',
            'order' => 4,
            'is_active' => 1,
        ]);
        $permisos->generatePermissions();
        // Módulos
        $modulos = Resource::firstOrCreate([
            'code' => 'administracion_modulos',
        ], [
            'module_id' => $admin->id,
            'name' => 'Módulos',
            'order' => 5,
            'is_active' => 1,
        ]);
        $modulos->generatePermissions();
        // Recursos
        $recursos = Resource::firstOrCreate([
            'code' => 'administracion_recursos',
        ], [
            'module_id' => $admin->id,
            'name' => 'Recursos',
            'order' => 6,
            'is_active' => 1,
        ]);
        $recursos->generatePermissions();
        // 🔹 Datos Maestros
        $datosMaestros = Resource::firstOrCreate([
            'code' => 'sistema_datos_maestros',
        ], [
            'module_id' => $sistema->id,
            'name' => 'Datos Maestros',
            'order' => 7,
            'is_active' => 1,
        ]);
        $datosMaestros->generatePermissions();
        // // 🔹 Hijos
        // Resource::firstOrCreate([
        //     'code' => 'sistema_ciudades',
        // ], [
        //     'module_id' => $sistema->id,
        //     'parent_id' => $datosMaestros->id,
        //     'name' => 'Ciudades',
        //     'order' => 1,
        //     'is_active' => 1,
        // ]);

        // Resource::firstOrCreate([
        //     'code' => 'sistema_estados',
        // ], [
        //     'module_id' => $sistema->id,
        //     'parent_id' => $datosMaestros->id,
        //     'name' => 'Estados',
        //     'order' => 2,
        //     'is_active' => 1,
        // ]);
    }
}
