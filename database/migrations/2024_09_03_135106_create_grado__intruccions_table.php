<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradoIntruccionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grado_instruccion', function (Blueprint $table) {
            $table->collate = 'latin1_spanish_ci';
            $table->bigIncrements('giId');
            $table->string('giDesc');
            $table->integer('giUsuReg');
            $table->timestamp('giFecCrea')->default(DB::raw('now()'));
            $table->dateTime('giFecActualiza')->nullable();
            $table->integer('giEst')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grado_instruccion');
    }
}
