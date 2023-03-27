<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::factory()->create([
            'name' => 'Mateus Oliveira',
            'linkedin_url' => 'https://www.linkedin.com/in/mateussiil/',
            'github_url' => 'https://github.com/mateussiil',
            'email' => 'mateus_silva97@hotmail.com',
        ]);
    }
}
