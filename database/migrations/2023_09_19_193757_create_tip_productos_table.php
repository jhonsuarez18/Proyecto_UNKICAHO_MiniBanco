<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::create('tip_producto', function (Blueprint $table) {
            $table->collate = 'latin1_spanish_ci';
            $table->bigIncrements('tpId');
            $table->unsignedBigInteger('idUm');
            $table->string('tpDesc');

            $table->integer('tpUsuReg');
            $table->timestamp('tpFecCrea')->default(DB::raw('now()'));
            $table->dateTime('tpFecActualiza')->nullable();
            $table->integer('tpEst')->default(1);
        });
        Schema::table('tip_producto', function ($table) {
            $table->foreign('idUm')->references('umId')->on('unidad_medida');
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tip_producto');
    }
}
