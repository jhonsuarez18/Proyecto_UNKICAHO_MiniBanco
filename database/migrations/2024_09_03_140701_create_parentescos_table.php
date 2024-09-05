<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParentescosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parentesco', function (Blueprint $table) {
            $table->collate = 'latin1_spanish_ci';
            $table->bigIncrements('prtId');
            $table->string('prtDesc');
            $table->integer('prtUsuReg');
            $table->timestamp('prtFecCrea')->default(DB::raw('now()'));
            $table->dateTime('prtFecActualiza')->nullable();
            $table->integer('prtEst')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parentescos');
    }
}
