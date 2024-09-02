<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class establecimientooficina extends Model
{
    protected $table = 'esstablecimientooficina';
    public $primaryKey = 'esstablecimientooficina';
    public $timestamps = false;

    public static function obtenerOficinas(){
        $query = DB::table('oficina as ofi')
            ->select('esof.idEsstaboficina as idofi','ofi.descripcion as ofi')
            ->join('esstablecimientooficina as esof', 'esof.idOficina', '=', 'ofi.idOficina')
            ->join('eess as es', 'es.idEess', '=', 'esof.idEess')
            ->where('esof.idEess', '=', 8609)
            ->get();
        return $query;
    }
}
