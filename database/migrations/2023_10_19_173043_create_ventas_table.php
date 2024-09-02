<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::create('venta', function (Blueprint $table) {
            $table->collate = 'latin1_spanish_ci';
            $table->bigIncrements('vId');
            $table->unsignedBigInteger('idCl');
            $table->integer('vCantVal')->default(0);
            $table->double('vPrecioVal')->default(0);
            $table->integer('vUsuReg');
            $table->timestamp('vFecCrea')->default(DB::raw('now()'));
            $table->dateTime('vFecActualiza')->nullable();
            $table->integer('vEst')->default(1);
        });
        Schema::table('venta', function ($table) {
            $table->foreign('idCl')->references('clId')->on('cliente');
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('venta');
    }
}
