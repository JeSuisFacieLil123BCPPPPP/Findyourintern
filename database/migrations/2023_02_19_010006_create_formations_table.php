<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formations', function (Blueprint $table) {
            $table->id();//
            $table->string('institution')->nullable(true);
            $table->date('date_deb')->nullable(false);
            $table->date('date_fin')->nullable(false);
            $table->string('theme')->nullable(true);
            $table->string('type')->nullable(true);
            $table->boolean('status')->nullable(true)->default(true);
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
        Schema::dropIfExists('formations');
    }
}
