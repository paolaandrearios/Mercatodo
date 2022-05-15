<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductVisitsPerDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_visits_per_days', function (Blueprint $table) {
            $table->id();
            $table->integer('count')->default(0);
            $table->date('date');
            $table->foreignId('product_id');
            $table->foreign('product_id')
                ->references('id')
                ->on('products');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_visits_per_days');
    }
}
