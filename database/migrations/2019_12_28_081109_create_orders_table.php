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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('name');
            $table->string('phone_number');
            $table->string('email')->nullable();
            $table->unsignedBigInteger('city_id');
            $table->text('shipping_address');
            $table->text('message')->nullable();
            $table->integer('total_price');
            $table->tinyInteger('status')->default(0)->comment('0 approved | 1 waiting for shipment | 2 shipment done');
            $table->boolean('is_completed')->default(0);
            $table->boolean('payment_mentod')->nullable();
            $table->boolean('is_paid')->default(0);
            $table->timestamps();

            $table->foreign('user_id')
              ->references('id')->on('users')
              ->onDelete('cascade');

            $table->foreign('city_id')
              ->references('id')->on('cities')
              ->onDelete('cascade');
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
