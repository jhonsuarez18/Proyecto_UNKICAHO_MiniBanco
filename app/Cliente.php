<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cliente extends Model
{
    protected $table = 'cliente';
    public $primaryKey = 'clId';
    public $timestamps = false;
    public static function getClientes()
    {
        return $query=DB::table('cliente as cl')
            ->select('cl.clId','pe.peNumeroDoc','td.tdDescCorta',
                'cl.clEst','pe.peTelefono','ds.codigo as coddist','dis.codigo',
                DB::raw('LPAD(cl.clId,"5",0) as codcli'),
                DB::raw("DATE_FORMAT(cl.clFecCrea,'%d-%m-%Y') as clFecCrea"),
                DB::raw('concat(IFNULL(pe.peAPPaterno,"")," ",IFNULL(pe.peAPMaterno,"")," ",pe.peNombres) as person'))
            ->join('persona as pe','pe.peId','=','cl.idPe')
            ->leftjoin('centropoblado_distrito as cpd', 'cpd.cPDId', '=', 'pe.cPDId')
            ->leftjoin('distrito as ds', 'ds.dtId', '=', 'cpd.idDt')
            ->leftjoin('distrito as dis', 'dis.dtId', '=', 'pe.idDt')
            ->leftjoin('tipo_doc as td', 'td.tdId', '=', 'pe.idTD')
            ->orderBy('cl.clFecCrea','desc')
            ->get();

    }
    public static function getClienteDni($dni)
    {
        return DB::table('persona as pe')->select('*',
            DB::raw('TIMESTAMPDIFF(year,pe.peFecNac, now() ) as edad'))
            ->join('cliente as cl', 'pe.peId', '=', 'cl.idPe')
            ->where('pe.peNumeroDoc', '=',$dni)
            ->where('cl.clEst', '=',1)
            ->first();
    }
    public static function obtenerCliente($term)
    {
        $query = DB::table('cliente as cl')->select('cl.clId',
            DB::raw('concat(ifnull(pe.peNumeroDoc,""),"-",ifnull(pe.peAPPaterno,"")," ",ifnull(pe.peAPMaterno,"")," ",ifnull(pe.peNombres,"")) as person'))
            ->join('persona as pe','pe.peId','=','cl.idPe')
            ->Where(DB::raw('concat(ifnull(pe.peNumeroDoc,""),"-",ifnull(pe.peAPPaterno,"")," ",ifnull(pe.peAPMaterno,"")," ",ifnull(pe.peNombres,""))'), 'LIKE', "%$term%")
            ->Where('cl.clEst', '=', 1)
            ->limit(10000)
            ->get();
        return $query;
    }
}
