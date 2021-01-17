<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->unsignedBigInteger('id_adresse_livraison')->nullable();
            $table->foreign('id_adresse_livraison')->references('id')->on('adresse');
            $table->unsignedBigInteger('id_adresse_facturation')->nullable();
            $table->foreign('id_adresse_facturation')->references('id')->on('adresse');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users');
            $table->string('nom');
            $table->string('prenom');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('order');
        Schema::enableForeignKeyConstraints();
    }
}
