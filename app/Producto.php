<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Producto extends Model
{
    protected $table = 'producto';
    public $primaryKey = 'pId';
    public $timestamps = false;

    public static function obtenerProducto()
    {
        return DB::table('producto as p')
            ->select('p.pId as pCod', 'tp.tpDesc','m.mDesc','ps.psDesc',
                DB::raw("concat(p.pContenido,'  ',um.umDesc) AS pContenido"),
                'p.pPrecioC','p.pPrecioV','p.pStock', 'p.pEst')
            ->leftjoin('tip_producto as tp', 'tp.tpId', '=', 'p.idTp')
            ->leftjoin('unidad_medida as um', 'um.umId', '=', 'tp.idUm')
            ->leftjoin('marca as m', 'm.mId', '=', 'p.idM')
            ->leftjoin('presentacion as ps', 'ps.psId', '=', 'p.idPs')
            ->orderBy('p.pId', 'asc')->get();
    }
    public static function getProductoAct()
    {
        return DB::table('producto as p')
            ->select('p.pId as pCod', 'tp.tpDesc','m.mDesc','ps.psDesc',
                DB::raw("concat(tp.tpDesc,'  ',m.mDesc,'  ',ps.psDesc,' ',p.pContenido,' ',um.umDesc) AS product"),
                'p.pPrecioC','p.pPrecioV','p.pStock', 'p.pEst')
            ->leftjoin('tip_producto as tp', 'tp.tpId', '=', 'p.idTp')
            ->leftjoin('unidad_medida as um', 'um.umId', '=', 'tp.idUm')
            ->leftjoin('marca as m', 'm.mId', '=', 'p.idM')
            ->leftjoin('presentacion as ps', 'ps.psId', '=', 'p.idPs')
            ->orderBy('p.pId', 'asc')
            ->where('p.pEst','=',1)->get();
    }
    public static function obtenerProductoEditar($idprod)
    {
        return DB::table('producto as  p')
            ->select('p.pId as pCod', 'um.umDesc','tp.tpId','ps.psId','tp.tpDesc','m.mId','m.mDesc','ps.psDesc',
                'p.pContenido','p.pPrecioC','p.pPrecioV','p.pStock', 'p.pEst')
            ->leftjoin('tip_producto as tp', 'tp.tpId', '=', 'p.idTp')
            ->leftjoin('unidad_medida as um', 'um.umId', '=', 'tp.idUm')
            ->leftjoin('presentacion as ps', 'ps.psId', '=', 'p.idPs')
            ->leftjoin('marca as m', 'm.mId', '=', 'p.idM')
            ->where('p.pId', $idprod)
            ->orderBy('p.pId', 'asc')->get();
    }
}
