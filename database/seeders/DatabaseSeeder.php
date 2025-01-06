<?php

namespace Database\Seeders;

use App\Models\User\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CountriesTableSeeder::class,
            RolesTableSeeder::class,
            PermissionSeeder::class,
            RolesAssigmenSeeder::class,
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'te@example.com',
            'password' => bcrypt('password1234'),
            'phone_number' => '1234567890',  // Añadir el campo phone_number
            'document' => '12345678A',  // Si tienes otros campos, añádelos también
            'city' => 'Test City',
            'postal_code' => '12345',
            'address' => 'Test Address',
            'date_of_birth' => '1990-01-01',
            'country_id' => 1 
        ]);
    }
}
