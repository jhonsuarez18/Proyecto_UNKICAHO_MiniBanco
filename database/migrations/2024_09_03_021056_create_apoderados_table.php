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
        Schema::create('apoderado', function (Blueprint $table) {
            $table->collate = 'latin1_spanish_ci';
            $table->bigIncrements('apId')->unique();
            $table->unsignedBigInteger('idGI');
            $table->unsignedBigInteger('idEC');
            $table->unsignedBigInteger('idPe');
            $table->string('apNatural')->nullable();
            $table->string('apOcupacion')->nullable();
            $table->timestamp('apFecCreacion');
            $table->dateTime('apFecActualiza')->nullable();
            $table->integer('apUsuReg');
            $table->integer('apUsuActuali')->nullable();
            $table->integer('apEstado')->default(1);
        });
        Schema::table('apoderado', function ($table) {
            $table->foreign('idGI')->references('giId')->on('grado_instruccion');
            $table->foreign('idEC')->references('ecId')->on('estado_civil');
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
        Schema::dropIfExists('apoderado');
    }
}
