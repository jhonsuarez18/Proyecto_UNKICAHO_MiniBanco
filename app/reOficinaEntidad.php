<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class reOficinaEntidad extends Model
{
    protected $table = 're_oficina_entidad';
    public $primaryKey = 'oEId';
    public $timestamps = false;

    static function getOficEnt($term,$id){
        switch ($id){
            case 4:
                $query = DB::table('re_oficina_entidad as oe')
                    ->select('oe.oEId', 'r.idDisaSis as codest','r.Descripcion as estable','oe.oEEst')
                    ->join('red as r', 'r.idRed', '=', 'oe.idRed')
                    ->Where('r.Descripcion', 'LIKE', "%$term%")
                    ->where('oe.oEEst','=',1)
                    ->where('oe.oId','=',$id)
                    ->limit(10000)
                    ->get();
                break;
            case 5:
                $query = DB::table('re_oficina_entidad as oe')
                    ->select('oe.oEId', 'ud.codigoUdr as codest','ud.nombre as estable','oe.oEEst')
                    ->join('udr as ud', 'ud.idUdr', '=', 'oe.idUdr')
                    ->Where('ud.nombre', 'LIKE', "%$term%")
                    ->where('oe.oEEst','=',1)
                    ->where('oe.oId','=',$id)
                    ->limit(10000)
                    ->get();
                break;
            case 6:
                $query = DB::table('re_oficina_entidad as oe')
                    ->select('oe.oEId', 'e.codigoRenaes as codest','e.descripcion as estable','oe.oEEst')
                    ->join('eess as e', 'e.idEess', '=', 'oe.idEess')
                    ->Where('e.descripcion', 'LIKE', "%$term%")
                    ->where('oe.oEEst','=',1)
                    ->where('oe.oId','=',$id)
                    ->limit(10000)
                    ->get();
                break;
            case 7:
                $query = DB::table('re_oficina_entidad as oe')
                    ->select('oe.oEId', 'e.codigoEjecutora as codest','e.descripcionEjecutora as estable','oe.oEEst')
                    ->join('ejecutora as e', 'e.idEjecutora', '=', 'oe.idEjecutora')
                    ->Where('e.descripcionEjecutora', 'LIKE', "%$term%")
                    ->where('oe.oEEst','=',1)
                    ->where('oe.oId','=',$id)
                    ->limit(10000)
                    ->get();
                break;
            case 8:
                $query = DB::table('re_oficina_entidad as oe')
                    ->select('oe.oEId', 'ent.eId as codest','ent.eDesc as estable','oe.oEEst')
                    ->join('re_entidad as ent', 'ent.eId', '=', 'oe.eId')
                    ->Where('ent.eDesc', 'LIKE', "%$term%")
                    ->where('ent.eEst','=',1)
                    ->where('oe.oId','=',$id)
                    ->limit(10000)
                    ->get();
                break;

        }
        /* if($id==6){

         }*/

        return $query;
    }
}
