<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ALEncargado extends Model
{
    protected $table = 'a_l_encargado';
    public $primaryKey = 'enId';
    public $timestamps = false;

    public function local()
    {
        return $this->hasOne('App\ALLocal', 'lId');
    }

    public function usuario(){
        return $this->hasOne('App\User', 'idUsuario');
    }


    public static function getLocal(){
       /* DB::table('')
        ->select('*')
        where()*/

    }
    static function obtenerEjecTermino($term){
        $query = DB::table('ejecutora as e')
            ->select('e.idEjecutora','e.codigoEjecutora','e.descripcionEjecutora as ejecutora','e.estadoEjecutora')
            ->Where('e.descripcionEjecutora', 'LIKE', "%$term%")
            ->where('e.estadoEjecutora','=',1)
            ->limit(10000)
            ->get();
        return $query;
    }
    public static function getEncargados()
    {
        return DB::table('a_l_encargado as en')
            ->select('en.enId','en.idUsuario','l.lNombre','e.codigoEjecutora','e.descripcionEjecutora as ejecutora','p.numeroDoc as dni',DB::raw('concat(p.apPaterno," ",p.apMaterno,", ",p.pNombre," ",ifnull(p.sNombre,"")) as nombre'),'u.name as user','en.enEst')
            ->join('a_l_local as l', 'en.lId', '=', 'l.lId')
            ->join('users as u', 'en.idUsuario', '=', 'u.id')
            ->join('ejecutora as e', 'l.idEjecutora', '=', 'e.idEjecutora')
            ->join('persona as p', 'u.id', '=', 'p.idUser')
            ->get();
    }
}
