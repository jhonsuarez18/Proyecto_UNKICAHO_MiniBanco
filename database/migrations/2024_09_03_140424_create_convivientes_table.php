<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConvivientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conviviente', function (Blueprint $table) {
            $table->collate = 'latin1_spanish_ci';
            $table->bigIncrements('cvId')->unique();
            $table->unsignedBigInteger('idDt');
            $table->unsignedBigInteger('idTD');
            $table->string('cvNombres')->nullable();
            $table->string('cvAPPaterno')->nullable();
            $table->string('cvAPMaterno')->nullable();
            $table->string('cvTelefono')->nullable();
            $table->string('cvNumeroDoc')->nullable();
            $table->string('cvDireccion')->nullable();
            $table->date('cvFecNac')->nullable();
            $table->timestamp('cvFecCreacion');
            $table->dateTime('cvFecActualiza')->nullable();
            $table->integer('cvUsuReg');
            $table->integer('cvUsuActuali')->nullable();
            $table->integer('cvEstado')->default(1);
        });
        Schema::table('conviviente', function ($table) {
            $table->foreign('idDT')->references('dtId')->on('distrito');
            $table->foreign('idTD')->references('tdId')->on('tipo_doc');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('convivientes');
    }
}
