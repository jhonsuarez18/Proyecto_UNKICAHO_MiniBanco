<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecepcionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recepcion', function (Blueprint $table) {
            $table->collate = 'latin1_spanish_ci';
            $table->bigIncrements('rcId');
            $table->unsignedBigInteger('idAl');
            $table->integer('rcCantVal')->default(0);
            $table->double('rcPrecioVal')->default(0);
            $table->integer('rcUsuReg');
            $table->timestamp('rcFecCrea')->default(DB::raw('now()'));
            $table->dateTime('rcFecActualiza')->nullable();
            $table->integer('rcEst')->default(1);
        });

        Schema::table('recepcion', function ($table) {
            $table->foreign('idAl')->references('alId')->on('alumno');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recepcion');
    }
}
