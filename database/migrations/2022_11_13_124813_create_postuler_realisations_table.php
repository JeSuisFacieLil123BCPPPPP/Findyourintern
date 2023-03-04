<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostulerRealisationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postuler_realisations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('realisation_id')->unsigned()->nullable(false);
            $table->foreign('realisation_id')->references('id')->on('realisations')->onDelete('cascade'); 
            $table->bigInteger('postuler_id')->unsigned()->nullable(false);
            $table->foreign('postuler_id')->references('id')->on('postuler')->onDelete('cascade');
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
        Schema::dropIfExists('postuler_realisations');
    }
}
