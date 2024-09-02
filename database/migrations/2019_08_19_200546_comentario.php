<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Comentario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */


    public function up()
    {
        Schema::create('comentario', function (Blueprint $table) {
            $table->collate = 'latin1_spanish_ci';
            $table->increments('idComentario')->unique();
            $table->string('idUsuario')->nullable();
            $table->string('codigoGrafico')->nullable();
            $table->string('codIndicador')->nullable();
            $table->string('comentario')->nullable();
            $table->dateTime('fechaCorte')->nullable();
            $table->dateTime('fechaCreacion')->nullable();
            $table->boolean('estadoComentario')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
