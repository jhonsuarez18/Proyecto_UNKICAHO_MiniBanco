<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProveedorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedor', function (Blueprint $table) {
            $table->collate = 'latin1_spanish_ci';
            $table->bigIncrements('pvId');
            $table->unsignedBigInteger('idDt');
            $table->string('pvRazonS');
            $table->string('pvRuc');
            $table->integer('pvTelefono');
            $table->string('pvDireccion')->nullable();
            $table->integer('pvUsuReg');
            $table->dateTime('pvFecActualiza')->nullable();
            $table->timestamp('pvFecCrea')->default(DB::raw('now()'));
            $table->integer('pvEst')->default(1);
        });
        Schema::table('proveedor', function ($table) {
            $table->foreign('idDt')->references('dtId')->on('distrito');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proveedors');
    }
}
