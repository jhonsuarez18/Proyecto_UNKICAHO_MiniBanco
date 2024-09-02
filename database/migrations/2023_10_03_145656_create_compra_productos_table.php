<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompraProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compra_producto', function (Blueprint $table) {
            $table->collate = 'latin1_spanish_ci';
            $table->bigIncrements('cpId');
            $table->unsignedBigInteger('idC');
            $table->unsignedBigInteger('idP');
            $table->integer('cpCant');
            $table->double('cpPrecioC');
            $table->integer('cpUsuReg');
            $table->timestamp('cpFecCrea')->default(DB::raw('now()'));
            $table->dateTime('cpFecActualiza')->nullable();
            $table->integer('cpEst')->default(1);
        });
        Schema::table('compra_producto', function ($table) {
            $table->foreign('idC')->references('cId')->on('compra');
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
        Schema::dropIfExists('compra_producto');
    }
}
