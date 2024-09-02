<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class permiso extends Model
{
    protected $table = 'permiso';
    public $primaryKey = 'idPermiso';
    public $timestamps = false;

    public static function obtenerPermisos($idusu)
    {
        $query = DB::select('select p.idPermiso as idpermiso, m.titulo as mtitulo,
                m.descripcion as mdescripcion, s.idSubMenu as sidSubMenu, s.subTitulo as ssubTitulo,
                p.estado as perm
                from  menu as m
             left Join submenu as s on m.idMenu =s.idMenu
            left Join permiso as p on p.idSubmenu=s.idSubmenu
            and p.idUsuario = ' . $idusu);
        return $query;
    }

    public static function cambiarEstadoPermiso($idpermiso, $estado)
    {
        $query = DB::table('permiso as p')
            ->where('p.idPermiso', '=', $idpermiso)
            ->update(['estado' => $estado]);
        return $query;
    }
    public static function getidPermiso($iduser,$idsubm)
    {
        $query = DB::table('permiso as p')
            ->select('p.idPermiso')
            ->where('p.idUsuario', '=', $iduser)
            ->where('p.idSubMenu', '=', $idsubm)
            ->get();
        return $query;
    }
    public static function getidPermref($iduser)
    {
        $query = DB::table('permiso as p')
            ->select('p.idPermiso')
            ->join('submenu as sm','sm.idSubMenu','=','p.idSubMenu')
            ->join('menu as m','m.idMenu','=','sm.idMenu')
            ->where('p.idUsuario', '=', $iduser)
            ->where('m.idMenu', '=', 7)
            ->get();
        return $query;
    }
}
