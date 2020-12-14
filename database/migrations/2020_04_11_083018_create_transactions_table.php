<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('transaction_id');
            $table->unsignedBigInteger('vendor_id');
            $table->string('product_title');
            $table->integer('product_quantity')->unsigned();
            $table->string('payment_method');
            $table->string('comission');
            $table->string('balance');
            $table->string('total');
            $table->string('case');
            $table->string('withdraw');
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
        Schema::dropIfExists('transactions');
    }
}
