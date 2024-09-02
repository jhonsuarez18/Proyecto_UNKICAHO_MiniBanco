<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCentropobladoDistritosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('centropoblado_distrito', function (Blueprint $table) {
            $table->collate = 'latin1_spanish_ci';
            $table->bigIncrements('cPDId');
            $table->unsignedBigInteger('idCentroPoblado');
            $table->unsignedBigInteger('idDt');
            $table->integer('cPDUsuReg');
            $table->timestamp('cPDFecCrea')->default(DB::raw('now()'));
            $table->integer('cPDEst')->default(1);
        });
        Schema::table('centropoblado_distrito',function (Blueprint $table)
        {
            $table->foreign('idCentroPoblado')->references('idCentroPoblado')->on('centropoblado');
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
        //Schema::dropIfExists('centropoblado_distrito');
    }
}
