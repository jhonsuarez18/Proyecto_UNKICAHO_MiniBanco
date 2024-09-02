<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSSubMenOpcsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_sub_men_opc', function (Blueprint $table) {
            $table->collate = 'latin1_spanish_ci';
            $table->bigIncrements('sOId');
            $table->unsignedBigInteger('OId');
            $table->unsignedBigInteger('idSubMenu');
            $table->integer('sOEstado')->default(1);
            $table->timestamp('sOFecCrea')->default(DB::raw('now()'));
            $table->integer('sOEst')->default(1);
            $table->integer('sOUsuMod')->nullable();
            $table->timestamp('sOFecMod')->nullable();
        });
        Schema::table('s_sub_men_opc', function ($table) {
            $table->foreign('OId')->references('OId')->on('s_opcion');
            $table->foreign('idSubMenu')->references('idSubMenu')->on('submenu');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('s_sub_men_opc');
    }
}
