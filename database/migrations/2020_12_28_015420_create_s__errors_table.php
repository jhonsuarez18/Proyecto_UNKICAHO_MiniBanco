<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSErrorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_error', function (Blueprint $table) {
            $table->collate = 'latin1_spanish_ci';
            $table->bigIncrements('eId');
            $table->text('eDescripcion')->nullable();
            $table->string('eClase',45)->nullable();
            $table->string('eMetodo',45)->nullable();
            $table->integer('eUsuReg');
            $table->timestamp('eFecCrea')->default(DB::raw('now()'));
            $table->integer('eEst')->default(1);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('s_error');
    }
}
