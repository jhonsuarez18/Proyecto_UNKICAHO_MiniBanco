<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_clientes', function (Blueprint $table) {
            $table->collate = 'latin1_spanish_ci';
            $table->bigIncrements('tclId');
            $table->string('tclDesc');
            $table->integer('tclUsuReg');
            $table->timestamp('tclFecCrea')->default(DB::raw('now()'));
            $table->dateTime('tclFecActualiza')->nullable();
            $table->integer('tclEst')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('tipo_clientes');
    }
}
