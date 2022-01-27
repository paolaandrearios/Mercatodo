<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('sku');
            $table->String('name_en');
            $table->text('description_en');
            $table->String('name_es');
            $table->text('description_es');
            $table->String('image');
            $table->double('price',15,2);
            $table->float('taxes');
            $table->String('category');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->integer('stock');
            $table->string('slug');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
}
