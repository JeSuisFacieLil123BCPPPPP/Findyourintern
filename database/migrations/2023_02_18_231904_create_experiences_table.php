<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();//'poste','company_name','date_deb','date_fin','description'
            $table->string('poste')->nullable(true);//
            $table->string('company_name')->nullable(true);
            $table->date('date_deb')->nullable(false);
            $table->date('date_fin')->nullable(false);
            $table->longText('description')->nullable(true);
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
        Schema::dropIfExists('experiences');
    }
}
