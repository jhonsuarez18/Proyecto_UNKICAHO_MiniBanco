<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EPTecPresupuestal extends Model
{
    protected $table = 'e_p_tec_presupuestal';
    public $primaryKey = 'tpId';
    public $timestamps = false;

    public static function tecpres($trid)
    {
        return $result = DB::select(' select pPDesc,sum(c5) as c5,sum(c6) as c6,sum(c7) as c7,sum(c8) as c8,sum(c5+c6+c7+c8) as tot from(SELECT pp.pPDesc,
            case when cId=5 then sum(tpMonto) else 0 end "c5",
            case when cId=6 then sum(tpMonto) else 0 end "c6",
            case when cId=7 then sum(tpMonto) else 0 end "c7",
             case when cId=8 then sum(tpMonto) else 0 end "c8"
            FROM e_p_tec_presupuestal tp
            join e_p_programa_presupuestal pp on pp.pPId=tp.pPId
            where trId=' . $trid . ' and tp.cEstado=1 and pp.pPEst=1
            group by pp.pPDesc,cId)x
            group by pPDesc');


    }

    public static function gettecedit($trid)
    {
       return $result = DB::table('e_p_tec_presupuestal as t')->select('t.tPId','t.trId','t.tpMonto','pp.pPDesc','c.cDescripcion')
            ->join('e_p_programa_presupuestal as pp', 'pp.pPId', '=', 't.PPId')
            ->join('e_p_concepto as c', 'c.cId', '=', 't.cId')
            ->where(['t.cEstado'=>1,'pp.pPEst'=>1,'c.cEstado'=>1,'t.trId'=>$trid])
           ->orderBy('pp.pPDesc','asc')
            ->get();
    }
    public static function gettecpres($trid)
    {
        return $result = DB::table('e_p_tec_presupuestal as t')->select('t.tPId','t.trId','t.tpMonto','pp.pPDesc','c.cDescripcion')
            ->join('e_p_programa_presupuestal as pp', 'pp.pPId', '=', 't.PPId')
            ->join('e_p_concepto as c', 'c.cId', '=', 't.cId')
            ->where(['t.cEstado'=>1,'pp.pPEst'=>1,'c.cEstado'=>1,'t.trId'=>$trid])
            ->orderBy('pp.pPDesc','asc')
            ->get();
    }
}
