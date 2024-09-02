<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class EPFinalidad extends Model
{
    protected $table = 'e_p_finalidad';
    public $primaryKey = 'fId';
    public $timestamps = false;

     static function obtenerFinalidad(){
         return DB::table('e_p_finalidad')->select('fId',DB::raw('concat(fDescProducto,\' \',fDescActividad,\' \',fDescFinalidad) as descr'))->get();
     }
    static function obtenerFinalidadDesc($cod){
        $query = DB::table('e_p_finalidad as f')->select('f.fId', 'f.fDescActividad','f.fDescProducto','f.fDescFinalidad')
            ->Where('f.fCodActividad', '=',$cod.'.' )
            ->get();
        return $query;
    }
    static function obtenerFinalidadTermino($term){
        $query = DB::table('e_p_finalidad as f')->select('f.fId', 'f.fDescActividad','f.fDescProducto','f.fDescFinalidad')
            ->Where('f.fDescActividad', 'LIKE', "%$term%")
            ->where('f.fEst','=',1)
            ->limit(10000)
            ->get();
        return $query;
    }
}
