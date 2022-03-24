<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('reference');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('document_type');
            $table->string('document_number');
            $table->string('email');
            $table->string('address');
            $table->string('city');
            $table->string('postcode');
            $table->string('phone');
            $table->text('notes');
            $table->foreignId('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->float('taxes')->nullable();
            $table->double('subtotal')->nullable();
            $table->double('total')->nullable();
            $table->enum('status', ['open', 'close'])->default('open');
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
        Schema::dropIfExists('orders');
    }
}
