<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class reUbicacion extends Model
{
    protected $table = 're_ubicacion';
    public $primaryKey = 'uId';
    public $timestamps = false;

    public static function getUbicaciones($idref)
    {
        $query = DB::table('re_ubicacion as ub')
            ->select('ub.fFecRecep','ub.fRevEst','ub.fFecRevi','df.dFId',
                'df.dFDescripcion', 'ub.uId','rv.rEstRev','rv.rId as rvId','ub.rId','df.dId','vi.vId')
            ->join('re_revision as rv', 'rv.uId', '=', 'ub.uId')
            ->join('re_doc_file as df', 'df.dFId', '=', 'rv.dFId')
            ->leftJoin('vi_viatico as vi','df.dFId','=','vi.dFId')
            ->where('ub.rId', '=', $idref)
            ->get();
        return $query;
    }
    public static function ObtenerUbicacionesref($idref)
    {
        $query = DB::table('re_referencia  as re')
            ->select('of.oNombre','oe.oId', 'ub.fFecRecep', 'oe.oEId','ub.fRevEst','ub.fFecRevi',
                DB::raw("DATE_FORMAT(ub.uFecCrea,'%d-%m-%Y') AS uFecCrea"),
                DB::raw("DATE_FORMAT(ub.uFecCrea,'%H:%i %p') AS uhora"),
                DB::raw('concat(p.apPaterno," ",p.apMaterno,", ",p.pNombre," ",ifnull(p.sNombre,"")) as nombre'),
                 'ub.uId')
            ->join('re_ubicacion as ub', 'ub.rId', '=', 're.rId')
            ->join('re_oficina_entidad as oe', 'oe.oEId', '=', 'ub.oEId')
            ->join('re_oficina as of', 'of.oId', '=', 'oe.oId')
            ->join('users as us', 'us.id', '=', 'ub.uUsuReg')
            ->join('persona as p', 'p.idUser', '=', 'us.id')
            ->where('re.rId', '=', $idref)
            ->orderBy('ub.uId','desc')
            ->get();
        return $query;
    }
}
