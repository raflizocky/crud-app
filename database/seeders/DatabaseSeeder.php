<?php

namespace Database\Seeders;

use App\Models\Scientific_Paper;
use App\Models\User;
use App\Models\ScientificPaper;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Default Superadmin',
            'email' => 'superadmin@example.com',
            'password' => bcrypt('password'),
            'role' => 'superadmin',
        ]);

        User::create([
            'name' => 'Default Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // User::factory(10)->create();
    }
}
