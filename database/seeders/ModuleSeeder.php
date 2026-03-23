<?php

namespace Database\Seeders;

use App\Models\Admin\Module;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modules = [
            ['name' => 'Administración', 'code' => 'administracion', 'order' => 1],
            ['name' => 'Sistema', 'code' => 'sistema', 'order' => 2],
            ['name' => 'Configuración', 'code' => 'configuracion', 'order' => 3],
        ];

        foreach ($modules as $module) {
            Module::firstOrCreate(
                ['code' => $module['code']],
                $module
            );
        }
    }
}
