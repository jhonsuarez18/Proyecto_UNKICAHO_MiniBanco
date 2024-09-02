<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Venta extends Model
{
    protected $table = 'venta';
    public $primaryKey = 'vId';
    public $timestamps = false;

    public static function obtenerVenta()
    {
        return DB::table('venta_producto as vp')
            ->select('vp.vpId as vpCod','vp.vpCant','vp.vpPrecioV',
                DB::raw('LPAD(v.vId,"5",0) as codvent'),
                DB::raw("concat(m.mDesc,'  ',tp.tpDesc,'  ',ps.psDesc) AS product"),
                DB::raw('concat(ifnull(pe.peAPPaterno,"")," ",ifnull(pe.peAPMaterno,"")," ",ifnull(pe.peNombres,"")) as cliente'),
                DB::raw("vp.vpCant*vp.vpPrecioV AS total"),
                DB::raw('date(v.vFecCrea) as vFecCrea'), 'vp.vpEst')
            ->leftjoin('venta as v', 'v.vId', '=', 'vp.idV')
            ->leftjoin('cliente as cl', 'cl.clId', '=', 'v.idCl')
            ->leftjoin('persona as pe', 'pe.peId', '=', 'cl.idPe')
            ->leftjoin('producto as p', 'p.pId', '=', 'vp.idP')
            ->leftjoin('tip_producto as tp', 'tp.tpId', '=', 'p.idTp')
            ->leftjoin('marca as m', 'm.mId', '=', 'p.idM')
            ->leftjoin('presentacion as ps', 'ps.psId', '=', 'p.idPs')
            ->orderBy('vp.vpId', 'asc')->get();
    }
}
