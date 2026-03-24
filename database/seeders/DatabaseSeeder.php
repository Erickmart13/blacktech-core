<?php

namespace Database\Seeders;


use App\Models\Admin\User;
use Database\Seeders\ModuleSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();


      User::create([
    'name' => 'Erick Guayanay',
    'code' => 'BT-USU0001', // 🔥 TEMPORAL
    'email' => 'sistemas@denkelservice.com',
    'password' => Hash::make('password'),
]);

        // Roles primero
        $this->call([
            ModuleSeeder::class,
        ]);
        // Roles primero
        $this->call([
            ResourceSeeder::class,
        ]);
        // Roles primero
        $this->call([
            RolesAndPermissionsSeeder::class,
        ]);
    }
}
