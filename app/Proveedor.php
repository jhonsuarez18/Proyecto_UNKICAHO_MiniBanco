<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Proveedor extends Model
{
    protected $table = 'proveedor';
    public $primaryKey = 'pvId';
    public $timestamps = false;

    public static function obtenerProveedor()
    {
        return DB::table('proveedor as pv')
            ->select('pv.pvId as pvCod', 'pv.pvRazonS','pv.pvRuc','pv.pvTelefono' ,'pv.pvDireccion'  ,'pv.pvEst')
            ->orderBy('pv.pvId', 'asc')->get();
    }
    public static function getProveedorAct()
    {
        return DB::table('proveedor as pv')
            ->select('pv.pvId as pvCod', DB::raw("concat(pv.pvRuc,'-',pv.pvRazonS) AS pvProv"),
                     'pv.pvTelefono' ,'pv.pvDireccion'  ,'pv.pvEst')
            ->orderBy('pv.pvId', 'asc')
            ->where('pv.pvEst','=',1)->get();
    }
    public static function obtenerProveedorEditar($idprod)
    {
        return DB::table('proveedor as  pv')
            ->select('pv.pvId as pvCod', 'pv.pvRazonS','pv.pvRuc',
                'dis.dtId','prov.idProvincia','dep.idDepartamento','pv.pvTelefono' ,'pv.pvDireccion'  ,'pv.pvEst')
            ->leftjoin('distrito as dis', 'dis.dtId', '=', 'pv.idDt')
            ->leftjoin('provincia as prov', 'prov.idProvincia', '=', 'dis.idProvincia')
            ->leftjoin('departamento as dep', 'dep.idDepartamento', '=', 'prov.idDepartamento')
            ->where('pv.pvId', $idprod)
            ->orderBy('pv.pvId', 'asc')->first();
    }
    public static function getProveedorRuc($ruc)
    {
        return DB::table('proveedor as  pv')
            ->select('pv.pvId as pvCod', 'pv.pvRazonS','pv.pvRuc',
                'dis.dtId','prov.idProvincia','dep.idDepartamento','pv.pvTelefono' ,'pv.pvDireccion'  ,'pv.pvEst')
            ->leftjoin('distrito as dis', 'dis.dtId', '=', 'pv.idDt')
            ->leftjoin('provincia as prov', 'prov.idProvincia', '=', 'dis.idProvincia')
            ->leftjoin('departamento as dep', 'dep.idDepartamento', '=', 'prov.idDepartamento')
            ->where('pv.pvRuc', $ruc)
            ->orderBy('pv.pvId', 'asc')->first();
    }
}
