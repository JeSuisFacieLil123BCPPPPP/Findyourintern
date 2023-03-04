<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOffres5Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('offres', function (Blueprint $table) {
            $table->string('niveau_std')->nullable(true);
            $table->string('niveau_exp')->nullable(true);
            $table->json('moyens')->nullable(false);
            $table->json('candidature')->nullable(true);
            $table->json('docs')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('offres', function (Blueprint $table) {
            $table->dropColumn(['niveau_std','niveau_exp','moyens','candidature','docs']);     
        });
    }
}
