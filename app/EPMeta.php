<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EPMeta extends Model
{
    protected $table = 'e_p_meta';
    public $primaryKey = 'mId';
    public $timestamps = false;

    public function especificaMeta()
    {
        return $this->hasMany('App\EPMetaEpecificaGasto');
    }

    static function obtenerMetaId($idm)
    {
        return DB::table('e_p_meta as m')
            ->join('e_p_programa_presupuestal as pp', 'pp.pPId', '=', 'm.pPId')
            ->join('e_p_finalidad as f', 'f.fId', '=', 'm.fId')
            ->where('m.mId', '=', $idm)
            ->select('*')->get();
    }
    static function getMetasTransf($idtr)
    {
        return DB::table('e_p_meta as m')
            ->select('m.mId','m.mCod')
            ->join('e_p_programa_presupuestal as pp', 'pp.pPId', '=', 'm.pPId')
            ->join('e_p_tec_presupuestal as tp', 'tp.pPId', '=', 'pp.pPId')
            ->where('tp.trId', '=', $idtr)->get();
;
    }
    static function obtenerMetaidTrans($idtra)
    {
        return DB::table('e_p_presupuesto as pr')
            ->select('m.mId', 'm.mCod')
            ->join('e_p_meta_epecifica_gasto as eg', 'pr.mEGId', '=', 'eg.mEGId')
            ->join('e_p_meta as m', 'm.mId', '=', 'eg.mId')
            ->where(['pr.trId' => $idtra, 'pr.pEst' => 1, 'eg.mEGEst' => 1, 'm.mEst' => 1,])
            ->groupBy('m.mId', 'm.mCod')
            ->orderBy('m.mCod', 'asc')
            ->get();
    }

    public static function obtenerMetaEspecifica()
    {


        return DB::table('e_p_meta_epecifica_gasto as  me')
            ->select('p.pPDesc', 'm.mCod', 'me.mId', DB::raw('group_concat(distinct(concat(\' | \',es.eGCod,es.eGDesc))) as esp'),
                'f.fDescFinalidad', 'f.fDescActividad', 'f.fDescProducto', 'm.mEst')
            ->join('e_p_especifica_gasto as es', 'es.eGId', '=', 'me.eGId')
            ->join('e_p_meta  as m', 'me.mId', '=', 'm.mId')
            ->join('e_p_finalidad as f', 'f.fId', '=', 'm.fId')
            ->join('e_p_programa_presupuestal as p', 'p.pPId', '=', 'm.pPId')
            ->groupBy(['p.pPDesc', 'm.mCod', 'me.mId', 'f.fDescFinalidad', 'f.fDescActividad', 'f.fDescProducto','m.mEst'])
            ->orderBy('m.mCod', 'asc')->get();
    }

    public static function obtemerMetadEspecificaEditar($idmeta)
    {
        return DB::table('e_p_meta_epecifica_gasto as  me')
            ->select('p.pPId', 'p.pPDesc', 'm.mCod', 'me.mId', 'f.fId',
                'f.fDescFinalidad', 'f.fDescActividad', 'f.fDescProducto', 'm.mEst')
            ->join('e_p_especifica_gasto as es', 'es.eGId', '=', 'me.eGId')
            ->join('e_p_meta  as m', 'me.mId', '=', 'm.mId')
            ->join('e_p_finalidad as f', 'f.fId', '=', 'm.fId')
            ->join('e_p_programa_presupuestal as p', 'p.pPId', '=', 'm.pPId')
            ->where('me.mId', $idmeta)
            ->groupBy(['p.pPId','p.pPDesc', 'm.mCod','f.fId' ,'me.mId', 'f.fDescFinalidad', 'f.fDescActividad', 'f.fDescProducto', 'm.mEst'])
            ->orderBy('m.mCod', 'asc')->first();
    }
}
