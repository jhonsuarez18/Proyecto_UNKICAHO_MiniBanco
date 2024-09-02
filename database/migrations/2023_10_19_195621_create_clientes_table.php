<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliente', function (Blueprint $table) {
            $table->collate = 'latin1_spanish_ci';
            $table->bigIncrements('clId');
            $table->unsignedBigInteger('idPe');
            $table->integer('clUsuReg');
            $table->dateTime('clFecActualiza')->nullable();
            $table->timestamp('clFecCrea')->default(DB::raw('now()'));
            $table->integer('clEst')->default(1);
        });
        Schema::table('cliente', function ($table) {
            $table->foreign('idPe')->references('peId')->on('persona');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cliente');
    }
}
