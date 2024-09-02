<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ALStock extends Model
{
    protected $table = 'a_l_stock';
    public $primaryKey = 'sId';
    public $timestamps = false;

    public function getStockLoc($al)
    {

        return DB::table('a_l_stock as s')->select('*', DB::raw('DATE(i.iFecCrea) as ifec'), 's.sId as idstock')
            ->join('a_l_material as m', 'm.mId', '=', 's.mId')
            ->join('a_l_ingreso as i', 'i.iId', '=', 's.iId')
            ->join('a_l_tip_mat as tm', 'tm.tmId', '=', 'm.tmId')
            ->leftJoin('a_l_rotacion_stock as rs', 'rs.sId', '=', 's.sId')
            ->where(['m.mEst' => 1, 'i.iEst' => 1, 'i.lId' => $al])
            ->orderBy('m.mMedNom', 'asc')
            ->get();


    }

    public function getStockEdit($sId)
    {

        return DB::table('a_l_stock as s')->select('*', DB::raw('DATE(i.iFecCrea) as ifec'), 's.sId as idstock')
            ->join('a_l_material as m', 'm.mId', '=', 's.mId')
            ->join('a_l_ingreso as i', 'i.iId', '=', 's.iId')
            ->join('a_l_tip_mat as tm', 'tm.tmId', '=', 'm.tmId')
            ->leftJoin('a_l_rotacion_stock as rs', 'rs.sId', '=', 's.sId')
            ->where('s.sId', $sId)
            ->orderBy('m.mMedNom', 'asc')
            ->get();


    }

    public function obtenerStockAlmacenAcumulado($idloc)
    {
        DB::select('DROP TABLE IF EXISTS  tab1;');
        DB::select('create temporary table tab1
            select sId,sum(rsCantUni) as cant from a_l_rotacion_stock
            where  rsEst=1 or rsEst=2
            group by sId;');
        DB::select('DROP TABLE IF EXISTS  tab2;');
        DB::select('create temporary table tab2
        select e.sId,sum(e.esCantUni) as cant from a_l_entrega_stock e
        where e.esEst=1
        group by e.sId;');
        DB::select('DROP TABLE IF EXISTS  tab3;');
        DB::select('create temporary table tab3
            select s.sEstEnt,s.sEst,s.sFecCrea,ma.tmDesc,s.sId,m.mCodMed,concat(m.mMedNom," ",m.mMedCnc," ",m.mMedPres) as mMedNom,m.mFecCrea,s.sCantUni
             from a_l_stock as s
             join a_l_material as m on  m.mId =s.mId
            join a_l_tip_mat as ma on  ma.tmId =m.tmId
             join a_l_ingreso as i on i.iId = s.iId
             where i.lId = ' . $idloc);

        DB::select('DROP TABLE IF EXISTS  tab4;');
        DB::select('create temporary table tab4
        select t3.sEstEnt,t3.sEst,t3.sFecCrea,t3.tmDesc,t3.sId,t3.mCodMed,t3.mMedNom,t3.mFecCrea,sum(ifnull(t3.sCantUni,0)-ifnull(t1.cant,0)-ifnull(t2.cant,0)) as stock from tab3 t3
        left join tab1 t1 on t1.sId=t3.sid
        left join tab2 t2 on t2.sId=t3.sId
        group by  t3.sEstEnt,t3.sEst,t3.sFecCrea,t3.tmDesc,t3.sId,t3.mCodMed,t3.mMedNom,t3.mFecCrea
        ');

        return DB::select('select tmDesc,sEstEnt,sEst,sId,mCodMed,mMedNom,Date(mFecCrea) as mFecCrea,Date(sFecCrea) as sFecCrea ,
	        stock
            from tab4
            where stock>0
            order by mMedNom asc;');


    }

    public function getItmsMovimiento($rId)
    {
        return DB::table('a_l_rotacion_stock as rs')
            ->select('rs.rsId', 'm.mMedNom as med', 'tm.tmDesc', DB::raw('date(r.rFecCrea) as rFecCrea'), 'rs.rsCantUni as cant', 'rs.rsEst')
            ->join('a_l_rotacion as r', 'r.rId', '=', 'rs.rId')
            ->join('a_l_stock  as s', 's.sId', '=', 'rs.sId')
            ->join('a_l_material as m', 'm.mId', '=', 's.mId')
            ->join('a_l_tip_mat as tm', 'tm.tmId', '=', 'm.tmId')
            ->where(['rs.rsEst' => 1, 'r.rEst' => 1,
                's.sEst' => 1, 'm.mEst' => 1, 'r.rId' => $rId])
            ->orderBy('r.rFecCrea', 'asc')
            ->get();

    }

    public function getMovimiento($idloc)
    {
        return DB::table('a_l_rotacion as r')
            ->Select('descripcionEjecutora', 'l.lNombre', 'r.rMotivo', DB::raw('date(r.rFecCrea) as rFecCrea'), DB::raw('count(rs.rId) as cant'), 'r.rId')
            ->join('a_l_rotacion_stock as rs', 'rs.rId', '=', 'r.rId')
            ->join('a_l_stock as s', 's.sId', '=', 'rs.sId')
            ->join('a_l_ingreso as i', 'i.iId', '=', 's.iId')
            ->join('a_l_local as l', 'l.lId', '=', 'i.lId')
            ->join('ejecutora as e', 'e.idEjecutora', '=', 'l.idEjecutora')
            ->where(['rs.rsEst' => 1, 'r.lId' => $idloc])
            ->groupBy('descripcionEjecutora', 'r.rFecCrea', 'l.lNombre', 'r.rId', 'r.rMotivo')->get();
    }


    public static function getReporteTotal()
    {

        DB::select('DROP TABLE IF EXISTS  tab1;');
        DB::select('create temporary table tab1
            select sId,sum(rsCantUni) as cant from a_l_rotacion_stock
            where  rsEst in (2,1)
            group by sId;');

        DB::select('  DROP TABLE IF EXISTS  tab2;');
        DB::select('create temporary table tab2
        select e.sId,sum(e.esCantUni) as cant from a_l_entrega_stock e
        where e.esEst=1
        group by e.sId;
        ');
        DB::select('  DROP TABLE IF EXISTS  tab4;');
        DB::select('create temporary table tab4
        select s.mid,s.iId,s.sId,s.sCantUni,sum(ifnull(s.sCantUni,0)-ifnull(t1.cant,0)-ifnull(t2.cant,0)) as stock
		from a_l_stock s
        left join tab1 t1 on t1.sId=s.sid
        left join tab2 t2 on t2.sId=s.sId
        group by  s.mid,s.sId,s.iId,s.sCantUni;');
        DB::select('DROP TABLE IF EXISTS  tab5;');
        DB::select('create temporary table tab5
        select concat(m.mMedNom," ",m.mMedCnc," ",m.mMedPres) as mMedNom,sum(s.stock) tot,e.codigoEjecutora from tab4 s
        join a_l_material m on m.mId=s.mId
        join a_l_ingreso i on i.iId=s.iId
        join a_l_local l on l.lId=i.lId
        join ejecutora e on e.idEjecutora=l.idEjecutora
        where s.stock>0
        group by m.mMedNom,e.codigoEjecutora,m.mMedCnc,m.mMedPres;');

        DB::select(' DROP TABLE IF EXISTS  tab6;');
        DB::select('create temporary table tab6
         select mMedNom,
         case when codigoEjecutora="0725" then sum(tot) else 0 end "cha",
         case when codigoEjecutora="1664" then sum(tot) else 0 end "con",
         case when codigoEjecutora="0955" then sum(tot) else 0 end "bag",
         case when codigoEjecutora="0998" then sum(tot) else 0 end "hoc",
         case when codigoEjecutora="1101" then sum(tot) else 0 end "hob",
         case when codigoEjecutora="1350" then sum(tot) else 0 end "uct"
         from  tab5
         group by mMedNom,codigoEjecutora;');

        return DB::select('
          select mMedNom,sum(cha) as cha,sum(con) as con,sum(bag) as bag,sum(uct) as uct,sum(hob) as hob,sum(hoc) as hoc,sum(cha)+sum(con)+sum(bag) +sum(uct)+sum(hob) +sum(hoc) as tot from tab6
 group by mMedNom');


    }


    public static function getGraficoMesvsMedicEje($mes, $idmed)
    {


        DB::select('DROP TABLE IF EXISTS  dato1;');
        DB::select('CREATE TEMPORARY TABLE dato1
            SELECT e.codigoEjecutora,SUM(es.esCantUni) as canten FROM
            a_l_entrega_stock as es
            join a_l_stock as s on es.sId=s.sId
            join a_l_ingreso as i on i.iId=s.iId
            join a_l_local as l on l.lId=i.lId
            join ejecutora as e on e.idEjecutora=l.idEjecutora
            where mId='.$idmed.' and month(s.sFecCrea)<='.$mes.'
            group by e.codigoEjecutora, s.mId;');
        DB::select('DROP TABLE IF EXISTS  dato2;');
        DB::select('
            CREATE TEMPORARY TABLE dato2
            SELECT e.codigoEjecutora,SUM(rs.rsCantUni) as cantro FROM a_l_rotacion_stock rs
            join a_l_stock s on rs.sId=s.sId
            join a_l_ingreso i on i.iId=s.iId
            join a_l_local l on l.lId=i.lId
            join ejecutora e on e.idEjecutora=l.idEjecutora
             where mId='.$idmed.' and month(s.sFecCrea)<='.$mes.'
            group by e.codigoEjecutora, s.mId;');
        DB::select('DROP TABLE IF EXISTS  dato3;');
        DB::select('
            CREATE TEMPORARY TABLE dato3

            SELECT e.codigoEjecutora,SUM(sCantUni) as stacu FROM a_l_stock s
            join a_l_ingreso i on i.iId=s.iId
            join a_l_local l on l.lId=i.lId
            join ejecutora e on e.idEjecutora=l.idEjecutora
              where mId='.$idmed.' and month(s.sFecCrea)<='.$mes.'
            group by e.codigoEjecutora, s.mId;');
        return DB::select('
            select e.codigoEjecutora,sum(ifnull(x.stacu,0)) as stacu,sum(ifnull(x.cantro,0)) as cantro,sum(ifnull(x.canten,0)) as canten from a_l_local l
            join ejecutora e on e.idEjecutora= l.idEjecutora
            left join (select d3.codigoEjecutora,d3.stacu,d2.cantro,d1.canten from dato3 d3
            left join dato1 d1 on d3.codigoEjecutora=d1.codigoEjecutora
            left join dato2 d2 on d3.codigoEjecutora=d2.codigoEjecutora)x on x.codigoEjecutora=e.codigoEjecutora
            group by e.codigoEjecutora');

    }


}


