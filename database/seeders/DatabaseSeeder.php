<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Create default categories for the pet store
        Category::create([
            'name' => 'Comida',
            'description' => 'Comida y premios para mascotas'
        ]);

        Category::create([
            'name' => 'Juguetes',
            'description' => 'Juguetes y entretenimiento para mascotas'
        ]);

        Category::create([
            'name' => 'Accesorios',
            'description' => 'Accesorios para mascotas como collares, correas, etc.'
        ]);

        Category::create([
            'name' => 'Salud y cuidado',
            'description' => 'Productos de salud y cuidado personal'
        ]);

        Category::create([
            'name' => 'Ropa de cama',
            'description' => 'Camas y artículos de confort para mascotas'
        ]);
    }
}
