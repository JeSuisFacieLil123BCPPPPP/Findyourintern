<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRealisationTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('realisationTags', function (Blueprint $table) {
            $table->bigInteger('tag_id')->unsigned()->nullable(false);
             $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade'); 
             $table->bigInteger('realisation_id')->unsigned()->nullable(false);
             $table->foreign('realisation_id')->references('id')->on('realisations')->onDelete('cascade');
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
        Schema::dropIfExists('realisationsTags');
    }
}
