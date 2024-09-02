<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Table;

class EPPresupuesto extends Model
{
    protected $table = 'e_p_presupuesto';
    public $primaryKey = 'pId';
    public $timestamps = false;

    //POR ESPECIFICA DE GASTO
    public static function reporteEjeEspecifica()
    {
        DB::select('DROP TABLE IF EXISTS  dato1;');
        DB::select('CREATE TEMPORARY TABLE dato1
            SELECT e.eGCod,e.eGDesc,sum(p.pMonto) as tot,(select sum(pMonto) from e_p_presupuesto) as tota
            FROM e_p_especifica_gasto e
            JOIN e_p_meta_epecifica_gasto m ON e.eGId=m.eGId
            join e_p_presupuesto p on p.mEGId=m.mEGId
            where p.pEst=1 and YEAR(p.pFecCrea) = YEAR( NOW())
            group by e.eGCod,e.eGDesc;');
        return DB::select('select eGCod,eGDesc,tot,concat(round((tot/tota)*100,2),"%") as por  from dato1');
    }

    //REPORTE CEPLAN
    public static function reporteCeplan()
    {
        DB::select('DROP TABLE IF EXISTS  dato1;');
        DB::select('DROP TABLE IF EXISTS  dato2;');
        DB::select('DROP TABLE IF EXISTS  dato3');
        DB::select('DROP TABLE IF EXISTS  dato4');
        DB::select('CREATE TEMPORARY TABLE dato1
 select mEGId,sum(est0) as est0 ,sum(est1) as est1,sum(est2) as est2,sum(est3) as est3,sum(est4) as est4
                    from (SELECT  pe.mEGId,
                    case when pe.peEstPed=0 then sum(pe.peMonto)  else 0.00
                    end est0,
                    case when pe.peEstPed=1 then sum(pe.peMonto) else 0.00
                    end est1,
                    case when pe.peEstPed=2 then sum(pe.peMonto) else 0.00
                    end est2,
                    case when pe.peEstPed=3 then sum(pe.peMonto) else 0.00
                    end est3,
                    case when pe.peEstPed=4 then sum(pe.peMonto) else 0.00
                    end est4
                    FROM e_p_pedido pe
                    where pe.peEst=1
                    group by pe.peEstPed,pe.mEGId)x
                    group by mEGId;');
        DB::select('CREATE TEMPORARY TABLE dato2
                     select p.pId,p.mPId,concat("TRAN : ",tran.trNumRj) as trNumRj,tran.trId,pp.pPDesc,m.mCod,eg.eGCod,eg.eGDesc,sum(ifnull(p.pMonto,0.00)) as mont,meg.mEGId
                     from e_p_meta_epecifica_gasto meg
                    left join e_p_presupuesto  as p on p.mEGId=meg.mEGId
                    left join e_p_transferencia as tran on tran.trId = p.trId
                    join e_p_especifica_gasto as eg on meg.eGId=eg.eGId
                    join e_p_meta m on meg.mId=m.mId
                    join e_p_programa_presupuestal as pp on m.pPId=pp.pPId
                     where p.pEst=1 and YEAR(p.pFecCrea) = YEAR( NOW())
                    group by pp.pPDesc,m.mCod,eg.eGCod,eg.eGDesc,meg.mEGId,tran.trNumRj,tran.trId,p.mPId,p.pId,p.mEGId
                    order by mCod;');
        DB::select(' CREATE TEMPORARY TABLE dato3
                    select dato2.mEGId,dato2.pId,dato2.trId,pPDesc, mCod,concat(eGCod) as eGDesc,trNumRj,mont AS mont,ifnull(est0,0.00) as est0,ifnull(est1,0.00) as est1,ifnull(est2,0.00) as est2,ifnull(est3,0.00) as est3, ifnull(est4,0.00) as est4,ifnull(est0+est1+est2+est3+est4,0.00) as totejec, ifnull(mont-(ifnull(est0+est1+est2+est3+est4,0.00)),0.00) as sobr  from dato1
                                    right join dato2 on dato1.mEGId=dato2.mEGId
                                    order by mCod;');
        DB::select(' CREATE TEMPORARY TABLE dato4
                select mEGId,trId,pPDesc,mCod,left(eGDesc,4) eGDesc,trNumRj,sum(mont) as mont,sum(est0) as est0,
                 sum(est1) as est1,sum(est2) as est2,sum(est3) as est3,sum(est4) as est4,sum(totejec) as totejec,sum(sobr)  as sobr from dato3
                 group by pPDesc,mCod,eGDesc,trNumRj,trId,mEGId;');

        return DB::select('select pPDesc,mCod,eGDesc,sum(mont) as mont,sum(est0) as est0,
                 sum(est1) as est1,sum(est2) as est2,sum(est3) as est3,sum(est4) as est4,sum(totejec) as totejec,sum(sobr) as sobr from dato4
                 where trNumRj is not null and mont > 0
                 group by pPDesc,mCod,eGDesc
                 order by pPDesc,mCod,eGDesc');
    }

    //REPORTE GENERAL
    public static function reporteEjeucion()
    {
        DB::select('DROP TABLE IF EXISTS  dato1');
        DB::select('DROP TABLE IF EXISTS  dato2');
        DB::select('DROP TABLE IF EXISTS  dato3');
        DB::select('DROP TABLE IF EXISTS  dato4');
        DB::select('   CREATE TEMPORARY TABLE dato1
 select mEGId,trid,sum(est0) as est0 ,sum(est1) as est1,sum(est2) as est2,sum(est3) as est3,sum(est4) as est4
                    from (SELECT  pe.mEGId,pe.trid,
                    case when pe.peEstPed=0 then sum(pe.peMonto)  else 0.00
                    end est0,
                    case when pe.peEstPed=1 then sum(pe.peMonto) else 0.00
                    end est1,
                    case when pe.peEstPed=2 then sum(pe.peMonto) else 0.00
                    end est2,
                    case when pe.peEstPed=3 then sum(pe.peMonto) else 0.00
                    end est3,
                    case when pe.peEstPed=4 then sum(pe.peMonto) else 0.00
                    end est4
                    FROM e_p_pedido pe
                    where pe.peEst=1 and YEAR(pe.peFecCrea) = YEAR( NOW())
                    group by pe.peEstPed,pe.mEGId,pe.trid)x
                    group by mEGId,trid;');

        DB::select('   CREATE TEMPORARY TABLE dato2
                     select p.mEGId,tran.trId,concat("TRAN : ",tran.trNumRj) as trNumRj,pp.pPDesc,
                     m.mCod,eg.eGCod,eg.eGDesc,sum(ifnull(p.pMonto,0.00)) as mont
                     from e_p_meta_epecifica_gasto meg
                    left join e_p_presupuesto  as p on p.mEGId=meg.mEGId
                    left join e_p_transferencia as tran on tran.trId = p.trId
                    join e_p_especifica_gasto as eg on meg.eGId=eg.eGId
                    join e_p_meta m on meg.mId=m.mId
                    join e_p_programa_presupuestal as pp on m.pPId=pp.pPId
                    where p.pEst=1 and YEAR(p.pFecCrea) = YEAR( NOW())
                    group by pp.pPDesc,m.mCod,eg.eGCod,eg.eGDesc,meg.mEGId,tran.trNumRj,tran.trId,p.mEGId
                    order by mCod;');
        DB::select('  CREATE TEMPORARY TABLE dato3
                    select dato2.mEGId,dato2.trId,pPDesc, mCod,concat(eGCod) as eGDesc,trNumRj,mont AS mont,
                    ifnull(est0,0.00) as est0,ifnull(est1,0.00) as est1,ifnull(est2,0.00) as est2,ifnull(est3,0.00) as est3,
                    ifnull(est4,0.00) as est4,ifnull(est0+est1+est2+est3+est4,0.00) as totejec,
                    ifnull(mont-(ifnull(est0+est1+est2+est3+est4,0.00)),0.00) as sobr
                    from dato1
                                    right join dato2 on (dato1.mEGId=dato2.mEGId and dato2.trid=dato1.trid)

                                    order by mCod;');
        DB::select('  CREATE TEMPORARY TABLE dato4
select mEGId,trId,pPDesc,mCod,eGDesc,trNumRj,sum(mont) as mont,sum(est0) as est0,
                 sum(est1) as est1,sum(est2) as est2,sum(est3) as est3,sum(est4) as est4,
                 sum(totejec) as totejec,sum(sobr)  as sobr from dato3
                 group by pPDesc,mCod,eGDesc,trNumRj,trId,mEGId,totejec,est0,
                 est1,est2,est3;');

        return DB::select('select mEGId,trId,pPDesc,mCod,eGDesc,trNumRj,mont,est0,
                 est1,est2,est3,est4,totejec,sobr from dato4
                 where trNumRj is not null and mont > 0');

    }

    public static function obtenerPresupuestoMetaEg()
    {
        return DB::table('e_p_presupuesto as p')
            ->select('*')
            ->join('e_p_meta_epecifica_gasto as meg', 'meg.mEGId', '=', 'p.mEGId')
            ->join('e_p_transferencia as tr', 'tr.trId', '=', 'p.trId')
            ->join('e_p_meta as m', 'm.mId', '=', 'meg.mId')
            ->join('e_p_especifica_gasto as es', 'es.eGId', '=', 'meg.eGId')
            ->whereNull('p.mPId')
            ->where(DB::raw('YEAR(p.pFecCrea)') ,'=',DB::raw('YEAR( NOW())'))
            ->orderBy('p.pFecCrea', 'desc')
            ->get();


    }

    public static function obtenerTransferenciasModifica($idmg)
    {
        return DB::table('e_p_presupuesto as p')->select('p.pId', 'p.trId', DB::raw('concat(ifnull(concat("Mod:",n.nNro,"|"),""),tr.trNumRj) as pre'))
            ->leftJoin('e_p_transferencia as tr', 'tr.trId', '=', 'p.trId')
            ->leftjoin('e_p_modificacion_prespuestal as m', 'm.mPId', '=', 'p.mPId')
            ->leftjoin('e_p_nota_modificatoria as n', 'n.nId', '=', 'm.nId')
            ->where(DB::raw('YEAR(p.pFecCrea)') ,'=',DB::raw('YEAR( NOW())'))
            ->where('p.mEGId', '=', $idmg)->get();
    }

    public static function obtenerTransferenciasModifica2($idmg)
    {
        return DB::table('e_p_presupuesto as p')->select('p.mEGId', 'p.trId', DB::raw('tr.trNumRj as pre'))
            ->leftJoin('e_p_transferencia as tr', 'tr.trId', '=', 'p.trId')
            ->where('p.mEGId', '=', $idmg)
            ->where(DB::raw('YEAR(p.pFecCrea)') ,'=',DB::raw('YEAR( NOW())'))
            ->groupBy('p.mEGId', 'p.trId', 'tr.trNumRj')
            ->get();
    }

    public static function obtenerSaldo($megid, $trid)
    {

        /*DB::select('DROP TABLE IF EXISTS  tb1;');
        DB::select('create table tb1
              SELECT pr.pId,pr.mEGId,pr.trId, pr.pMonto,sum(ifnull(peMonto,0)) as monpe FROM e_p_presupuesto pr
            left join e_p_pedido p on p.mEGId=pr.mEGId and  p.peEst=1
            where pr.mEGId='.$megid.' and pr.trId='.$trid.'
            group by mEGId,trId,pr.pId,pMonto;');


        return DB::select('select mEGId,trId,ifnull(sum(pMonto)-sum(monpe),0) as sal from tb1
               group by mEGId,trId;');*/

        $res = DB::table('e_p_pedido')->SELECT('mEGId', 'trId', DB::raw('sum(peMonto) as monto'))
            ->where('mEGId', '=', $megid)
            ->where('trId', '=', $trid)
            ->where('peEst', '=', 1)
            ->groupby('mEGId', 'trId');

        return DB::table('e_p_presupuesto as p')
            ->select('p.mEGId', 'p.trId',
                DB::raw("ifnull(sum(p.pMonto),0) as mont"),
                DB::raw("(sum(p.pMonto)-ifnull(res.monto,0)) as sal"))
            ->leftJoinSub($res, 'res', function ($join) {
                $join->on('res.mEGId', '=', 'p.mEGId')->on('res.trId', '=', 'p.trId');
            })
            ->where('p.mEGId', '=', $megid)->where('p.trId', '=', $trid)
            ->where('pEst', '=', 1)
            ->where(DB::raw('YEAR(p.pFecCrea)') ,'=',DB::raw('YEAR( NOW())'))
            ->groupby(['p.mEGId', 'p.trId']
                , 'res.monto'
            )
            ->get();
    }

    //REPORTE TRANSFERENCIA
    public static function obtenerReporteTransferencia()
    {

        DB::select('DROP TABLE IF EXISTS  dato1;');

        DB::select('create table dato1
                         select trId,
						 case when pre.mPId is null then ifnull(pre.pMonto,0) Else 0 end as montin
						from e_p_presupuesto pre
						left join (select mp.mPId from  e_p_modificacion_prespuestal mp
						 join e_p_nota_modificatoria nm on nm.nId=mp.nId
						 where nm.idEjecutora is not null)x on x.mPId=pre.mPId and YEAR(pre.pFecCrea) = YEAR( NOW())
                         where pre.pEst=1;');

        DB::select('DROP TABLE IF EXISTS  dato4; ');

        DB::select('create table dato4
							select pre.trId,sum(pre.pMonto) as tot
							from e_p_presupuesto pre
							join   e_p_modificacion_prespuestal mp on mp.mPId=pre.mPId
							 join e_p_nota_modificatoria nm on nm.nId=mp.nId
							 where nm.idEjecutora is not null and YEAR(pre.pFecCrea) = YEAR( NOW())
							group by pre.trId;');

        DB::select(' DROP TABLE IF EXISTS  dato2;');

        DB::select('	create table dato2
                            select tr.trId, tr.trNumRj, tr.trCodTrans,tr.trMonto,sum(montin) as montin,
                                   ifnull(dt4.tot,0) as montT from dato1 pr
                            join e_p_transferencia as tr on tr.trId = pr.trId
                            left join dato4 as dt4 on dt4.trId=tr.trId
                            where  YEAR(tr.trFecCrea) = YEAR( NOW())
                            group by tr.trId, tr.trNumRj, tr.trCodTrans,tr.trMonto,dt4.tot;');

        DB::select('DROP TABLE IF EXISTS  dato3;');

        DB::select('	create table dato3

            select  d.trId,d.trNumRj,d.trCodTrans,d.trMonto,d.montin,d.montT ,ifnull(sum(x.tot), 0) monteje
                        from(select pe.mEGId,pe.trId,sum(pe.peMonto) as tot from e_p_pedido as pe
                        where pe.peEst = 1
                        group by pe.mEGId,pe.trId) as x
						right join dato2 d on d.trId = x.trId
                       -- right Join e_p_meta_epecifica_gasto as meg on meg.mEGId = x.mEGId
                        -- right Join e_p_presupuesto as pr on pr.mEGId = meg.mEGId
                        -- where pr.pEst = 1
                        group By d.trId,d.trNumRj,d.trCodTrans,d.trMonto,d.montin,d.montT;');

        return DB::select('select trId, trNumRj,trCodTrans,trMonto,montin,abs(montT) as montT,(montin-abs(montT)) as pim,monteje,(montin) - (monteje - abs(montT)) as res
                        from dato3
                        group by trId, trNumRj,trCodTrans,trMonto,montin,montT,monteje');
    }

    //POR META Y ESPECIFICA DE GASTO
    public static function obtenerReporteFinalidad()
    {
        DB::select('DROP TABLE IF EXISTS  dato1;');
        DB::select('DROP TABLE IF EXISTS  dato2;');
        DB::select('DROP TABLE IF EXISTS  dato3;');
        DB::select('CREATE TEMPORARY TABLE dato1
                             select pre.mEGId,sum(est1) as est1,sum(est3) as est3
                                                from (SELECT  pe.mEGId,
                                                case when pe.peEstPed=1 then sum(pe.peMonto) else 0.00 end est1,
                                                case when pe.peEstPed=3 then sum(pe.peMonto) else 0.00
                                                end est3
                                                FROM e_p_pedido pe
                                                where pe.peEst=1
                                                group by pe.peEstPed,pe.mEGId)x
                                                join e_p_meta_epecifica_gasto meg on meg.mEGId=x.mEGId
                                                join e_p_presupuesto pre on pre.mEGId=meg.mEGId
                                                where pre.pEst=1 and YEAR(pre.pFecCrea) = YEAR( NOW())
                                                group by pre.mEGId;');
        DB::select('CREATE TEMPORARY TABLE dato2
                                                select pp.pPDesc,m.mCod,f.fDescFinalidad,eg.eGCod as esp,sum(ifnull(p.pMonto,0.00)) as mont,meg.mEGId from e_p_meta_epecifica_gasto meg
                                                left join e_p_presupuesto  as p on p.mEGId=meg.mEGId
                                                join e_p_especifica_gasto as eg on meg.eGId=eg.eGId
                                                join e_p_meta m on meg.mId=m.mId
                                                join e_p_finalidad f on f.fId=m.fId
                                                join e_p_programa_presupuestal as pp on m.pPId=pp.pPId
                                                where p.pEst=1 and YEAR(p.pFecCrea) = YEAR( NOW())
                                                group by pp.pPDesc,m.mCod,eg.eGCod,eg.eGDesc,meg.mEGId,f.fDescFinalidad
                                                order by mCod;');

        DB::select('CREATE TEMPORARY TABLE dato3
select pPDesc,mCod,esp as eGDesc,sum(mont) AS mont,ifnull(sum(est1),0.00) as est1,ifnull(sum(est3),0.00) as est3,sum(mont)-(ifnull(sum(est1),0.00)+ifnull(sum(est3),0.00)) as saldo from dato1
                                right join dato2 on dato1.mEGId=dato2.mEGId
                                group  by pPDesc,mCod,esp
                                order by mCod');
        return DB::select('select * from dato3 ');

    }

    //REPORTE PROGRAMA
    public static function obtenerReportePrograma()
    {
        DB::select('DROP TABLE IF EXISTS  tab1;');
        DB::select('create temporary table tab1
        select  x.mEGId
        ,case  when trId=1 then sum(mont) end "t1"
        , case  when trId=2 then sum(mont) end "t2",
        case  when trId=3 then sum(mont) end "t3",
        case  when trId=4 then sum(mont) end "t4",
        case  when trId=5 then sum(mont) end "t5",
        case  when trId=6 then sum(mont) end "t6",
        case  when trId=7 then sum(mont) end "t7",
        case  when trId=8 then sum(mont) end "t8",
        case  when trId=42 then sum(mont) end "t9",
               case  when trId=43 then sum(mont) end "t10",
               case  when trId=45 then sum(mont) end "t11",
               case  when trId=46 then sum(mont) end "t12",
               case  when trId=47 then sum(mont) end "t13",
        case when trId is null then sum(mont) end "m"
        from (select pre.trId,pre.mEGId,pre.pMonto mont from e_p_presupuesto pre
        where pre.pEst=1  and YEAR(pre.pFecCrea) = YEAR( NOW())
        group by pre.trId,pre.mEGId,pre.pMonto)x
        group by x.mEGId,x.trId;');

        DB::select('DROP TABLE IF EXISTS  tab2;');
        DB::select('create temporary table tab2
        select ep.pPCod,ep.pPDesc,ep.pPId,sum(t.t1) t1,sum(t.t2) t2,sum(t.t3) t3,sum(t.t4) t4,sum(t.t5) t5,sum(t.t6) t6,sum(t.t7) t7,
               sum(t.t8) t8,sum(t.t9) t9,sum(t.t10) t10,sum(t.t11) t11,sum(t.t12) t12,sum(t.t13) t13,sum(t.m) mo,
        sum(ifnull(t.t1,0)+ifnull(t.t2,0)+ifnull(t.t3,0)+ifnull(t.t4,0)+
            ifnull(t.t5,0)+ifnull(t.t6,0)+ifnull(t.t7,0)+ifnull(t.t8,0)+ifnull(t.t9,0)+ifnull(t.t10,0)+ifnull(t.t11,0)+
            ifnull(t.t12,0)+ifnull(t.t13,0)
            +ifnull(t.m,0)) totrj from tab1 t
        join e_p_meta_epecifica_gasto me
        on me.mEGId=t.mEGId
        join e_p_meta met on met.mId=me.mId
        join e_p_programa_presupuestal ep on ep.pPId=met.pPId
        group by ep.pPCod,ep.pPDesc,ep.pPId;');

        DB::select('DROP TABLE IF EXISTS  dato1;');
        DB::select('CREATE TEMPORARY TABLE dato1
                                     select x.mEGId,sum(est1) as est1,sum(est3) as est3
                                                        from (SELECT  pe.mEGId,pe.trid,
                                                        case when pe.peEstPed=1 then sum(pe.peMonto) else 0.00 end est1,
                                                        case when pe.peEstPed=3 then sum(pe.peMonto) else 0.00
                                                        end est3
                                                        FROM e_p_pedido pe
                                                        where pe.peEst=1
                                                        group by pe.peEstPed,pe.mEGId,pe.trid)x
                                                        group by x.mEGId;');

        DB::select('DROP TABLE IF EXISTS  dato2;');
        DB::select('CREATE TEMPORARY TABLE dato2
        select ep.pPId,sum(d.est1) as est1,sum(d.est3) as est3,sum(d.est1+d.est3) tote
        from dato1 d
        join e_p_meta_epecifica_gasto me
        on me.mEGId=d.mEGId
        join e_p_meta met on met.mId=me.mId
        join e_p_programa_presupuestal ep on ep.pPId=met.pPId
        group by ep.pPCod,ep.pPDesc,ep.pPId;');

        return DB::select('select t.pPCod,t.pPDesc,ifnull(t.t1,0) t1,ifnull(t.t2,0) t2,ifnull(t.t3,0) t3,ifnull(t.t4,0) t4,
ifnull(t.t5,0) t5,ifnull(t.t6,0) t6,ifnull(t.t7,0) t7,ifnull(t.t8,0) t8,ifnull(t.t9,0) t9,ifnull(t.t10,0) t10,ifnull(t.t11,0) t11,ifnull(t.t12,0) t12,ifnull(t.t13,0) t13

       ,ifnull(t.mo,0) mo, t.totrj,
ifnull(d.est1,0) est1,ifnull(d.est3,0) est3,ifnull(d.tote,0) tote
from tab2 t
left join dato2 d on d.pPId= t.pPId');
    }

    //REPORTE POR PROGRAMA Y RESOLUCION JEFATURIAL
    public static function obtenerReporteProgramaTransferencia()
    {
        DB::select('DROP TABLE IF EXISTS  tab1;');
        DB::select('create temporary table tab1
            select  x.mEGId
         ,case  when trId=1 then sum(mont) end "t1"
        , case  when trId=2 then sum(mont) end "t2",
        case  when trId=3 then sum(mont) end "t3",
        case  when trId=4 then sum(mont) end "t4",
        case  when trId=5 then sum(mont) end "t5",
        case  when trId=6 then sum(mont) end "t6",
        case  when trId=7 then sum(mont) end "t7",
        case  when trId=8 then sum(mont) end "t8",
        case  when trId=42 then sum(mont) end "t9",
               case  when trId=43 then sum(mont) end "t10",
               case  when trId=45 then sum(mont) end "t11",
               case  when trId=46 then sum(mont) end "t12",
               case  when trId=47 then sum(mont) end "t13",
            case when trId is null then sum(mont) end "m"
            from (select pre.trId,pre.mEGId,pre.pMonto mont from e_p_presupuesto pre
            where pre.pEst=1 and YEAR(pre.pFecCrea) = YEAR( NOW())
            group by pre.trId,pre.mEGId,pre.pMonto)x
            group by x.mEGId,x.trId;');

        DB::select('DROP TABLE IF EXISTS  tab2;');
        DB::select('create temporary table tab2
            select ep.pPCod,ep.pPDesc,met.mCod,esg.eGCod,me.mEGId,sum(t.t1) t1,sum(t.t2) t2,sum(t.t3) t3,sum(t.t4) t4,sum(t.t5) t5,sum(t.t6) t6,sum(t.t7) t7,
                   sum(t.t8) t8,sum(t.t9) t9,sum(t.t10) t10,sum(t.t11) t11,sum(t.t12) t12,sum(t.t13) t13,sum(t.m) mo,
            sum(ifnull(t.t1,0)+ifnull(t.t2,0)+ifnull(t.t3,0)+ifnull(t.t4,0)+
                ifnull(t.t5,0)+ifnull(t.t6,0)+ifnull(t.t7,0)+ifnull(t.t8,0)+ifnull(t.t9,0)+ifnull(t.t10,0)+ifnull(t.t11,0)+ifnull(t.t12,0)+ifnull(t.t13,0)+ifnull(t.m,0)) totrj from tab1 t
            join e_p_meta_epecifica_gasto me
            on me.mEGId=t.mEGId
            join e_p_especifica_gasto esg
            on esg.eGId=me.eGId
            join e_p_meta met on met.mId=me.mId
            join e_p_programa_presupuestal ep on ep.pPId=met.pPId
            group by ep.pPCod,ep.pPDesc,met.mCod,esg.eGDesc,esg.eGCod,me.mEGId
            order by ep.pPCod ,met.mCod
                    ;');

        DB::select('DROP TABLE IF EXISTS  dato1;');
        DB::select('CREATE TEMPORARY TABLE dato1
                                         select pre.mEGId,sum(est1) as est1,sum(est3) as est3
                                                            from (SELECT  pe.mEGId,
                                                            case when pe.peEstPed=1 then sum(pe.peMonto) else 0.00 end est1,
                                                            case when pe.peEstPed=3 then sum(pe.peMonto) else 0.00
                                                            end est3
                                                            FROM e_p_pedido pe
                                                            where pe.peEst=1
                                                            group by pe.peEstPed,pe.mEGId)x
                                                            join e_p_meta_epecifica_gasto meg on meg.mEGId=x.mEGId
                                                            join e_p_presupuesto pre on pre.mEGId=meg.mEGId
                                                            group by pre.mEGId;');
        DB::select('DROP TABLE IF EXISTS  dato2;');
        DB::select('CREATE TEMPORARY TABLE dato2
            select me.mEGId,sum(d.est1) as est1,sum(d.est3) as est3,sum(d.est1+d.est3) tote from dato1 d
            join e_p_meta_epecifica_gasto me
            on me.mEGId=d.mEGId
            group by  me.mEGId;');

        return DB::select('select t.pPCod,t.pPDesc,t.mCod,t.eGCod,t.mEGId,ifnull(t.t1,0) t1,ifnull(t.t2,0) t2,ifnull(t.t3,0) t3,ifnull(t.t4,0) t4,
ifnull(t.t5,0) t5,ifnull(t.t6,0) t6,ifnull(t.t7,0) t7,ifnull(t.t8,0) t8,ifnull(t.t9,0) t9,ifnull(t.t10,0) t10,ifnull(t.t11,0) t11,ifnull(t.t12,0) t12,ifnull(t.t3,0) t13,ifnull(t.mo,0) mo, t.totrj,
ifnull(d.est1,0) est1,ifnull(d.est3,0) est3,ifnull(d.tote,0) tote
from tab2 t
left join dato2 d on d.mEGId= t.mEGId');
    }

    public static function getTecho($trid, $ppid)
    {


        return DB::select('select trId,pPId,sum(tpMonto) - ifnull(inc,0) as tec from
         e_p_tec_presupuestal t
         left join
        (
        SELECT pPId as pPIdx,trid as tridx,sum(pMonto) as  inc FROM e_p_presupuesto p
        join e_p_meta_epecifica_gasto es on p.mEGId=es.mEGId
        join e_p_meta m on m.mId=es.mId
        where p.trid=' . $trid . ' and m.pPId=' . $ppid . ' and p.pEst=1
        group by pPId,trid
        )x on pPIdx=t.pPId
        and x.tridx=t.trid
        where trid=' . $trid . ' and pPId=' . $ppid . '
        group by trId,pPId,inc');

    }
    public static function getTechoPres($trid)
    {


        return DB::select('select trId,tPId,pPDesc,cDescripcion,tpMonto,sum(tpMonto) - ifnull(inc,0) as tec from
         e_p_tec_presupuestal t
         left join e_p_programa_presupuestal pp on pp.pPId=t.pPId
         left join e_p_concepto c on c.cId=t.cId
         left join
        (
        SELECT pPId as pPIdx,trid as tridx,sum(pMonto) as  inc FROM e_p_presupuesto p
        join e_p_meta_epecifica_gasto es on p.mEGId=es.mEGId
        join e_p_meta m on m.mId=es.mId
        where p.trid=' . $trid . '  and p.pEst=1
        group by pPId,trid
        )x on pPIdx=t.pPId
        and x.tridx=t.trid
        where trid=' . $trid . '
        group by trId,tPId,pPDesc,cDescripcion,tpMonto,inc');

    }

    public static function ObtenerReporteTrama()
    {
        return DB::table('e_p_presupuesto as p')
            ->select('tr.trNumRj', 'pp.pPCod', 'f.fCodProducto', 'f.fCodActividad', 'mt.mCod',
                'f.fCodFinalidad', 'eg.eGCod', 'pMonto as monto',
                DB::raw('year(tr.trFecCrea) as trFecCrea'),
                DB::raw('ifnull(concat("MOD: ",nm.nNro),concat("TRA: ",tr.trNumRj)) as nNro'))
            ->join('e_p_meta_epecifica_gasto as meg', 'meg.mEGId', '=', 'p.mEGId')
            ->join('e_p_transferencia as tr', 'tr.trId', '=', 'p.trId')
            ->join('e_p_especifica_gasto as eg', 'eg.eGId', '=', 'meg.eGId')
            ->join('e_p_meta as mt', 'mt.mId', '=', 'meg.mId')
            ->join('e_p_finalidad as f', 'f.fId', '=', 'mt.fId')
            ->join('e_p_programa_presupuestal as pp', 'pp.pPId', '=', 'mt.pPId')
            ->leftjoin('e_p_modificacion_prespuestal as mp', 'mp.mPId', '=', 'p.mPId')
            ->leftjoin('e_p_nota_modificatoria as nm', 'nm.nId', '=', 'mp.nId')
            ->where(DB::raw('YEAR(p.pFecCrea)') ,'=',DB::raw('YEAR( NOW())'))
            ->where('p.pEst', '=', 1)
            ->orderBy('tr.trId', 'asc')
            ->orderBy('mt.mCod', 'asc')
            ->orderBy('eg.eGCod', 'asc')
            ->orderBy('p.pId', 'asc')
            ->orderBy('f.fCodProducto', 'asc')
            ->orderBy('f.fCodActividad', 'asc')
            ->orderBy('f.fCodFinalidad', 'asc')
            ->get();
    }
    public static function ObtenerReportePedido()
    {
        return $query = DB::table('e_p_pedido as p')
            ->select('p.peId', 'p.peCodPed', 'p.trId', 'p.peFecPre', 'us.name', 'p.peMonto', 'p.peDesc', 'p.peEstPed', 'p.peEst',
                't.tdesc', 'm.mCod', 'e.eGCod','p.peFecAcOc',
                DB::raw('case
                        when p.peEstPed=0 then "PEDIDO"
                        when p.peEstPed=1 then "CERTIFICADO"
                        when p.peEstPed=2 then "COMPROMETIDO"
                         when p.peEstPed=3 then "DEVENGADO"
                          when p.peEstPed=4 then "GIRADO"
                        end ests
                        '),DB::raw('tr.trNumRj as pre'))
            ->join('e_p_meta_epecifica_gasto  as meg', 'p.mEGId', '=', 'meg.mEGId')
            ->leftJoin('e_p_transferencia as tr', 'tr.trId', '=', 'p.trId')
            // ->join('e_p_presupuesto as pr', 'pr.mEGId', '=', 'meg.mEGId')
            ->join('e_p_meta as m', 'meg.mId', '=', 'm.mId')
            ->join('e_p_especifica_gasto as e', 'e.eGId', '=', 'meg.eGId')
            ->join('e_p_tipo as t', 't.tId', '=', 'p.tId')
            ->where(DB::raw('YEAR(p.peFecCrea)') ,'=',DB::raw('YEAR( NOW())'))
            ->join('users as us', 'us.id', '=', 'p.peUsuReg')
            //->where('p.peEst', '=', 1)
            ->orderBy('p.peFecCrea', 'DESC')->get();
    }
}
