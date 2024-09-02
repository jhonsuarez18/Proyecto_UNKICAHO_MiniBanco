<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compra', function (Blueprint $table) {
            $table->collate = 'latin1_spanish_ci';
            $table->bigIncrements('cId');
            $table->unsignedBigInteger('idPv');
            $table->string('cNFactura');
            $table->integer('cIgv');
            $table->integer('cUsuReg');
            $table->timestamp('cFecCrea')->default(DB::raw('now()'));
            $table->dateTime('cFecActualiza')->nullable();
            $table->integer('cEst')->default(1);
        });
        Schema::table('compra', function ($table) {
            $table->foreign('idPv')->references('pvId')->on('proveedor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compra');
    }
}
