<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            'id' => 1,
            'name_es' => 'Tecnología',
            'name_en' => 'Technology',
            'outstanding_image' => '/storage/categories/technology.jpg',
            'slug' => 'technology',
        ]);

        DB::table('categories')->insert([
            'id' => 2,
            'name_es' => 'Computadores',
            'name_en' => 'Computers',
            'outstanding_image' => '/storage/categories/new-category.jpg',
            'type' => 'subcategory',
            'slug' => 'computers',
        ]);

        DB::table('categories')->insert([
            'id' => 3,
            'name_es' => 'Deporte',
            'name_en' => 'Sport',
            'outstanding_image' => '/storage/categories/sport.jpg',
            'slug' => 'sport',
        ]);

        DB::table('categories')->insert([
            'id' => 4,
            'name_es' => 'Oficina',
            'name_en' => 'Office',
            'outstanding_image' => '/storage/categories/office.jpg',
            'slug' => 'office',
        ]);

        DB::table('categories')->insert([
            'id' => 5,
            'name_es' => 'Moda',
            'name_en' => 'Fashion',
            'outstanding_image' => '/storage/categories/fashion.jpg',
            'slug' => 'fashion',
        ]);
    }
}
