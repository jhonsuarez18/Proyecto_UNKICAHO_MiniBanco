<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentaProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venta_producto', function (Blueprint $table) {
            $table->collate = 'latin1_spanish_ci';
            $table->bigIncrements('vpId');
            $table->unsignedBigInteger('idV');
            $table->unsignedBigInteger('idP');
            $table->integer('vpCant');
            $table->double('vpPrecioV');
            $table->integer('vpUsuReg');
            $table->timestamp('vpFecCrea')->default(DB::raw('now()'));
            $table->dateTime('vpFecActualiza')->nullable();
            $table->integer('vpEst')->default(1);
        });
        Schema::table('venta_producto', function ($table) {
            $table->foreign('idV')->references('vId')->on('venta');
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
        Schema::dropIfExists('venta_producto');
    }
}
