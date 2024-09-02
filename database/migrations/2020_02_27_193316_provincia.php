<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Provincia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provincia', function (Blueprint $table) {
            $table->collate = 'latin1_spanish_ci';
            $table->bigIncrements('idProvincia')->unique();
            $table->unsignedBigInteger('idDepartamento');
            $table->string('codigo')->nullable();
            $table->string('descripcion')->nullable();
            $table->integer('estado')->default(1);
            $table->timestamps();
        }
        );
        Schema::table('provincia', function ($table) {
            $table->foreign('idDepartamento')->references('idDepartamento')->on('departamento');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('provincia');
    }
}
