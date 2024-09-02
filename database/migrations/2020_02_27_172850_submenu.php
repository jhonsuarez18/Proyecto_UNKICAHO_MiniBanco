<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Submenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submenu', function (Blueprint $table) {
            $table->collate = 'latin1_spanish_ci';
            $table->bigIncrements('idSubMenu')->unique();
            $table->unsignedBigInteger('idMenu');
            $table->string('subTitulo')->nullable();
            $table->string('descripcion')->nullable();
            $table->string('url')->nullable();
            $table->string('color')->nullable();
            $table->integer('estado')->default(1);
        }
        );
        Schema::table('submenu', function ($table) {

            $table->foreign('idMenu')->references('idMenu')->on('menu');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu');
    }
}
