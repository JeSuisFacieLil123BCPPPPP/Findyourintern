<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOffres3Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('offres', function (Blueprint $table) {
           $table->dropColumn(['fonction','disponibilite']);
           $table->dropColumn(['lieu','date_deb','duree','salaire','horaires','urgence','emails','reject','autoriseMail','auto_convers','telephone','telephoneNum']);
            $table->string('lieu')->nullable(false);//date('date_limite')->nullable(true);
            $table->date('date_deb')->nullable(true);
            $table->string('duree')->nullable(true);
            $table->string('salaire')->nullable(true);
            $table->string('horaires')->nullable(false);
            $table->integer('urgence')->nullable(false);
            $table->string('emails')->nullable(false);
            $table->integer('reject')->nullable(true);
            $table->boolean('autoriseMail')->default(false);
            $table->boolean('auto_convers')->default(false);
            $table->longText('telephone')->nullable(true);
            $table->integer('telephoneNum')->nullable(true);
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
            $table->dropColumn(['lieu','date_deb','duree','salaire','horaires','urgence','emails','reject','autoriseMail','auto_convers','telephone','telephoneNum']);
        });
    }
}
