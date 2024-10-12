<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradoSeccionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::create('grado_seccion', function (Blueprint $table) {
            $table->collate = 'latin1_spanish_ci';
            $table->bigIncrements('gsId');
            $table->unsignedBigInteger('idGA');
            $table->unsignedBigInteger('idS');
            $table->integer('gsUsuReg');
            $table->timestamp('gsFecCrea')->default(DB::raw('now()'));
            $table->dateTime('gsFecActualiza')->nullable();
            $table->integer('gsEst')->default(1);
        });
        Schema::table('grado__seccion', function ($table) {
            $table->foreign('idGA')->references('gaId')->on('grado_academico');
            $table->foreign('idS')->references('sId')->on('seccion');
        });*/

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grado_seccion');
    }
}
