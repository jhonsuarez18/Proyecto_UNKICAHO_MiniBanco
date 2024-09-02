<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarcaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('marca', function (Blueprint $table) {
             $table->collate = 'latin1_spanish_ci';
             $table->bigIncrements('mId');
             $table->string('mDesc');
             $table->integer('mUsuReg');
             $table->timestamp('mFecCrea')->default(DB::raw('now()'));
             $table->dateTime('mFecActualiza')->nullable();
             $table->integer('mEst')->default(1);
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('marca');
    }
}
