<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id('id')->autoIncrement();
            $table->string('name_file');
            $table->integer('size');
             $table->string('url');
             $table->string('secure_url');
             $table->string('format');
             $table->integer('duration');
             $table->string('width');
             $table->string('height');
             $table->string('public_id');
             $table->json('variants');
             $table->integer('fileable_id');
              $table->string('fileable_type');
              $table->enum('type_model', ['video', 'documents']);
            // $table->bigInteger('realisations_id')->unsigned()->nullable(true);
            // $table->foreign('realisations_id')->references('id')->on('realisations')->onDelete('cascade'); 
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
        Schema::dropIfExists('files');
    }
}
