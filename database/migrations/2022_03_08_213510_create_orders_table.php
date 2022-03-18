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
            $table->string('reference')->nullable();;
            $table->string('first_name')->nullable();;
            $table->string('last_name')->nullable();;
            $table->string('document_type')->nullable();;
            $table->string('document_number')->nullable();;
            $table->string('email')->nullable();;
            $table->string('address')->nullable();;
            $table->string('city')->nullable();;
            $table->string('postcode')->nullable();;
            $table->string('phone')->nullable();;
            $table->text('notes')->nullable();;
            $table->foreignId('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->float('taxes')->nullable();;
            $table->double('subtotal')->nullable();;
            $table->double('total')->nullable();;
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
