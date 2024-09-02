<?php

namespace App;

use App\Http\Controllers\UtilController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class IndicadorSisModel extends Model
{

    public static function donaIndicador($nroIndicador)
    {
        DB::select('DROP TABLE IF EXISTS  dato1;');
        DB::select('DROP TABLE IF EXISTS dato2;');
        DB::select('CREATE TEMPORARY TABLE dato1
                SELECT * FROM datoindicador
                join ejecutora on codigoEjecutora = codigoEjeDatoIndicador
                join tipoindicador on CodigoTipoIndicador = tipoDatoIndicador
                where codIndiDatoIndicador=' . $nroIndicador . ' and 
                month(fecCorteDatoIndicador)=   
                                (select month(max(fecCorteDatoIndicador))
                                 FROM datoindicador )
                                 and tipoDatoIndicador=0;');
        DB::select('
                         CREATE TEMPORARY TABLE dato2
                        SELECT * FROM datoindicador
                        join ejecutora on codigoEjecutora = codigoEjeDatoIndicador
                        join tipoindicador on CodigoTipoIndicador = tipoDatoIndicador
                        where codIndiDatoIndicador=' . $nroIndicador . ' and
                        month(fecCorteDatoIndicador)=   
                                        (select month(max(fecCorteDatoIndicador))
                                         FROM datoindicador )
                                         and tipoDatoIndicador=1;');
        $data = DB::select('select d1.codigoEjeDatoIndicador ejecu ,d1.descripcionEjecutora desejecu,
                    round((d1.totalDatoIndicador/d2.totalDatoIndicador)*100,2) PORC
                    from dato1 d1 
                    join dato2 d2 on  d1.codigoEjeDatoIndicador=d2.codigoEjecutora 
                    order by d1.codigoEjeDatoIndicador asc ');
        return $data;

    }

    public static function indicadorRegional($nroIndicador)
    {
        DB::select('DROP TABLE IF EXISTS  dato1;');
        DB::select('DROP TABLE IF EXISTS dato2;');
        DB::select('CREATE TEMPORARY TABLE dato1
                SELECT 1 cod,sum(totalDatoIndicador) tot,codIndiDatoIndicador FROM datoindicador
                where codIndiDatoIndicador=' . $nroIndicador . ' and 
                month(fecCorteDatoIndicador)=   
                                (select month(max(fecCorteDatoIndicador))
                                 FROM datoindicador )
                                 and tipoDatoIndicador=0
                group by  codIndiDatoIndicador  ;
              ');
        DB::select('CREATE TEMPORARY TABLE dato2
            SELECT 1 cod,sum(totalDatoIndicador) tot,codIndiDatoIndicador FROM datoindicador
            join ejecutora on codigoEjecutora = codigoEjeDatoIndicador
            join tipoindicador on CodigoTipoIndicador = tipoDatoIndicador
            where codIndiDatoIndicador=' . $nroIndicador . ' and
            month(fecCorteDatoIndicador)=   
                (select month(max(fecCorteDatoIndicador))
                 FROM datoindicador )
                 and tipoDatoIndicador=1
                 group by  codIndiDatoIndicador  ;');
        $data = DB::select('select round((d1.tot/d2.tot)*100,2) PORC,n.meta_indicador meta
   
            from dato1 d1
            join dato2 d2 on d1.cod=d2.cod
            join nroindicador n on d1.codIndiDatoIndicador =n.codigoIndicador');
        return $data;
    }

    public static function indicadoresMesActual()
    {
        DB::select('DROP TABLE IF EXISTS  dato1;');
        DB::select('DROP TABLE IF EXISTS dato2;');
        DB::select('
                CREATE TEMPORARY TABLE dato1
                SELECT ni.codigoIndicador,ni.tituloIndicador,di.tipoDatoIndicador,
                sum(di.totalDatoIndicador) tot,
                di.fecCorteDatoIndicador,ni.meta_indicador
                 FROM datoindicador di
                join nroindicador ni
                on ni.codigoIndicador=di.codIndiDatoIndicador
                where month(di.fecCorteDatoIndicador)=   
                (select month(max(fecCorteDatoIndicador))
                 FROM datoindicador )
                and
                year(di.fecCorteDatoIndicador) = (year(now())-1)
                and di.tipoDatoIndicador= 0
                group by ni.codigoIndicador,di.tipoDatoIndicador,ni.tituloIndicador,di.fecCorteDatoIndicador,ni.meta_indicador
                ');
        DB::select('
                CREATE TEMPORARY TABLE dato2
                SELECT ni.codigoIndicador,ni.tituloIndicador,di.tipoDatoIndicador,sum(di.totalDatoIndicador) tot,
                di.fecCorteDatoIndicador,ni.meta_indicador
                 FROM datoindicador di
                join nroindicador ni
                on ni.codigoIndicador=di.codIndiDatoIndicador
                where month(di.fecCorteDatoIndicador)=   
                (select month(max(fecCorteDatoIndicador))
                 FROM datoindicador )
                and
                year(di.fecCorteDatoIndicador) = (year(now())-1)
                and di.tipoDatoIndicador= 1
                group by ni.codigoIndicador,di.tipoDatoIndicador,ni.tituloIndicador,di.fecCorteDatoIndicador,ni.meta_indicador ');


        $data = DB::select('select d1.codigoIndicador,d1.tituloIndicador,round((d1.tot/d2.tot)*100,2) porc,d1.fecCorteDatoIndicador,d1.meta_indicador meta
                                from dato1 d1
                                join dato2 d2 on d1.codigoIndicador = d2.codigoIndicador');

        return $data;

    }

    public static function indicadoresMesAnterior()
    {
        DB::select('DROP TABLE IF EXISTS  dato1;');
        DB::select('DROP TABLE IF EXISTS dato2;');

        DB::select('
                CREATE TEMPORARY TABLE dato1
                SELECT ni.codigoIndicador,ni.tituloIndicador,di.tipoDatoIndicador,
                sum(di.totalDatoIndicador) tot,
                di.fecCorteDatoIndicador
                 FROM datoindicador di
                join nroindicador ni
                on ni.codigoIndicador=di.codIndiDatoIndicador
                where month(di.fecCorteDatoIndicador)=   
                (select month(max(fecCorteDatoIndicador))-1
                 FROM datoindicador )
                and
                year(di.fecCorteDatoIndicador) = year(now())-1
                and di.tipoDatoIndicador= 0
                group by ni.codigoIndicador,di.tipoDatoIndicador,ni.tituloIndicador,di.fecCorteDatoIndicador;
                ');
        DB::select('
                CREATE TEMPORARY TABLE dato2
                SELECT ni.codigoIndicador,ni.tituloIndicador,di.tipoDatoIndicador,sum(di.totalDatoIndicador) tot,
                di.fecCorteDatoIndicador
                 FROM datoindicador di
                join nroindicador ni
                on ni.codigoIndicador=di.codIndiDatoIndicador
                where month(di.fecCorteDatoIndicador)=   
                (select month(max(fecCorteDatoIndicador))-1
                 FROM datoindicador )
                and
                year(di.fecCorteDatoIndicador) = year(now())-1
                and di.tipoDatoIndicador= 1
                group by ni.codigoIndicador,di.tipoDatoIndicador,ni.tituloIndicador,di.fecCorteDatoIndicador ;');


        return DB::select('select d1.codigoIndicador,d1.tituloIndicador,round((d1.tot/d2.tot)*100,2) porc,d1.fecCorteDatoIndicador
                                from dato1 d1
                                join dato2 d2 on d1.codigoIndicador = d2.codigoIndicador');

    }

    Public static function obtenerInformacionIndicador($nroIndicador)
    {
        $query = DB::table('nroindicador')->select('descripIndicador', 'tituloIndicador')
            ->where([['codigoIndicador', '=', $nroIndicador], ['estadoIndicador', '=', '1']])->get();
        return $query;
    }


    public static function llenarGrafico($nroIndicador, $codEjecutora)
    {
        DB::select('DROP TABLE IF EXISTS  dato1');
        DB::select('DROP TABLE IF EXISTS dato2');
        DB::select('CREATE TEMPORARY TABLE dato1
         SELECT codigoEjeDatoIndicador, tipoDatoIndicador,
         totalDatoIndicador, fecCorteDatoIndicador, fecCreacionDatoIndicador, 
         codIndiDatoIndicador from datoindicador where codIndiDatoIndicador = ' . $nroIndicador . '
         and codigoEjeDatoIndicador = ' . $codEjecutora . ' and tipoDatoIndicador = 0;');

        DB::select('CREATE TEMPORARY TABLE dato2
         SELECT codigoEjeDatoIndicador, tipoDatoIndicador,
         totalDatoIndicador, fecCorteDatoIndicador, fecCreacionDatoIndicador, 
         codIndiDatoIndicador from datoindicador where codIndiDatoIndicador = ' . $nroIndicador . '
         and codigoEjeDatoIndicador = ' . $codEjecutora . ' and tipoDatoIndicador = 1;');
        return DB::select('select  a.codigoEjeDatoIndicador codEje,
            a.fecCorteDatoIndicador fecCorte,
             round(((a.totalDatoIndicador/b.totalDatoIndicador))*100,2)  total from dato1 a 
            join dato2 b on a.codigoEjeDatoIndicador=b.codigoEjeDatoIndicador
            and a.fecCorteDatoIndicador=b.fecCorteDatoIndicador
            order by fecCorte asc ');
    }

    public static function porcentajePorMeses($codindicador)
    {
        DB::select('DROP TABLE IF EXISTS  dato1');
        DB::select('DROP TABLE IF EXISTS  dato2');
        DB::select('CREATE TEMPORARY TABLE dato1
            SELECT tipoDatoIndicador,fecCorteDatoIndicador ,sum(totalDatoIndicador) tot,codIndiDatoIndicador 
            FROM datoindicador
            WHERE codIndiDatoIndicador=' . $codindicador . ' and tipoDatoIndicador=0
            group by tipoDatoIndicador,fecCorteDatoIndicador,codIndiDatoIndicador;');
        DB::select('CREATE TEMPORARY TABLE dato2
                SELECT tipoDatoIndicador,fecCorteDatoIndicador ,sum(totalDatoIndicador) tot,codIndiDatoIndicador 
                FROM datoindicador
                WHERE codIndiDatoIndicador=' . $codindicador . ' and tipoDatoIndicador=1
                group by tipoDatoIndicador,fecCorteDatoIndicador,codIndiDatoIndicador;');
        return DB::select('select round(d1.tot) num,round(d2.tot) denom,
                                round((d1.tot/d2.tot)*100) porc,
                                round((d2.tot*(n.meta_indicador/100))) meta,
                                n.meta_indicador meta_indi,d1.fecCorteDatoIndicador dato,n.descripIndicador,n.numerador,n.denominador, n.image as image 
                                 from   dato1 d1
                                join dato2  d2 on d1.fecCorteDatoIndicador=d2.fecCorteDatoIndicador
                                join nroindicador n on n.codigoIndicador= d1.codIndiDatoIndicador
          ');
    }

    public static function cantEjecuMesMetaLog($mes, $cod)
    {
        DB::select('DROP TABLE IF EXISTS  dato1');
        DB::select('DROP TABLE IF EXISTS  dato2');
        DB::select('DROP TABLE IF EXISTS  dato3');
        DB::select('CREATE TEMPORARY TABLE dato1
                SELECT totalDatoIndicador  tot,codIndiDatoIndicador,codigoEjeDatoIndicador,
                fecCorteDatoIndicador
                FROM datoindicador
                 where codIndiDatoIndicador=' . $cod . ' and  month(fecCorteDatoIndicador) =' . $mes . '
                and tipoDatoIndicador=0
                 group by   codIndiDatoIndicador,codigoEjeDatoIndicador,fecCorteDatoIndicador,totalDatoIndicador          
                                 ;');
        DB::select(' CREATE TEMPORARY TABLE dato2
             SELECT totalDatoIndicador  tot,codIndiDatoIndicador,codigoEjeDatoIndicador,
                fecCorteDatoIndicador
                FROM datoindicador
                where codIndiDatoIndicador=' . $cod . ' and  month(fecCorteDatoIndicador) =' . $mes . '
                and tipoDatoIndicador=1
                 group by   codIndiDatoIndicador,codigoEjeDatoIndicador,fecCorteDatoIndicador,totalDatoIndicador  
                 ;');
        DB::select('CREATE TEMPORARY TABLE dato3
    select d1.codIndiDatoIndicador, sum(ROUND(d1.tot)) tot
                            from dato1 d1
                            group by d1.codIndiDatoIndicador;');

        return DB::select('select E.descripcionEjecutora,N.codigoIndicador,d1.codigoEjeDatoIndicador,
ROUND((d1.tot/d3.tot)*100,2) PORMENSUAL,
               ROUND(d1.tot) LOGRO,ROUND(d2.tot) POBLACION,ROUND(d2.tot*(N.meta_indicador/100)) META,
                   ROUND((d1.tot/d2.tot)*100,2) PORCENTAJE,  ROUND((d1.tot/ROUND(d2.tot*(N.meta_indicador/100)))*100,2) PORCENTAJEMET,
               N.meta_indicador
                        from dato1 d1
                        join dato2 d2 on d1.codigoEjeDatoIndicador=d2.codigoEjeDatoIndicador
                        JOIN nroindicador N ON d1.codIndiDatoIndicador=N.codigoIndicador
                        JOIN ejecutora E ON E.codigoEjecutora=d1.codigoEjeDatoIndicador
                        JOIN dato3 d3 on d1.codIndiDatoIndicador =d3.codIndiDatoIndicador;');
    }

    public static function ejecutoraDesempeñoMeses($ejecu, $codigo)
    {
        DB::select('DROP TABLE IF EXISTS  dato1');
        DB::select('DROP TABLE IF EXISTS  dato2');
        DB::select('CREATE TEMPORARY TABLE dato1
               SELECT totalDatoIndicador  tot,codIndiDatoIndicador,codigoEjeDatoIndicador,
                fecCorteDatoIndicador
                FROM datoindicador
                where codIndiDatoIndicador=' . $codigo . '
                and tipoDatoIndicador=0 and codigoEjeDatoIndicador =' . $ejecu . '        
                                 ;');
        DB::select('CREATE TEMPORARY TABLE dato2
             SELECT totalDatoIndicador  tot,codIndiDatoIndicador,codigoEjeDatoIndicador,
                fecCorteDatoIndicador
                FROM datoindicador
                where codIndiDatoIndicador=' . $codigo . ' 
                and tipoDatoIndicador=1 and codigoEjeDatoIndicador =' . $ejecu . '
                 ;');

        return DB::select('select round(d1.tot) NUM,round(d2.tot) DENOM, 
round((d1.tot/d2.tot)*100) PORC,round(d2.tot*(N.meta_indicador/100)) META,
MONTH(d1.fecCorteDatoIndicador) MES,
N.meta_indicador MetaIndi,d1.fecCorteDatoIndicador
                        from dato1 d1
                        join dato2 d2 on d1.fecCorteDatoIndicador=d2.fecCorteDatoIndicador
                        JOIN nroindicador N ON d1.codIndiDatoIndicador=N.codigoIndicador
                        JOIN ejecutora E ON E.codigoEjecutora=d1.codigoEjeDatoIndicador;');
    }

    public static function comentarios($codindi, $fecha)
    {

        return DB::select(
            'SELECT codigoGrafico,max(comentario) comentario,fechaCreacion,codIndicador 
FROM comentario
where estadoComentario=1
and codIndicador=' . $codindi . ' and fechaCorte="' . $fecha . '"
group by fechaCreacion,codigoGrafico,codIndicador'
        );
    }

    public static function modificarComentario($idgrafico, $idindi, $comentario, $fecha)
    {
        $fechacomentarios = null;
        $array = array();
        $array = DB::table('comentario')->select(DB::raw('count(*) cant'))
            ->where([['codigoGrafico', '=', $idgrafico], ['codIndicador', '=', $idindi], ['fechaCorte', '=', $fecha]])
            ->get();
        foreach ($array as $arr) {
            $cant = $arr->cant;
        }

        if ($cant === 0) {
            return $result = DB::table('comentario')->insert(
                ['codigoGrafico' => $idgrafico, 'idUsuario' => Auth::user()->id, 'codIndicador' => $idindi, 'comentario' => $comentario,
                    'fechaCreacion' => UtilController::fecha(), 'fechaCorte' => $fecha]
            );
        } else {

            return $result = DB::table('comentario')
                ->where(['codigoGrafico' => $idgrafico, 'codIndicador' => $idindi, 'fechaCorte' => $fecha])
                ->update(['comentario' => $comentario, 'idUsuario' => Auth::user()->id, 'fechaCreacion' => UtilController::fecha(), 'fechaCorte' => $fecha]);

        }
    }

    public static function obtenerRespuestas($codindicador, $fecha)
    {

        return DB::select('SELECT * FROM respuesta as r
                                join users u on u.id=r.idusuario
                                where r.fechacorte="' . $fecha . '"
                                and r.estado=1 and r.codindicador=' . $codindicador . '
                                order by fechacreacion desc');

    }

    public static function insertarRespuesta($codindi, $fecha, $respuest)
    {
        return $result = DB::table('respuesta')->insert(
            ['codindicador' => $codindi, 'idusuario' => Auth::user()->id, 'respuesta' => $respuest,
                'fechaCreacion' => UtilController::fecha(), 'fechaCorte' => $fecha]);

    }
}
