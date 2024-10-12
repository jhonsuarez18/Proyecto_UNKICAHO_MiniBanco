<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Alumno extends Model
{
    protected $table = 'alumno';
    public $primaryKey = 'alId';
    public $timestamps = false;

    public static function getAlumnos()
    {
        return $query=DB::table('alumno as al')
            ->select('al.alId','pe.peNumeroDoc','ga.gaDesc',
                'al.alEstado','pe.peTelefono','s.sDesc','dis.codigo',
                DB::raw('LPAD(al.alId,"5",0) as codalumn'),
                DB::raw("DATE_FORMAT(al.alFecCreacion,'%d-%m-%Y') as alFecCreacion"),
                DB::raw('concat(IFNULL(pe.peAPPaterno,"")," ",IFNULL(pe.peAPMaterno,"")," ",pe.peNombres) as alumno'))
            ->join('persona as pe','pe.peId','=','al.idPe')
            ->leftjoin('distrito as dis', 'dis.dtId', '=', 'pe.idDt')
            ->leftjoin('tipo_doc as td', 'td.tdId', '=', 'pe.idTD')
            ->leftjoin('grado_seccion as gs', 'gs.gsId', '=', 'al.idGS')
            ->leftjoin('grado_academico as ga', 'ga.gaId', '=', 'gs.idGA')
            ->leftjoin('seccion as s', 's.sId', '=', 'gs.idS')
            ->orderBy('al.alFecCreacion','desc')
            ->get();

    }
    public static function obtenerAlumno($term)
    {
        $query = DB::table('alumno as al')->select('al.alId','pe.peNumeroDoc','ga.gaDesc','s.sDesc',
            DB::raw('concat(ifnull(pe.peNumeroDoc,""),"-",ifnull(pe.peAPPaterno,"")," ",ifnull(pe.peAPMaterno,"")," ",ifnull(pe.peNombres,"")) as alumno'),
            DB::raw('concat(ifnull(pe.peAPPaterno,"")," ",ifnull(pe.peAPMaterno,"")," ",ifnull(pe.peNombres,"")) as nombres'),
            DB::raw("DATE_FORMAT(pe.peFecNac,'%d-%m-%Y') as alFecNac"))
            ->join('persona as pe','pe.peId','=','al.idPe')
            ->leftjoin('grado_seccion as gs', 'gs.gsId', '=', 'al.idGS')
            ->leftjoin('grado_academico as ga', 'ga.gaId', '=', 'gs.idGA')
            ->leftjoin('seccion as s', 's.sId', '=', 'gs.idS')
            ->Where(DB::raw('concat(ifnull(pe.peNumeroDoc,""),"-",ifnull(pe.peAPPaterno,"")," ",ifnull(pe.peAPMaterno,"")," ",ifnull(pe.peNombres,""))'), 'LIKE', "%$term%")
            ->Where('al.alEstado', '=', 1)
            ->limit(10000)
            ->get();
        return $query;
    }
    public static function getAlumnoDni($dni)
    {
        return DB::table('persona as pe')->select('*',
            DB::raw('TIMESTAMPDIFF(year,pe.peFecNac, now() ) as edad'))
            ->join('alumno as al', 'pe.peId', '=', 'al.idPe')
            ->where('pe.peNumeroDoc', '=',$dni)
            ->where('al.alEstado', '=',1)
            ->first();
    }
}
