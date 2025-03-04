<?php

namespace Database\Seeders;

use App\Models\Title;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /* Lägg till detta i seed
        Title::factory()->create([
            'name' => 'Star wars',
        ]);
        */


        User::factory(5)->create(['role' => 'standard']);
        User::factory(5)->create(['role' => 'admin']);
    }
}
