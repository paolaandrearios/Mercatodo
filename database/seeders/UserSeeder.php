<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Paola Rios',
            'email' => 'paomil999@gmail.com',
            'role' => 'administrator',
            'password' => Hash::make('12345678'),
            'email_verified_at' => now(),
        ])->assignRole('administrator');

        User::create([
            'name' => 'Marcela Ramírez',
            'email' => 'paomil999+1@gmail.com',
            'role' => 'client',
            'password' => Hash::make('12345678'),
            'email_verified_at' => now(),
        ])->assignRole('client');
//
        User::create([
            'name' => 'Pedro Perez',
            'email' => 'paomil999+2@gmail.com',
            'role' => 'stock_assistant',
            'password' => Hash::make('12345678'),
            'email_verified_at' => now(),
        ])->assignRole('stock_assistant');

        User::create([
            'name' => 'Andrea Tamayo',
            'email' => 'paomil999+3@gmail.com',
            'role' => 'financial_assistant',
            'password' => Hash::make('12345678'),
            'email_verified_at' => now(),
        ])->assignRole('financial_assistant');
        User::create([
            'name' => 'Andres Duque',
            'email' => 'paomil999+4@gmail.com',
            'role' => 'logistic_assistant',
            'password' => Hash::make('12345678'),
            'email_verified_at' => now(),
        ])->assignRole('logistic_assistant');
        User::create([
            'name' => 'Erika Hernandez',
            'email' => 'paomil999+5@gmail.com',
            'role' => 'marketing_assistant',
            'password' => Hash::make('12345678'),
            'email_verified_at' => now(),
        ])->assignRole('marketing_assistant');
    }
}
