<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class recepcion extends Model
{
    protected $table = 'recepcion';
    public $primaryKey = 'rcId';
    public $timestamps = false;

    public static function obtenerRecepcion()
    {
        return DB::table('recepcion_producto as rcp')
            ->select('rcp.rcpId as rcpCod',
                DB::raw('LPAD(rc.rcId,"5",0) as codrecep'),
                DB::raw("concat(m.mDesc,'  ',tp.tpDesc,'  ',ps.psDesc) AS product"),
                DB::raw("concat(rcp.rcpCant,'  ',um.umDesc) AS rcpCant"),
                DB::raw('concat(ifnull(pe.peAPPaterno,"")," ",ifnull(pe.peAPMaterno,"")," ",ifnull(pe.peNombres,"")) as alumno'),
                DB::raw("concat('S/.  ',rcpPrecioV) AS rcpPrecioV"),
                DB::raw("concat('S/.  ',rcp.rcpCant*rcp.rcpPrecioV) AS total"),
                DB::raw('date(rc.rcFecCrea) as rcFecCrea'), 'rcp.rcpEst')
            ->leftjoin('recepcion as rc', 'rc.rcId', '=', 'rcp.idRc')
            ->leftjoin('alumno as al', 'al.alId', '=', 'rc.idAl')
            ->leftjoin('persona as pe','pe.peId','=','al.idPe')
            ->leftjoin('producto as p', 'p.pId', '=', 'rcp.idP')
            ->leftjoin('tip_producto as tp', 'tp.tpId', '=', 'p.idTp')
            ->leftjoin('unidad_medida as um', 'um.umId', '=', 'tp.idUm')
            ->leftjoin('marca as m', 'm.mId', '=', 'p.idM')
            ->leftjoin('presentacion as ps', 'ps.psId', '=', 'p.idPs')
            ->orderBy('rcp.rcpId', 'asc')->get();
    }
}
