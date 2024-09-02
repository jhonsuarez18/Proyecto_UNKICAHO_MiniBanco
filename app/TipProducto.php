<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TipProducto extends Model
{
    protected $table = 'tip_producto';
    public $primaryKey = 'tpId';
    public $timestamps = false;

    public static function obtenerTipProducto()
    {
        return DB::table('tip_producto as tp')
            ->select('tp.tpId as tpCod', 'tp.tpDesc','um.umDesc', 'tp.tpEst')
            ->leftjoin('unidad_medida as um', 'um.umId', '=', 'tp.idUm')
            ->orderBy('tp.tpId', 'asc')->get();
    }
    public static function obtenerTipProductoEditar($idtprod)
    {
        return DB::table('tip_producto as  tp')
            ->select('tp.tpId', 'tp.tpDesc','tp.idUm','um.umDesc', 'tp.tpEst')
            ->leftjoin('unidad_medida as um', 'um.umId', '=', 'tp.idUm')
            ->where('tp.tpId', $idtprod)
            ->orderBy('tp.tpId', 'asc')->first();
    }
}
