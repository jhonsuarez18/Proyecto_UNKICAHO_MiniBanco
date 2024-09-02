<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Compra extends Model
{
    protected $table = 'compra';
    public $primaryKey = 'cId';
    public $timestamps = false;

    public static function obtenerCompra()
    {
        return DB::table('compra_producto as cp')
            ->select('cp.cpId as cpCod','c.cNFactura','c.cIgv','pv.pvRazonS','cp.cpCant','cp.cpPrecioC',
                DB::raw('LPAD(c.cId,"5",0) as codcomp'),
                DB::raw("concat(m.mDesc,'  ',tp.tpDesc,'  ',ps.psDesc) AS product"),
                DB::raw("cp.cpCant*cp.cpPrecioC AS total"),
                DB::raw('date(c.cFecCrea) as cFecCrea'), 'cp.cpEst')
            ->leftjoin('compra as c', 'c.cId', '=', 'cp.idC')
            ->leftjoin('proveedor as pv', 'pv.pvId', '=', 'c.idPv')
            ->leftjoin('producto as p', 'p.pId', '=', 'cp.idP')
            ->leftjoin('tip_producto as tp', 'tp.tpId', '=', 'p.idTp')
            ->leftjoin('marca as m', 'm.mId', '=', 'p.idM')
            ->leftjoin('presentacion as ps', 'ps.psId', '=', 'p.idPs')
            ->orderBy('cp.cpId', 'asc')->get();
    }
}
