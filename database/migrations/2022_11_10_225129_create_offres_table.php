<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('offres', function (Blueprint $table) {
            $table->id('id')->autoIncrement();
            $table->string('title')->nullable(false);
            $table->longText('description')->nullable(false);
            $table->string('metier')->nullable(false);
            $table->string('experience')->nullable(true);
            $table->string('localisation')->nullable(true);
            $table->bigInteger('user_id')->unsigned()->nullable(false);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');//->onUpdate('cascade');
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
        Schema::dropIfExists('offres');
    }
}
