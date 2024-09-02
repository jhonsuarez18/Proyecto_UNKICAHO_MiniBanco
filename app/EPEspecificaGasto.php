<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EPEspecificaGasto extends Model
{
    protected $table = 'e_p_especifica_gasto';
    public $primaryKey = 'eGId';
    public $timestamps = false;

     static function obtenerEspecificasMeta($idmeta){
        return  DB::table('e_p_meta_epecifica_gasto as me')
            ->join('e_p_especifica_gasto as e','e.eGId','=','me.eGId')
            ->select('*')
            ->where('me.mId','=',$idmeta)
            ->where('me.mEGEst','=',1)->get();
    }
}
