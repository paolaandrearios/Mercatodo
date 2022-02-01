<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        $this->call([
           RoleSeeder::class,
        ]);

        $this->call([
           UserSeeder::class,
        ]);

        $this->call([
           CategorySeeder::class,
        ]);

        $this->call([
           ProductSeeder::class,
        ]);
    }
}
