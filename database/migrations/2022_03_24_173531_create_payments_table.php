<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{

    public function up():void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('reference');
            $table->double('total');
            $table->enum('status', ['pending', 'rejected', 'approved'])->default('pending');
            $table->string('url');
            $table->json('session');
            $table->foreignId('order_id');
            $table->foreign('order_id')
                ->references('id')
                ->on('orders');
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
        Schema::dropIfExists('payments');
    }
}
