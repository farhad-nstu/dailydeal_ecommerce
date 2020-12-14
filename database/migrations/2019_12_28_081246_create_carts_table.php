<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('product_id');
            $table->text('attributes_id')->nullable();
            $table->text('attribute_options')->nullable();
            $table->unsignedBigInteger('order_id')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('product_quantity')->default(1);
            $table->integer('price');
            

            $table->timestamps();

            $table->foreign('user_id')
              ->references('id')->on('users')
              ->onDelete('cascade');

              $table->foreign('product_id')
              ->references('id')->on('products')
              ->onDelete('cascade');

              $table->foreign('order_id')
              ->references('id')->on('orders')
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
        Schema::dropIfExists('carts');
    }
}
