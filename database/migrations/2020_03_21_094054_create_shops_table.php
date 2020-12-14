<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('shop_id');
            $table->unsignedBigInteger('vendor_id');
            $table->string('name');
            $table->text('thumbnail')->nullable();
            $table->text('logo')->nullable();
            $table->timestamps();

            $table->foreign('vendor_id')
              ->references('id')->on('vendors')
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
        Schema::dropIfExists('shops');
    }
}
