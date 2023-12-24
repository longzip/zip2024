<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned() ;
            $table->integer('contact_id')->unsigned();
            $table->string('title');
            $table->text('task') ;
            $table->integer('priority')->default(0) ;
            $table->boolean('completed')->default(0) ; 
            $table->dateTime('duedate')->nullable();          
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
        Schema::dropIfExists('task_contacts');
    }
}
