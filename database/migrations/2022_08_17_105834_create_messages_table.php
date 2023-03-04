<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('messages', function (Blueprint $table) {
            $table->id('id')->autoIncrement();
            $table->string('body')->nullable(false);
            $table->bigInteger('user_send_id')->unsigned()->nullable(false);
             $table->foreign('user_send_id')->references('id')->on('users')->onDelete('cascade');
             $table->date('read_at')->nullable(); 
             $table->bigInteger('user_rec_id')->unsigned()->nullable(false);
             $table->foreign('user_rec_id')->references('id')->on('users')->onDelete('cascade'); 
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
        Schema::dropIfExists('messages');
    }
}
