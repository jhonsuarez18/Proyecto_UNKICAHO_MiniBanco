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
        /*Schema::create('alumno', function (Blueprint $table) {
            $table->collate = 'latin1_spanish_ci';
            $table->bigIncrements('alId')->unique();
            $table->unsignedBigInteger('idDt');
            $table->unsignedBigInteger('idTD');
            $table->unsignedBigInteger('idGA');
            $table->unsignedBigInteger('idPRT');
            $table->string('alNombres')->nullable();
            $table->string('alAPPaterno')->nullable();
            $table->string('alAPMaterno')->nullable();
            $table->string('alTelefono')->nullable();
            $table->string('alNumeroDoc')->nullable();
            $table->string('alDireccion')->nullable();
            $table->date('alFecNac')->nullable();
            $table->timestamp('alFecCreacion');
            $table->dateTime('alFecActualiza')->nullable();
            $table->integer('alUsuReg');
            $table->integer('alUsuActuali')->nullable();
            $table->integer('alEstado')->default(1);
        });
        Schema::table('alumno', function ($table) {
            $table->foreign('idDT')->references('dtId')->on('distrito');
            $table->foreign('idTD')->references('tdId')->on('tipo_doc');
            $table->foreign('idGA')->references('gaId')->on('grado_academico');
            $table->foreign('idPRT')->references('prtId')->on('parentesco');
        });*/
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
