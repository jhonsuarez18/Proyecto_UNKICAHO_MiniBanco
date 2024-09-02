<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoDocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_doc', function (Blueprint $table) {
            $table->collate = 'latin1_spanish_ci';
            $table->bigIncrements('tdId');
            $table->string('tdDescLarga');
            $table->string('tdDescCorta');
            $table->string('tdTipo');
            $table->integer('tdLongitud');
            $table->integer('tdUsuReg');
            $table->timestamp('tdFecCrea')->default(DB::raw('now()'));
            $table->dateTime('tdFecActualiza')->nullable();
            $table->integer('tdEst')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipo_doc');
    }
}
