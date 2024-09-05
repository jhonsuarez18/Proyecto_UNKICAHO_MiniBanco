<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstadoCivilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estado_civil', function (Blueprint $table) {
            $table->collate = 'latin1_spanish_ci';
            $table->bigIncrements('ecId');
            $table->string('ecDesc');
            $table->integer('ecUsuReg');
            $table->timestamp('ecFecCrea')->default(DB::raw('now()'));
            $table->dateTime('ecFecActualiza')->nullable();
            $table->integer('ecEst')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estado_civils');
    }
}
