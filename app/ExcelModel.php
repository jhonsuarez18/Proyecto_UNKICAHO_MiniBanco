<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ExcelModel extends Model
{
    public static function indicadoresEjecutora($idEjecutora)
    {
        DB::select('DROP TABLE IF EXISTS  dato1;');
        DB::select('CREATE TEMPORARY TABLE dato1
            SELECT codigoEjeDatoIndicador,tipoDatoIndicador,codIndiDatoIndicador,
            case when  month(fecCorteDatoIndicador) = 1 then 
            totalDatoIndicador end mes1,
            case when  month(fecCorteDatoIndicador) = 2 then 
            totalDatoIndicador end mes2,
            case when  month(fecCorteDatoIndicador) = 3 then totalDatoIndicador end mes3,
            case when  month(fecCorteDatoIndicador) = 4 then totalDatoIndicador end mes4,
            case when  month(fecCorteDatoIndicador) = 5 then totalDatoIndicador end mes5,
            case when  month(fecCorteDatoIndicador) = 6 then totalDatoIndicador end mes6,
            case when  month(fecCorteDatoIndicador) = 7 then totalDatoIndicador end mes7,
            case when  month(fecCorteDatoIndicador) = 8 then totalDatoIndicador end mes8,
            case when  month(fecCorteDatoIndicador) = 9 then totalDatoIndicador end mes9
             FROM diresa.datoindicador
            order by fecCorteDatoIndicador;');
        $data = DB::select('select tituloIndicador,codigoEjeDatoIndicador,descripcionEjecutora,DescripTipoIndicador,
                    sum(IFNULL(mes1,0)) ENERO,sum(IFNULL(mes2,0)) FEBRERO,sum(IFNULL(mes3,0)) MARZO,
                    sum(IFNULL(mes4,0)) ABRIL,sum(IFNULL(mes5,0)) MAYO,sum(IFNULL(mes6,0)) JUNIO,
                    sum(IFNULL(mes7,0)) JULIO,sum(IFNULL(mes8,0)) AGOSTO,sum(IFNULL(mes9,0)) SEPTIEMBRE from dato1
                    JOIN ejecutora ON codigoEjecutora =  codigoEjeDatoIndicador
                    JOIN tipoindicador ON tipoDatoIndicador=CodigoTipoIndicador
                    JOIN nroindicador ON codigoIndicador=codIndiDatoIndicador
                    where codigoEjeDatoIndicador = "'.$idEjecutora.'"
                    group by codigoEjeDatoIndicador,codIndiDatoIndicador,tipoDatoIndicador,tituloIndicador,descripcionEjecutora,
                    DescripTipoIndicador
                    ORDER BY codIndiDatoIndicador,codigoEjeDatoIndicador,DescripTipoIndicador desc;');
        return $data;

    }

}
