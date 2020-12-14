<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('generals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('logo');
            $table->string('about');
            $table->string('copyright');
            $table->string('phone_number');
            $table->string('address');
            $table->string('email');
            $table->string('website');
            $table->string('facebook',150)->nullable();
            $table->string('twitter',150)->nullable();
            $table->string('linkedin',150)->nullable();
            $table->string('google',150)->nullable();

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
        Schema::dropIfExists('generals');
    }
}
