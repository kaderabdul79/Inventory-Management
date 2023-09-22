<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('11111111'),
            'type' => 'admin',
        ]);

        User::create([
            'name' => 'Staff User',
            'email' => 'staff@gmail.com',
            'password' => Hash::make('11111111'),
            'type' => 'staff',
        ]);
    }
}
