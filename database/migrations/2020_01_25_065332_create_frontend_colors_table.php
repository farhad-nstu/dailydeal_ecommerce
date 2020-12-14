<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFrontendColorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frontend_colors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('primary')->nullable();
            $table->string('secondary')->nullable();
            $table->string('tertiary')->nullable();
            $table->string('quaternary')->nullable();
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
        Schema::dropIfExists('frontend_colors');
    }
}
