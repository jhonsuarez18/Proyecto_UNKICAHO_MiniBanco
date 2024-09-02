<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReAfiliadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('re_afiliados', function (Blueprint $table) {
            $table->collate = 'latin1_spanish_ci';
            $table->bigInteger('afi_IDnumreg');
            $table->string('afi_disa',3);
            $table->string('afi_tipoformato',1);
            $table->string('afi_numregafis',9);
            $table->dateTime('afi_FecAfiliacion');
            $table->string('afi_tipodocumento',1);
            $table->string('afi_DNI',10);
            $table->dateTime('afi_fecnac');
            $table->string('afi_idsexo',1);
            $table->string('afi_telefono',10);
            $table->string('afi_appaterno',70);
            $table->string('afi_apmaterno',70);
            $table->string('afi_nombres',70);
            $table->string('afi_idubigeo',6);
            $table->string('afi_idcentropoblado',10);
            $table->string('afi_direccion',200);
            $table->string('afi_idEESSAfiliacion',10);
            $table->string('afi_idEESSAdscripcion',10);
            $table->string('afi_idusuariocrea',20);
            $table->dateTime('afi_feccrea');
            $table->string('afi_idusuarioact',20);
            $table->dateTime('afi_fecAct')->nullable();
            $table->dateTime('afi_fecbaja')->nullable();
            $table->string('afi_idUsuarioBaja',20)->nullable();
            $table->string('afi_estado',1)->nullable();
            $table->bigInteger('afi_edad')->nullable();
            $table->string('afi_periodo',4);
            $table->string('afi_mes',2);
            $table->bigInteger('afi_IDppdd')->nullable();
            $table->string('afi_tipodocPadre',2)->nullable();
            $table->string('afi_NroDocumentoPadre',10)->nullable();
            $table->string('afi_ApellidosyNombresPadre',140)->nullable();
            $table->string('afi_tipodocMadre',2)->nullable();
            $table->string('afi_NroDocumentoMadre',10)->nullable();
            $table->string('afi_ApellidosyNombresMadre',140)->nullable();
            $table->string('afi_tipodocConyugue',2)->nullable();
            $table->string('afi_NroDocumentoConyugue',10)->nullable();
            $table->string('afi_ApellidosyNombresConyugue',140)->nullable();
            $table->string('afi_DNIResponsable',8)->nullable();
            $table->string('afi_ApellidosResponsable',70)->nullable();
            $table->string('afi_NombresResponsable',70)->nullable();
            $table->string('afi_disaAdscripcion',3)->nullable();
            $table->string('afi_CodPais',6)->nullable();
            $table->string('afi_IdMotivoBaja',2)->nullable();
            $table->char('afi_ValidaRENIECOnLine',1)->nullable();
            $table->char('afi_TipoModificacion',1)->nullable();
            $table->string('afi_ValidaObservacion',250)->nullable();
            $table->char('afi_grupoetareo',2)->nullable();
            $table->string('afi_idplan',1)->nullable();
            $table->dateTime('FechaCopiaH5N1');
            $table->integer('IdTabla');
            $table->string('afi_tipodocumentobensep',1)->nullable();
            $table->string('afi_NroDocumentobensep',9)->nullable();
            $table->string('afi_appaternobensep',70)->nullable();
            $table->string('afi_apmaternobensep',70)->nullable();
            $table->string('afi_nombresbensep',70)->nullable();
            $table->dateTime('afi_fecnacbensep')->nullable();
            $table->string('afi_idsexobensep',1)->nullable();
            $table->string('afi_esgrupofocalizadoSisfoh',2)->nullable();
            $table->dateTime('afi_FecFallecimiento')->nullable();
            $table->char('afi_ReniecValida',1)->nullable();
            $table->dateTime('afi_fecCaducidad')->nullable();
            $table->char('afi_idTablaAfiliacion',1)->nullable();
            $table->bigInteger('afi_idNumRegAfiliacion')->nullable();
            $table->char('afi_idTablaInscripcion',1)->nullable();
            $table->bigInteger('afi_idNumRegInscripcion')->nullable();
            $table->dateTime('afi_fParto')->nullable();
            $table->char('afi_estadoVinculacion',2)->nullable();
            $table->char('afi_estadoCoincidenciasVinc',7)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('re_afiliados');
    }
}
