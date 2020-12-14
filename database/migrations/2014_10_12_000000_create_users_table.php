<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone_number')->unique();
            $table->string('address');
            $table->string('delivery_phone')->nullable();
            $table->string('delivery_address')->nullable();
            $table->string('password');
            $table->integer('city_id');
            $table->tinyinteger('gender')->unsigned()->default(0)->comment('0 not confirmed 1 man 2 woman ');
            $table->tinyinteger('status')->unsigned()->default(0)->comment('0 not varified 1 varified 2 banned');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
