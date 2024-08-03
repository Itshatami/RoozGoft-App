<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get('database/data/roles.json');
        $roles = collect(json_decode($json, true));
        $roles->each(function ($role) {
            Role::create([
                'user_id' => $role['user_id'],
                'role' => $role['role']
            ]);
        });
    }
}
