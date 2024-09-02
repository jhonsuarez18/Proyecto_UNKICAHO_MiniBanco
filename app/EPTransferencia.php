<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EPTransferencia extends Model
{
    protected $table = 'e_p_transferencia';
    public $primaryKey = 'trId';
    public $timestamps = false;

    static function obtenerTransferenciaId($id){
        return DB::table('e_p_transferencia as t')
            ->join('e_p_fuente_financiamiento as ff','ff.fFId','=','t.fFId')
            ->where('t.trId','=',$id)
            ->where('t.trEst','=',1)
            ->where('ff.fFEst','=',1)
            ->where(DB::raw('YEAR(t.trFecCrea)') ,'=',DB::raw('YEAR( NOW())'))
            ->get();
    }

    static function obtenerTransferenciasReporte(){
        return DB::table('e_p_transferencia as t')
            ->join('e_p_fuente_financiamiento as ff','ff.fFId','=','t.fFId')
            ->where(DB::raw('YEAR(t.trFecCrea)') ,'=',DB::raw('YEAR( NOW())'))
            ->get();
    }
}
