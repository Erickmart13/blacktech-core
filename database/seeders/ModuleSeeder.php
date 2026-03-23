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
            ['name' => 'DashBoard', 'code' => 'dashboard', 'order' => 1],
            ['name' => 'Administración', 'code' => 'administracion', 'order' => 2],
            ['name' => 'Sistema', 'code' => 'sistema', 'order' => 3],
            ['name' => 'Configuración', 'code' => 'configuracion', 'order' => 4],
        ];

        foreach ($modules as $module) {
            Module::firstOrCreate(
                ['code' => $module['code']],
                $module
            );
        }
    }
}
