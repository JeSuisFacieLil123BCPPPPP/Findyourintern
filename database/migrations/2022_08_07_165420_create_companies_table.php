<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Company(id,company_name,pays,description,user_id)
        Schema::create('companies', function (Blueprint $table) {
            $table->id('id')->autoIncrement();
            $table->string('company_name')->nullable(false);
            $table->string('pays')->nullable(true);
            $table->longText('description')->nullable(false);
            $table->bigInteger('user_id')->unsigned()->nullable(false);
             $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); 
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
        Schema::dropIfExists('companies');
    }
}
