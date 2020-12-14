<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('category_id')->unsigned();
            $table->integer('brand_id')->unsigned()->nullable();
            $table->integer('admin_id')->unsigned();
            $table->string('title');
            $table->string('title_bd')->nullable();
            $table->text('description')->nullable();
            $table->text('description_bd')->nullable();
            $table->text('specifications')->nullable();
            $table->text('specifications_bd')->nullable();
            $table->integer('quantity');
            $table->integer('price');
            $table->integer('offer_price')->nullable();
            $table->tinyinteger('status')->unsigned()->default(0);
            $table->tinyinteger('featured')->unsigned()->default(0);
            $table->string('slug');
            $table->string('sku');
            $table->text('attributes_id')->nullable();
            $table->text('attribute_options')->nullable();
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
        Schema::dropIfExists('products');
    }
}
