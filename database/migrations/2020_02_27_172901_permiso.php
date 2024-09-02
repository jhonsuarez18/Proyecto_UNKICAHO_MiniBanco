<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Permiso extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('permiso', function (Blueprint $table) {
            $table->collate = 'latin1_spanish_ci';
            $table->bigIncrements('idPermiso')->unique();
            $table->unsignedBigInteger('idSubMenu');
            $table->unsignedBigInteger('idUsuario');
            $table->integer('usuCrea')->nullable();
            $table->integer('usuModifica')->nullable();
            $table->dateTime('fecModifica')->nullable();
            $table->timestamp('fecCreacion')->nullable();
            $table->integer('estado')->default(1);
        }
        );
        Schema::table('permiso', function ($table) {
            $table->foreign('idUsuario')->references('id')->on('users');
            $table->foreign('idSubMenu')->references('idSubMenu')->on('submenu');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permiso');
    }
}
