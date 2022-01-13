<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        User::create([
            'name' => 'Paola Rios',
            'email' => 'paomil999@gmail.com',
            'password' => Hash::make('12345678'),
            'email_verified_at' => now(),
        ])->assignRole('Admin');
//
        User::create([
            'name' => 'Pedro perez',
            'email' => 'paomil999+1@gmail.com',
            'password' => Hash::make('12345678'),
        ])->assignRole('Client');

        User::create([
            'name' => 'Andrea Tamayo',
            'email' => 'paomil999+2@gmail.com',
            'password' => Hash::make('12345678'),
        ])->assignRole('Client');
    }
}
