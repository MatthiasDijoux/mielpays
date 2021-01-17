<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableRelation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product', function (Blueprint $table) {
            $table->unsignedBigInteger('id_producer');
            $table->foreign('id_producer')->references('id')->on('producer');
        });
        Schema::table('producer', function (Blueprint $table) {
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('id_role');
            $table->foreign('id_role')->references('id')->on('role');
        });
        Schema::table('popularProducts', function (Blueprint $table) {
            $table->unsignedBigInteger('id_product');
            $table->foreign('id_product')->references('id')->on('product');
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

        Schema::table('product', function (Blueprint $table) {
            $table->dropForeign(['id_producer']);
            $table->dropIfExists('id_producer');
        });
        Schema::table('producer', function (Blueprint $table) {
            $table->dropForeign(['id_user']);
            $table->dropIfExists('id_user');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['id_role']);
            $table->dropIfExists('id_role');
        });
        Schema::table('popularProducts', function (Blueprint $table) {
            $table->dropForeign(['id_product']);
            $table->dropIfExists('id_product');
        });
        Schema::enableForeignKeyConstraints();
    }
}
