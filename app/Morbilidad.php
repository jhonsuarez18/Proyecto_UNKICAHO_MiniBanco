<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Morbilidad extends Model
{
    protected $table = 'morbilidad';
    public $primaryKey = 'idMorbilidad';
    public $timestamps = false;

    static function obtenerMorbilidad($term)
    {
        $query = DB::table('morbilidad as m')->select('m.idMorbilidad', 'm.descripcion')
            ->Where('m.descripcion', 'LIKE', "%$term%")
            ->Where('estado', '=', 1)
            ->limit(10000)
            ->get();
        return $query;
    }

    static function obtenerMorbilidadId($desc)
    {
        $idmorbil = null;
        $query = DB::table('morbilidad as m')->select('m.idMorbilidad')
            ->Where('m.descripcion', '=', $desc)
            ->first();
        if (empty($query->idMorbilidad))
            return $idmorbil;
        else
            return $query->idMorbilidad;
    }

    public static function obtenerMorbilidadLsita($idPaciente)
    {

        $query = DB::table('morbilidadpacientecovid as pc')
            ->select('pc.idMorbilidadpacientecovid', 'pc.idMorbilidad', 'pc.idPacienteCovid', 'm.descripcion')
            ->join('morbilidad  as m', 'm.idMorbilidad', '=', 'pc.idMorbilidad')
            ->Where('pc.idPacienteCovid', '=', $idPaciente)
            ->Where('pc.estado', '=', 1)
            ->get();
        return $query;
    }

    public static function obtenerMorbilidadIDpacienteMorbilidad($idPaciente, $decmorb)
    {

        $query = DB::table('pacientecovid as pc')
            ->select('mp.idMorbilidadpacientecovid')
            ->join('morbilidadpacientecovid as mp', 'mp.idPacienteCovid', '=', 'pc.idPacienteCovid')
            ->join('morbilidad as m', 'm.idMorbilidad', '=', 'mp.idMorbilidad')
            ->Where('pc.idPacienteCovid', '=', $idPaciente)
            ->Where('m.descripcion', 'like', $decmorb)
            ->first();
        return $query;

    }
}
