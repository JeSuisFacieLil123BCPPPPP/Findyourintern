<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            //Comments(id,body,user_id,realisation_id)
            $table->id('id')->autoIncrement();
            $table->longText('body')->nullable(false);
            $table->integer('nbrLikes')->default(0);
             $table->integer('nbrdisLikes')->default(0);
            $table->bigInteger('comment_id')->unsigned()->nullable(true);
            $table->foreign('comment_id')->references('id')->on('comments')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('comment_user')->unsigned()->nullable(true);
            $table->foreign('comment_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('user_id')->unsigned()->nullable(false);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('comments');
    }
}
