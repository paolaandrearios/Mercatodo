<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Paola Rios',
            'email' => 'paomil999@gmail.com',
            'password' => Hash::make('12345678'),
            'email_verified_at' => now(),
            'document_type' => 'CC',
            'document_number' => 77888999,
            'address' => 'calle 30 Nro 90 - 15',
            'city' => 'Bogota',
            'phone' => '3015558899',
        ]);

        DB::table('users')->insert([
            'name' => 'Pedro perez',
            'email' => 'paomil999+1@gmail.com',
            'password' => Hash::make('12345678'),
            'document_type' => 'CC',
            'document_number' => 77888989,
            'address' => 'calle 30 Nro 90 - 15',
            'city' => 'Bogota',
            'phone' => '3015558899',
        ]);

        DB::table('users')->insert([
            'name' => 'Andrea Tamayo',
            'email' => 'paomil999+2@gmail.com',
            'password' => Hash::make('12345678'),
            'document_type' => 'CC',
            'document_number' => 77888979,
            'address' => 'calle 30 Nro 90 - 15',
            'city' => 'Bogota',
            'phone' => '3015558899',
        ]);
    }
}
