<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSOpcionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_opcion', function (Blueprint $table) {
            $table->collate = 'latin1_spanish_ci';
            $table->bigIncrements('OId');
            $table->string('oNombre')->nullable();
            $table->string('OIcono', 150)->nullable();
            $table->string('OColor')->nullable();
            $table->integer('OUsuReg')->nullable();
            $table->integer('OEstado')->default(1);
            $table->timestamp('OFecCrea')->default(DB::raw('now()'));
            $table->integer('OUsuMod')->nullable();
            $table->timestamp('OFecMod')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('s_opcion');
    }
}
