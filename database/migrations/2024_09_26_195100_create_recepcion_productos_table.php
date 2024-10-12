<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecepcionProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recepcion_producto', function (Blueprint $table) {
            $table->collate = 'latin1_spanish_ci';
            $table->bigIncrements('rcpId');
            $table->unsignedBigInteger('idRc');
            $table->unsignedBigInteger('idP');
            $table->integer('rcpCant');
            $table->double('rcpPrecioV');
            $table->integer('rcpUsuReg');
            $table->timestamp('rcpFecCrea')->default(DB::raw('now()'));
            $table->dateTime('rcpFecActualiza')->nullable();
            $table->integer('rcpEst')->default(1);
        });
        Schema::table('recepcion_producto', function ($table) {
            $table->foreign('idRc')->references('rcId')->on('recepcion');
            $table->foreign('idP')->references('pId')->on('producto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recepcion_producto');
    }
}
