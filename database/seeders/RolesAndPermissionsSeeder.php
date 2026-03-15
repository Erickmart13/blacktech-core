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
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [

            [
                'name' => 'dashboard.inicio',
                'type' => 'DashBoard',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'dashboard.clientes',
                'type' => 'DashBoard',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Roles
            [
                'name' => 'roles.inicio',
                'type' => 'Roles',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'roles.crear',
                'type' => 'Roles',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'roles.ver',
                'type' => 'Roles',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'roles.editar',
                'type' => 'Roles',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'roles.eliminar',
                'type' => 'Roles',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Permisos
            
            [
                'name' => 'modulos.inicio',
                'type' => 'Modulos',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'modulos.crear',
                'type' => 'Modulos',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'modulos.ver',
                'type' => 'Modulos',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'modulos.editar',
                'type' => 'Modulos',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'modulos.eliminar',
                'type' => 'Modulos',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],


            // Operaciones
            [
                'name' => 'operaciones.inicio',
                'type' => 'Operaciones',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'operaciones.crear',
                'type' => 'Operaciones',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'operaciones.ver',
                'type' => 'Operaciones',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'operaciones.editar',
                'type' => 'Operaciones',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'operaciones.eliminar',
                'type' => 'Operaciones',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'operaciones.finalizar',
                'type' => 'Operaciones',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'operaciones.cancelar',
                'type' => 'Operaciones',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'operaciones.imprimir',
                'type' => 'Operaciones',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Usuarios
            [
                'name' => 'usuarios.inicio',
                'type' => 'Usuarios',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'usuarios.crear',
                'type' => 'Usuarios',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'usuarios.ver',
                'type' => 'Usuarios',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'usuarios.editar',
                'type' => 'Usuarios',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'usuarios.eliminar',
                'type' => 'Usuarios',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            //Bancos
            [
                'name' => 'bancos.inicio',
                'type' => 'Bancos',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'bancos.crear',
                'type' => 'Bancos',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'bancos.ver',
                'type' => 'Bancos',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'bancos.editar',
                'type' => 'Bancos',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'bancos.eliminar',
                'type' => 'Bancos',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            //Ciudad
            [
                'name' => 'ciudad.inicio',
                'type' => 'Ciudad',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'ciudad.crear',
                'type' => 'Ciudad',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'ciudad.ver',
                'type' => 'Ciudad',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'ciudad.editar',
                'type' => 'Ciudad',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'ciudad.eliminar',
                'type' => 'Ciudad',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            //Tipos de docuemntos de identidad
            [
                'name' => 'dIdentidad.inicio',
                'type' => 'Documentos de Identidad',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'dIdentidad.crear',
                'type' => 'Documentos de Identidad',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'dIdentidad.ver',
                'type' => 'Documentos de Identidad',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'dIdentidad.editar',
                'type' => 'Documentos de Identidad',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'dIdentidad.eliminar',
                'type' => 'Documentos de Identidad',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],


            //Provincias
            [
                'name' => 'provincias.inicio',
                'type' => 'Provincias',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'provincias.crear',
                'type' => 'Provincias',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'provincias.ver',
                'type' => 'Provincias',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'provincias.editar',
                'type' => 'Provincias',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'provincias.eliminar',
                'type' => 'Provincias',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],


            //Asignar estados
            [
                'name' => 'estadosAsignar.inicio',
                'type' => 'Asignar estados',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'estadosAsignar.crear',
                'type' => 'Asignar estados',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'estadosAsignar.ver',
                'type' => 'Asignar estados',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'estadosAsignar.editar',
                'type' => 'Asignar estados',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'estadosAsignar.eliminar',
                'type' => 'Asignar estados',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            //Tipos de estados
            [
                'name' => 'estados.inicio',
                'type' => 'Tipos de estados',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'estados.crear',
                'type' => 'Tipos de estados',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'estados.ver',
                'type' => 'Tipos de estados',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'estados.editar',
                'type' => 'Tipos de estados',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'estados.eliminar',
                'type' => 'Tipos de estados',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'sistema.inicio',
                'type' => 'sistema',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // 🔄 Crear o actualizar los permisos
        foreach ($permissions as $perm) {
            DB::table('permissions')->updateOrInsert(
                ['name' => $perm['name']], // condición
                [
                    'type' => $perm['type'],
                    'guard_name' => $perm['guard_name'],
                    'updated_at' => now(),
                    'created_at' => DB::table('permissions')
                        ->where('name', $perm['name'])
                        ->value('created_at') ?? now(),
                ]
            );
        }
        // === Crear roles ===
        $admin = Role::firstOrCreate(['name' => 'Administrador']);
        $operador = Role::firstOrCreate(['name' => 'Operador']);

        // === Asignar permisos ===
        $admin->syncPermissions(\Spatie\Permission\Models\Permission::all());
        $operador->syncPermissions(['operaciones.inicio', 'operaciones.ver']);

        // === Asignar rol al usuario 1 ===
        $user = User::find(1);
        if ($user && !$user->hasRole('Administrador')) {
            $user->assignRole('Administrador');
        }

        $this->command->info('✅ Permisos y roles actualizados correctamente.');
    }
}
