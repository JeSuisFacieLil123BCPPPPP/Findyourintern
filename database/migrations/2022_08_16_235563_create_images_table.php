<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id('id')->autoIncrement();
            $table->string('name_img');
            $table->string('size');
             $table->string('url');
             $table->string('secure_url');
             $table->string('format');
             $table->string('width');
             $table->string('height');
             $table->string('public_id');
             $table->json('variants');//'name_file',  'format','url','secure_url','size','width','height','type_model','public_id','variants'
             $table->integer('imageable_id');
              $table->string('imageable_type');
              $table->enum('type_model', ['poster', 'images','avatar']);
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
        Schema::dropIfExists('images');
    }
}
