<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Distrito extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distrito', function (Blueprint $table) {
            $table->collate = 'latin1_spanish_ci';
            $table->bigIncrements('dtId')->unique();
            $table->unsignedBigInteger('idProvincia');
            $table->string('codigo')->nullable();
            $table->string('descripcion')->nullable();
            $table->string('ambitoInei')->nullable();
            $table->string('regionNaturalInei')->nullable();
            $table->string('quintilPobreza')->nullable();
            $table->string('nivelPobreza')->nullable();
            $table->integer('estado')->default(1);
            $table->timestamps();
        }
        );
        Schema::table('distrito', function ($table) {
            $table->foreign('idProvincia')->references('idProvincia')->on('provincia');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('distrito');
    }
}
