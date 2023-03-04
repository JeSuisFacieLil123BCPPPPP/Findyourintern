<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOffresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('offres', function (Blueprint $table) {
           /* $table->longText('description')->nullable(false);
            $table->string('metier')->nullable(false);
            $table->string('experience')->nullable(true);
            $table->string('localisation')->nullable(true);*/
            $table->dropColumn(['description', 'metier', 'experience','localisation']);
           
            //titre,type,secteur,fonction,responsabilité,exigences, zone,disponiblité,date_limite,
            $table->string('type')->nullable(false);
            $table->string('secteur')->nullable(false);
            $table->string('fonction');
            $table->longText('responsabilite');
            $table->longText('exigences');
            $table->string('zone');
            $table->string('disponibilite');
            $table->date('date_limite')->nullable(true);

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
            $table->dropColumn('type');
            $table->dropColumn('secteur');
            $table->dropColumn('fonction');
            $table->dropColumn('responsabilite');
            $table->dropColumn('exigences');
            $table->dropColumn('zone');
            $table->dropColumn('disponiblite');
            $table->dropColumn('date_limite');

        });
    }
}
