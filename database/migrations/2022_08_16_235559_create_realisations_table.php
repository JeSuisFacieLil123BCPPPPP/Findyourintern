<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRealisationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('realisations', function (Blueprint $table) {
            //id,title,description,nbr_vue,etat,sub_category_id,file_id,
            $table->id('id')->autoIncrement();
            $table->string('title');
            $table->longText('description');
            $table->integer('nbr_vue')->default(0);
            $table->boolean('valide')->default(false); //'visibility'
            $table->boolean('visibility')->default(false);
            $table->boolean('active')->default(true);
            $table->integer('nbrLikes')->default(0);
            $table->integer('nbrdisLikes')->default(0);
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
        Schema::dropIfExists('realisations');
    }
}
