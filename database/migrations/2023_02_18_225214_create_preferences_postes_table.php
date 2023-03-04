<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreferencesPostesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preferences_postes', function (Blueprint $table) {
            $table->id();
            $table->string('lieu')->nullable(true);//
            $table->string('zone')->nullable(true);
            $table->string('type')->nullable(true);
            $table->string('secteurs')->nullable(true);
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
        Schema::dropIfExists('preferences_postes');
    }
}
