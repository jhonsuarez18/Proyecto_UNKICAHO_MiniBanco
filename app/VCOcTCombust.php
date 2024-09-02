<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class VCOcTCombust extends Model
{
    protected $table = 'v_c_oc_t_combust';
    public $primaryKey = 'cOTId';
    public $timestamps = false;

    public static function getSaldo($idct)
    {
        return DB::table('v_c_oc_t_combust as cot')
            ->select('cot.cOTCant',
            //DB::raw("(cot.cOTCant-sum(cb.cStock)) as sald"))
            DB::raw('case
            when cb.cMEst=1 then cot.cOTCant-sum(cb.cStock)
            end sald
            '))
            ->leftjoin('v_combustible as cb', 'cb.cOTId', '=', 'cot.cOTId')
            ->where('cot.cOTId','=',$idct)
            ->groupBy('cot.cOTId','cot.cOTCant','cb.cMEst')->get();

    }
    public static function getItemVale($idoc)
    {
        return DB::table('v_c_oc_t_combust as cot')
            ->select('cot.cOTId','tc.tCDesc','oc.oCNumFact',
            DB::raw("CONCAT(g.gRuc,'-',g.gDesc) as grif"))
            ->join('v_combustible as cb', 'cb.cOTId', '=', 'cot.cOTId')
            ->join('v_orden_compra as oc', 'oc.oCId', '=', 'cot.oCId')
            ->join('v_grifo as g', 'g.gId', '=', 'oc.gId')
            ->join('v_tipo_combustible as tc', 'tc.tCId', '=', 'cot.tCId')
            ->where('oc.oCId','=',$idoc)
            ->groupBy('cot.cOTId','tc.tCDesc','oc.oCNumFact','g.gRuc','g.gDesc')->get();

    }
}
