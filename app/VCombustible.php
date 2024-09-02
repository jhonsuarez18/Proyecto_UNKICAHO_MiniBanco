<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class VCombustible extends Model
{
    protected $table = 'v_combustible';
    public $primaryKey = 'cMId';
    public $timestamps = false;

    public static function getMetaEGComb()
    {
        return DB::table('e_p_meta_epecifica_gasto as meg')
            ->select('meg.mEGId','meg.eGId','meg.mId','mt.mCod')
            ->join('e_p_meta as mt', 'mt.mId', '=', 'meg.mId')
            ->join('e_p_especifica_gasto as eg', 'eg.eGId', '=', 'meg.eGId')
            ->where('eg.eGCod','=','2.3.1.3.1.1')
            ->orderby('mt.mId', 'asc')->get();

    }
    public static function getCombustibles()
    {
        $res=  DB::table('v_consumo')->SELECT('cMId',DB::raw('sum(cCantGal) as cons') )
            ->groupBy(['cMId']);

        return DB::table('v_combustible as cb')
            ->select('cb.cMId','oc.oNumOC','cb.cStock','cot.cOTCant','mt.mCod','tc.tCDesc','cb.cMEst',
                DB::raw("concat(pp.pPCod,'-',pp.pPDesc) AS progp"),DB::raw('ifnull(res1.cons,0.00) as cons'))
            ->join('v_c_oc_t_combust as cot', 'cot.cOTId', '=', 'cb.cOTId')
            ->leftJoinSub($res, 'res1', function ($join) {
                $join->on('res1.cMId', '=', 'cb.cMId');
            })
            ->join('v_orden_compra as oc', 'oc.oCId', '=', 'cot.oCId')
            ->join('e_p_meta_epecifica_gasto as meg', 'meg.mEGId', '=', 'cb.mEGId')
            ->join('e_p_especifica_gasto as eg', 'eg.eGId', '=', 'meg.eGId')
            ->join('e_p_meta as mt', 'mt.mId', '=', 'meg.mId')
            ->join('e_p_programa_presupuestal as pp', 'pp.pPId', '=', 'mt.pPId')
            ->join('v_tipo_combustible as tc', 'tc.tCId', '=', 'cot.tCId')
            ->orderby('cb.cMFecCrea', 'desc')->get();

    }
    public static function getCombusEdit($idc)
    {
        return DB::table('v_combustible as cb')
            ->select('cb.cMId','oc.oCId','cot.cOTId','cb.cStock','meg.mEGId','cb.cMEst')
            ->join('v_c_oc_t_combust as cot', 'cot.cOTId', '=', 'cb.cOTId')
            ->join('v_orden_compra as oc', 'oc.oCId', '=', 'cot.oCId')
            ->join('e_p_meta_epecifica_gasto as meg', 'meg.mEGId', '=', 'cb.mEGId')
            ->orderby('cb.cMFecCrea', 'desc')
            ->where('cb.cMId','=',$idc)->get();

    }
    public static function getSaldoCom($idc)
    {
        return DB::table('v_combustible as cb')
            ->select('cb.cMId','pp.pPDesc','cb.cStock','meg.mEGId','cb.cMEst')
            ->join('e_p_meta_epecifica_gasto as meg', 'meg.mEGId', '=', 'cb.mEGId')
            ->join('e_p_meta as mt', 'mt.mId', '=', 'meg.mId')
            ->join('e_p_programa_presupuestal as pp', 'pp.pPId', '=', 'mt.pPId')
            ->where('cb.cMId','=',$idc)->get();

    }
    public static function getSaldo($idc)
    {
        return DB::table('v_combustible as cb')
            ->select('cb.cStock','pp.pPDesc','cb.cMId',
                DB::raw('case
            when cs.cEst=1 then cb.cStock-sum(cs.cCantGal)
            end sald
            '))
            ->leftjoin('v_consumo as cs', 'cs.cMId', '=', 'cb.cMId')
            ->join('e_p_meta_epecifica_gasto as meg', 'meg.mEGId', '=', 'cb.mEGId')
            ->join('e_p_meta as mt', 'mt.mId', '=', 'meg.mId')
            ->join('e_p_programa_presupuestal as pp', 'pp.pPId', '=', 'mt.pPId')
            ->where('cb.cMId','=',$idc)
            ->groupBy('cb.cMId','cb.cStock','pp.pPDesc','cb.cMId','cs.cEst')->get();

    }
}
