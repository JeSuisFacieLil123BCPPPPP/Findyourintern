<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Admin(id,firstname,lastname,pays,user_id)
        Schema::create('admins', function (Blueprint $table) {
            $table->id('id')->autoIncrement();
            $table->string('firstname')->nullable(false);
            $table->string('lastname')->nullable(false);
            $table->string('pays')->nullable(true);
            $table->bigInteger('user_id')->unsigned()->nullable(false);
             $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); 
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
        Schema::dropIfExists('admins');
    }
}
