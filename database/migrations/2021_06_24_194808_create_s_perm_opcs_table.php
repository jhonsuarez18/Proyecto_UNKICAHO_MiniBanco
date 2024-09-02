<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSPermOpcsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_perm_opcs', function (Blueprint $table) {
            $table->collate = 'latin1_spanish_ci';
            $table->bigIncrements('pOId');
            $table->unsignedBigInteger('idUsuario');
            $table->unsignedBigInteger('sOId');
            $table->timestamp('pOFecCrea')->default(DB::raw('now()'));
            $table->integer('pOEst')->default(1);
            $table->integer('pOUsuMod')->nullable();
            $table->timestamp('pOFecMod')->nullable();

        });
        Schema::table('s_perm_opcs', function ($table) {
            $table->foreign('sOId')->references('sOId')->on('s_sub_men_opc');
            $table->foreign('idUsuario')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('s_perm_opcs');
    }
}
