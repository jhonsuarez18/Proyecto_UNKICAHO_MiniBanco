<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EPModificacionPrespuestal extends Model
{
    protected $table = 'e_p_modificacion_prespuestal';
    public $primaryKey = 'mPId';
    public $timestamps = false;

    public static function obtenerModificacion()
    {
        return DB::table('e_p_nota_modificatoria as m')
            ->select('m.nId','tra.trNumRj','m.nNro', 'm.nTipModifica','me.mCod', DB::raw('concat(eg.eGCod ," ", eg.eGDesc) as egdesc'),'pr.pMonto','e.descripcionEjecutora','pr.pEst')
            ->join('e_p_modificacion_prespuestal as p', 'p.nId', '=', 'm.nId')
            ->join('e_p_presupuesto as pr', 'pr.mPId', '=', 'p.mPId')
            ->join('e_p_transferencia as tra','tra.trId','=','pr.trId')
            ->join('e_p_meta_epecifica_gasto as meg', 'pr.mEGId', '=', 'meg.mEGId')
            ->join('e_p_especifica_gasto as eg', 'eg.eGId', '=', 'meg.eGId')
            ->join('e_p_meta as me', 'meg.mId', '=', 'me.mId')
            ->leftjoin('ejecutora as e', 'e.idEjecutora', '=', 'm.idEjecutora')
            ->orderby('m.nFecCrea', 'desc')->get();

    }
    public static function obtenerModificacionPres()
    {
        return DB::table('e_p_nota_modificatoria as m')
            ->select('m.nId','tra.trNumRj','m.nNro',DB::raw('(Case when (p.mTipMod=0 and pr.pEst=1) then -1*(SUM(pr.pMonto)) end) as pMonto'), 'm.nTipModifica','e.descripcionEjecutora','m.nEst')
            ->join('e_p_modificacion_prespuestal as p', 'p.nId', '=', 'm.nId')
            ->join('e_p_presupuesto as pr', 'pr.mPId', '=', 'p.mPId')
            ->join('e_p_transferencia as tra','tra.trId','=','pr.trId')
            ->join('e_p_meta_epecifica_gasto as meg', 'pr.mEGId', '=', 'meg.mEGId')
            ->join('e_p_especifica_gasto as eg', 'eg.eGId', '=', 'meg.eGId')
            ->join('e_p_meta as me', 'meg.mId', '=', 'me.mId')
            ->leftjoin('ejecutora as e', 'e.idEjecutora', '=', 'm.idEjecutora')
            ->orderby('m.nFecCrea', 'desc')
            ->groupBy(['m.nId','tra.trNumRj','m.nNro', 'p.mTipMod','pr.pEst','m.nTipModifica','e.descripcionEjecutora','m.nEst'])
            ->where('pMonto','<','0')
            ->where('pr.pEst','=','1')
            ->where(DB::raw('YEAR(m.nFecCrea)') ,'=',DB::raw('YEAR( NOW())'))
            ->get();

    }
}
