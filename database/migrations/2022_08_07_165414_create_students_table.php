<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Student(id,firstname,lastname,pays,tel,school_name,user_id)
        Schema::create('students', function (Blueprint $table) {
            $table->id('id')->autoIncrement();
            $table->string('firstname')->nullable(false);
            $table->string('lastname')->nullable(false);
            $table->string('pays')->nullable(true);
            $table->integer('matricule')->nullable(false);
           // $table->string('school_name')->nullable(true);
            $table->bigInteger('user_id')->unsigned()->nullable(false);
             $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); 
             $table->foreignId('entity_id')
             ->constrained('entities')
            // ->onUpdate('cascade')
             ->onDelete('cascade');
             $table->foreignId('filiere_id')
             ->constrained('filieres')
            // ->onUpdate('cascade')
             ->onDelete('cascade');
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
        Schema::dropIfExists('students');
    }
}
