<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('subject')->nullable();
            $table->integer('potentialid')->nullable();
            $table->string('quotestage')->nullable();
            $table->date('validtill')->nullable();
            $table->string('quote_no')->nullable();
            $table->string('subtotal')->nullable();
            $table->string('carrier')->nullable();
            $table->string('shipping')->nullable();
            $table->integer('inventorymanager')->nullable();
            $table->string('type')->nullable();
            $table->integer('adjustment')->nullable();
            $table->integer('total')->nullable();
            $table->string('taxtype')->nullable();
            $table->integer('discount_percent')->nullable();
            $table->integer('discount_amount')->nullable();
            $table->integer('fee_kh')->nullable();
            $table->integer('fee_ld')->nullable();
            $table->integer('fee_vc')->nullable();
            $table->integer('fee_ld')->nullable();
            $table->integer('qgg')->nullable();
            $table->integer('pre_tax_total')->nullable();
            $table->integer('s_h_amount')->nullable();
            $table->integer('account_id')->nullable();
            $table->string('terms_conditions')->nullable();
            $table->morphs('quoteable');
            $table->morphs('creator');
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
        Schema::dropIfExists('quotes');
    }
}
