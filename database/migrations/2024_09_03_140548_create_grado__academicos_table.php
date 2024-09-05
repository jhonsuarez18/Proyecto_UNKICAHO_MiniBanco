<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradoAcademicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grado_academico', function (Blueprint $table) {
            $table->collate = 'latin1_spanish_ci';
            $table->bigIncrements('gaId');
            $table->string('gaDesc');
            $table->integer('gaUsuReg');
            $table->timestamp('gaFecCrea')->default(DB::raw('now()'));
            $table->dateTime('gaFecActualiza')->nullable();
            $table->integer('gaEst')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grado_academico');
    }
}
