<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::create('producto', function (Blueprint $table) {
            $table->collate = 'latin1_spanish_ci';
            $table->bigIncrements('pId');
            $table->unsignedBigInteger('idTp');
            $table->unsignedBigInteger('idM');
            $table->unsignedBigInteger('idPs');
            $table->double('pContenido');
            $table->double('pPrecioC');
            $table->double('pPrecioV');
            $table->integer('pStock')->default(0);
            $table->integer('pUsuReg');
            $table->dateTime('pFecActualiza')->nullable();
            $table->timestamp('pFecCrea')->default(DB::raw('now()'));
            $table->integer('pEst')->default(1);
        });
        Schema::table('producto', function ($table) {
            $table->foreign('idTp')->references('tpId')->on('tip_producto');
            $table->foreign('idM')->references('mId')->on('marca');
            $table->foreign('idPs')->references('psId')->on('presentacion');
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('producto');
    }
}
