<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() //Code de création
    {
        //Création d'une table E-MAIL 
        Schema::create('emails', function(Blueprint $table) {
            $table->increments('id');
            $table->string('email', 100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() //Code de suppression
    {
        //Suppression de la table E-MAIL
        Schema::drop('emails');
    }
}
