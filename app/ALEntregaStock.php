<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ALEntregaStock extends Model
{
    protected $table = 'a_l_entrega_stock';
    public $primaryKey = 'esId';
    public $timestamps = false;

    public static function cambiarEstado($id, $val)
    {
        DB::table('a_l_entrega_stock as es')
            ->where('es.eId', $id)
            ->update(['es.esEst' => $val]);
    }

    public function getStockMaterial($eId){
       return DB::table('a_l_entrega_stock as es')
            ->select('*')
            ->join('a_l_stock as s','es.sId','=','s.sId')
           ->join('a_l_material as m','s.mId','=','m.mId')
            ->where('es.eId','=',$eId)->get();
    }

}
