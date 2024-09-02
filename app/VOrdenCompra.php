<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class VOrdenCompra extends Model
{
    protected $table = 'v_orden_compra';
    public $primaryKey = 'oCId';
    public $timestamps = false;
    public static function getOrdenCompras()
    {
        return DB::table('v_orden_compra as oc')
            ->select('oc.oCId','ff.fFdesc','oc.oNumOC','oc.oCEst','us.name as uname',
                'oc.oCNumFact','g.gDesc',
                DB::raw("DATE_FORMAT(oc.oCFecCrea,'%d-%m-%Y') AS oCFecCrea"))
            ->join('e_p_fuente_financiamiento as ff', 'ff.fFId', '=', 'oc.fFId')
            ->join('v_grifo as g', 'g.gId', '=', 'oc.gId')
            ->join('users as us', 'us.id', '=', 'oc.oCUsuReg')
            ->orderby('oc.oCFecCrea', 'desc')->get();

    }
    public static function getOrdCComb()
    {
        return DB::table('v_c_oc_t_combust as cot')
            ->select('oc.oCId','oc.oNumOC')
            ->join('v_combustible as cb', 'cb.cOTId', '=', 'cot.cOTId')
            ->join('v_orden_compra as oc', 'oc.oCId', '=', 'cot.oCId')
            ->groupBy('oc.oCId','oc.oNumOC')->get();

    }
}
