<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApoderadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::create('apoderado', function (Blueprint $table) {
            $table->collate = 'latin1_spanish_ci';
            $table->bigIncrements('apId')->unique();
            $table->unsignedBigInteger('idDt');
            $table->unsignedBigInteger('idTD');
            $table->unsignedBigInteger('idGI');
            $table->unsignedBigInteger('idEC');
            $table->string('apNombres')->nullable();
            $table->string('apAPPaterno')->nullable();
            $table->string('apAPMaterno')->nullable();
            $table->string('apTelefono')->nullable();
            $table->string('apNumeroDoc')->nullable();
            $table->string('apDireccion')->nullable();
            $table->string('apNatural')->nullable();
            $table->string('apOcupacion')->nullable();
            $table->date('apFecNac')->nullable();
            $table->dateTime('apFecActualiza')->nullable();
            $table->integer('apUsuActuali')->nullable();
            $table->integer('apUsuReg');
            $table->timestamp('apFecCreacion');
            $table->integer('apEstado')->default(1);
        });
        Schema::table('apoderado', function ($table) {
            $table->foreign('idDT')->references('dtId')->on('distrito');
            $table->foreign('idTD')->references('tdId')->on('tipo_doc');
            $table->foreign('idGI')->references('giId')->on('grado_instruccion');
            $table->foreign('idEC')->references('ecId')->on('estado_civil');
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apoderados');
    }
}
