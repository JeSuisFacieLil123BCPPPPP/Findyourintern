<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPhones1Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('phones', function (Blueprint $table) {
           // $table->dropColumn(['user_id']);
            $table->integer('phone_number')->change();
            $table->string('indic_tel')->nullable(false);
            $table->integer('phoneable_id')->nullable(false);
            $table->string('phoneable_type')->nullable(false);    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('phones', function (Blueprint $table) {
            $table->dropColumn(['indic_tel','phoneable_type','phoneable_id']);
        });
    }
}
