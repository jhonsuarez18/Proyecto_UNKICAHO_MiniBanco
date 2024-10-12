<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumno', function (Blueprint $table) {
            $table->collate = 'latin1_spanish_ci';
            $table->bigIncrements('alId')->unique();
            $table->unsignedBigInteger('idGS');
            $table->unsignedBigInteger('idPe');
            $table->timestamp('alFecCreacion');
            $table->dateTime('alFecActualiza')->nullable();
            $table->integer('alUsuReg');
            $table->integer('alUsuActuali')->nullable();
            $table->integer('alEstado')->default(1);
        });
        Schema::table('alumno', function ($table) {
            $table->foreign('idGS')->references('gsId')->on('grado_seccion');
            $table->foreign('idPe')->references('peId')->on('persona');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alumno');
    }
}
