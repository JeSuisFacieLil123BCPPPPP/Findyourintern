<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            //user_id,realisation_id,nbr_like
            $table->bigInteger('userLike_id')->unsigned()->nullable(false);
             $table->foreign('userLike_id')->references('id')->on('users')->onDelete('cascade'); 
             $table->bigInteger('realisationLike_id')->unsigned()->nullable(false);
             $table->foreign('realisationLike_id')->references('id')->on('realisations')->onDelete('cascade'); 
             $table->integer('nbr_like');
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
        Schema::dropIfExists('likes');
    }
}
