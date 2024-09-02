<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Persona extends Model
{
    protected $table = 'persona';
    public $primaryKey = 'peId';
    public $timestamps = false;

    public static function validarDni($dni)
    {
        $query = DB::table('persona as u')->select(DB::raw('count(peNumeroDoc) as cant'))
            ->where('peNumeroDoc','=',$dni)
            ->get();
        return $query;
    }
    static function obtenerPersonaTermino($term){
        $query = DB::table('persona as p')
            ->select('p.idPe as idp', DB::raw('concat(p.peNumeroDoc," || ",p.peAPPaterno," ",p.peAPMaterno,", ",p.pNombres) as nombre'),'p.peNumeroDoc')
            ->Where(DB::raw('concat(p.peNumeroDoc,"||",p.peAPPaterno," ",p.peAPMaterno,", ",p.peNombres)'), 'LIKE', "%$term%")
            ->where('p.peEstado','=',1)
            ->limit(10000)
            ->get();
        return $query;
    }
    /*static function buscarPersonaDni($dni)
    {
        $query = DB::table('persona as pe')
            ->select('ds.idProvincia','pv.idDepartamento', 'pe.idPersona', 'pe.idDistrito', 'pe.pNombre',
                DB::raw('IFNULL(pe.sNombre,\' \') as sNombre'), 'pe.apPaterno', 'pe.apMaterno', 'pe.numeroDoc',
                'pe.tipoDoc', 'pe.direccion', 'pe.referencia', 'pe.fecNac', 'pe.telefono')
            ->join('distrito as ds', 'ds.idDistrito', '=', 'pe.idDistrito')
            ->join('provincia as pv', 'pv.idProvincia', '=', 'ds.idProvincia')
            ->join('departamento as dp', 'dp.idDepartamento', '=', 'pv.idDepartamento')
            ->where('pe.numeroDoc', '=', $dni)
            ->first();
        return $query;
    }*/
    static function buscarPersonaDni($dni)
    {
        $query = DB::table('persona as pe')
            ->select('pe.peId',  'pe.peNombres',
                 'pe.peAPPaterno', 'pe.peAPMaterno', 'pe.peNumeroDoc',
                'pe.idTD as tipoDoc', 'pe.peDireccion', 'pe.peReferencia', 'pe.peFecNac', 'pe.peTelefono',
                'pe.idDt as dist','prov.idProvincia as provin','dep.idDepartamento as depa')
            ->leftjoin('distrito as dis', 'dis.dtId', '=', 'pe.idDt')
            ->leftjoin('provincia as prov', 'prov.idProvincia', '=', 'dis.idProvincia')
            ->leftjoin('departamento as dep', 'dep.idDepartamento', '=', 'prov.idDepartamento')
            ->leftjoin('tipo_doc as td', 'td.tdId', '=', 'pe.idTD')
            ->where('pe.peNumeroDoc', '=', $dni)
            ->first();
        return $query;
    }

}
