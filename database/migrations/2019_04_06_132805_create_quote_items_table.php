<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuoteItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->nullable();
            $table->integer('quote_id')->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('listprice')->nullable();
            $table->integer('discount_percent')->nullable();
            $table->integer('discount_amount')->nullable();
            $table->string('comment')->nullable();
            $table->string('description')->nullable();
            $table->integer('tax1')->nullable();
            $table->integer('tax2')->nullable();
            $table->integer('tax3')->nullable();
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
        Schema::dropIfExists('quote_items');
    }
}
