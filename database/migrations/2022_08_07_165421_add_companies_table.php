<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            /*nom de l'entreprise,adresse,ville, pays,site internet de
            l'entreprise,logo de l'entreprise,secteur d'activité,description de
            l'entreprise*/
            $table->string('adresse');
            $table->string('ville');
            $table->string('logo')->nullable(true);
            $table->string('site')->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
             $table->dropColumn('adresse');
             $table->dropColumn('ville');
             $table->dropColumn('logo');
             $table->dropColumn('site');
        });
    }
}
