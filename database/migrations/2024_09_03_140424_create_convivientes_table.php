<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConvivientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conviviente', function (Blueprint $table) {
            $table->collate = 'latin1_spanish_ci';
            $table->bigIncrements('cvId')->unique();
            $table->unsignedBigInteger('idPe');
            $table->timestamp('cvFecCreacion');
            $table->dateTime('cvFecActualiza')->nullable();
            $table->integer('cvUsuReg');
            $table->integer('cvUsuActuali')->nullable();
            $table->integer('cvEstado')->default(1);
        });
        Schema::table('conviviente', function ($table) {
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
        Schema::dropIfExists('conviviente');
    }
}
