<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UbicacionModel extends Model
{

    public static function obtenerProvincia($departamento)
    {
        $query = DB::table('provincia as p')->select('p.idProvincia', 'p.codigo',
            'p.descripcion')
            ->where('idDepartamento', '=', $departamento)
            ->get();
        return $query;
    }

    public static function obtenerDistrito($idProv)
    {
        $query = DB::table('distrito as d')->select('d.dtId', 'd.descripcion')
            ->where('idProvincia', '=', $idProv)
            ->get();
        return $query;
    }

    public static function obtenerEstablecimiento($idDist)
    {
        $query = DB::table('eess as e')->select('e.idEess', 'e.descripcion', 'e.idDistrito')
            ->where('idDistrito', '=', $idDist)
            ->get();
        return $query;
    }

    public static function obtenerCentroPoblado($term)
    {
        $query = DB::table('centropoblado as c')->select('idCentroPoblado','c.Descripcion')
            ->Where('c.Descripcion', 'LIKE', "%$term%")
            ->Where('estado', '=', 1)
            ->limit(10000)
            ->get();
        return $query;
    }
    public static function getEstablecimientoFull($term)
    {
        $query = DB::table('eess as e')
            ->select('e.idEess', DB::raw('concat(CAST(e.codigoRenaes AS UNSIGNED)," - ",e.Descripcion," - ",descripcionEjecutora) as Descripcion'))
            ->join('ejecutora as ej','ej.idEjecutora','=','e.idEjecutora')
            ->Where(DB::raw('concat(CAST(e.codigoRenaes AS UNSIGNED)," ",e.descripcion," ",descripcionEjecutora)'), 'LIKE', "%$term%")
            ->Where(['e.estado'=> 1,'ej.estadoEjecutora'=> 1])
            ->limit(10000)
            ->get();
        return $query;
    }

    public static function jobtenerCentroPobladoNombre($name)
    {
        $query = DB::table('centropoblado as c')->select('c.idCentroPoblado')
            ->Where('c.Descripcion', '=', $name)
            ->first();
        return $query;
    }

    public static function obtenerDepartamento()
    {
        $query = DB::table('departamento as d')->select('d.idDepartamento', 'd.descripcion')
            ->get();
        return $query;
    }

    public static function obtenerUbicacion($iddis)
    {
        $query = DB::table('distrito as dis')
            ->select('dis.idDistrito as disidDistrito', 'dis.descripcion as disdescripcion', 'pro.idProvincia as proidProvincia', 'pro.descripcion as prodescripcion'
                , 'dep.idDepartamento as depidDepartamento', 'dep.descripcion as depdescripcion')
            ->join('provincia as pro', 'pro.idProvincia', '=', 'dis.idProvincia')
            ->join('departamento as dep', 'dep.idDepartamento', '=', 'pro.idDepartamento')
            ->where('dis.idDistrito', '=', $iddis)->first();
        return $query;
    }

    public static function obtenerEjecutora()
    {
        $query = DB::table('ejecutora as e')
            ->select('*')
            ->whereIn('codigoEjecutora', array('1664', '0725', '0955', '0998', '1101', '1350'))
            ->orderBy('codigoEjecutora', 'asc')->get();
        return $query;
    }

}
