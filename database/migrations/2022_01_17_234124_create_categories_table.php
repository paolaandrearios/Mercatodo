<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name_es');
            $table->string('name_en');
            $table->string('outstanding_image');
            $table->string('slug');
            $table->enum('type', ['category', 'subcategory'])->default('category');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->string('icon')->default('fas fa-question');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
}
