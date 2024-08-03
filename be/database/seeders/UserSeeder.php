<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get('database/data/users.json');
        $users = collect(json_decode($json, true));
        $users->each(function ($user) {
            User::create([
                'username' => $user['username'],
                'email' => $user['email'],
                'password' => Hash::make($user['password']),
            ]);
        });
    }
}
