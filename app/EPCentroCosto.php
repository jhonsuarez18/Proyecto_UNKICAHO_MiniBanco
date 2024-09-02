<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EPCentroCosto extends Model
{
    protected $table = 'e_p_centro_costo';
    public $primaryKey = 'cCId';
    public $timestamps = false;

    public static function getAllyear()
    {
        return DB::table('e_p_centro_costo')->select('*')
            ->where(['cCAnoEje' => DB::raw('year(now())'), 'cCEst' => 1])
            ->get();
    }

    public static function getCentroCosto($term)
    {
        $query = DB::table('e_p_centro_costo as cc')->select('cc.cCId', DB::raw('concat(cCCentroCosto,"| ",cc.cCNombre) as cCNombre'))
            ->where(['cc.cCAnoEje' => DB::raw('year(now())'), 'cCEst' => 1])
            ->Where(DB::raw('concat(cCCentroCosto,"| ",cc.cCNombre) '), 'LIKE', "%$term%")
            ->limit(10000)
            ->get();
        return $query;
    }


    public static function centroCosto($idPed)
    {
        return DB::table('e_p_pedido as pe')->select('*','pe.cCId as idc')
            ->join('e_p_centro_costo as cc', 'pe.cCId', '=', 'cc.cCId')
            ->where('pe.peId','=',$idPed)
            ->first();
    }


}
