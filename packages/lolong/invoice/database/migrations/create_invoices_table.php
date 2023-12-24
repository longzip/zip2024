<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('subject')->nullable();
            $table->string('stage')->nullable();            
            $table->date('validtill')->nullable();
            $table->string('so_number')->nullable();
            $table->string('subtotal')->nullable();
            $table->integer('total')->nullable();
            $table->string('taxtype')->nullable();
            $table->integer('discount_percent')->nullable();
            $table->integer('discount_amount')->nullable();
            $table->integer('fee_vc')->nullable();
            $table->integer('fee_ld')->nullable();
            $table->integer('pre_tax_total')->nullable();
            $table->integer('s_h_amount')->nullable();
            $table->morphs('invoicelog');
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
        Schema::dropIfExists('invoices');
    }
}
