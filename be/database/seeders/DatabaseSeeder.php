<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // user -> creates 10 user
        $this->call(UserSeeder::class);

        // role -> creates 1 admin role
        $this->call(RoleSeeder::class);

        // category ->creates
    }
}
