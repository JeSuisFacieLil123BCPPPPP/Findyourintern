<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfosStdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infos_stds', function (Blueprint $table) {
            $table->id('id')->autoIncrement();//  $table->string('name')->nullable(false);
            $table->string('pays')->nullable(true);//
            $table->string('ville')->nullable(true);
            $table->date('date_nais')->nullable(true);
            $table->string('decla_pers')->nullable(true);
            $table->enum('genre', ['masculin', 'feminin'])->nullable(true);
          //  $table->string('genre')->nullable(true);
            $table->bigInteger('student_id')->unsigned()->nullable(true);
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
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
        Schema::dropIfExists('infos_stds');
    }
}
