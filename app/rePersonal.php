<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use vakata\database\Exception;

class rePersonal extends Model
{
    protected $table = 're_personal';
    public $primaryKey = 'pId';
    public $timestamps = false;


    public static function getPersonal($term)
    {
        $query = DB::table('persona as p')->select('per.pId', 'tp.tPAbreviatura', DB::raw('concat(p.apPaterno," ",p.apMaterno,", ",p.pNombre," ",ifnull(p.sNombre,"")) as nombres'))
            ->join('re_personal as per', 'per.idPersona', '=', 'p.idPersona')
            ->join('re_tip_personal as tp', 'tp.tPId', '=', 'per.tPId')
            ->Where(DB::raw('concat(p.apPaterno," ",p.apMaterno," ",p.pNombre)'), 'LIKE', "%$term%")
            ->Where(['p.estado' => 1, 'per.pEst' => 1, 'tp.tPEst' => 1])
            ->limit(10000)
            ->get();
        return $query;
    }

    public function getPersona($idp)
    {
       return $query=DB::table('re_personal as re')->select('*')
           ->join('persona as pe','re.idPersona','=','pe.idPersona')
           ->where(['re.pId'=>$idp,'re.pEst'=>1,'pe.estado'=>1])->first();

    }
    public static function getPersonals()
    {
        return $query=DB::table('re_personal as pers')
            ->select('pers.pId','pe.numeroDoc','tipp.tPDescripcion','pers.idPersona','o.oNombre',
                'pColegiatura','pEspecialidad','us.name as user','pers.pEst', 'es.descripcion','oe.oId',
                'r.Descripcion', 'ud.nombre', 'e.descripcionEjecutora','es.descripcion','ent.eDesc',
                DB::raw('LPAD(pers.pId,"5",0) as codpers'),
                DB::raw("DATE_FORMAT(pers.pFecCrea,'%d-%m-%Y') as pFecCrea"),
                DB::raw('concat(pe.apPaterno," ",pe.apMaterno,", ",pe.pNombre," ",ifnull(pe.sNombre,"")) as person'))
            ->join('persona as pe','pers.idPersona','=','pe.idPersona')
            ->join('re_tip_personal as tipp','tipp.tPId','=','pers.tPId')
            ->join('users as us','us.id','=','pers.pUsuReg')
            ->join('re_oficina_entidad as oe', 'pers.oEId', '=', 'oe.oEId')
            ->join('re_oficina as o', 'oe.oId', '=', 'o.oId')
            ->leftjoin('eess as es', 'oe.idEess', '=', 'es.idEess')
            ->leftjoin('red as r', 'oe.idRed', '=', 'r.idRed')
            ->leftjoin('udr as ud', 'oe.idUdr', '=', 'ud.idUdr')
            ->leftjoin('ejecutora as e', 'oe.idEjecutora', '=', 'e.idEjecutora')
            ->leftjoin('re_entidad as ent', 'oe.eId', '=', 'ent.eId')
            ->orderBy('pers.pFecCrea','desc')
            ->get();

    }
    public static function getChoferes()
    {
        return $query=DB::table('re_personal as pers')
            ->select('pers.pId','pe.numeroDoc','tipp.tPDescripcion','pers.idPersona','o.oNombre',
                'pColegiatura','pEspecialidad','us.name as user','pers.pEst', 'es.descripcion','oe.oId',
                'r.Descripcion', 'ud.nombre', 'e.descripcionEjecutora','es.descripcion','ent.eDesc',
                DB::raw('LPAD(pers.pId,"5",0) as codpers'),
                DB::raw("DATE_FORMAT(pers.pFecCrea,'%d-%m-%Y') as pFecCrea"),
                DB::raw('concat(pe.apPaterno," ",pe.apMaterno,", ",pe.pNombre," ",ifnull(pe.sNombre,"")) as person'))
            ->join('persona as pe','pers.idPersona','=','pe.idPersona')
            ->join('re_tip_personal as tipp','tipp.tPId','=','pers.tPId')
            ->join('users as us','us.id','=','pers.pUsuReg')
            ->join('re_oficina_entidad as oe', 'pers.oEId', '=', 'oe.oEId')
            ->join('re_oficina as o', 'oe.oId', '=', 'o.oId')
            ->leftjoin('eess as es', 'oe.idEess', '=', 'es.idEess')
            ->leftjoin('red as r', 'oe.idRed', '=', 'r.idRed')
            ->leftjoin('udr as ud', 'oe.idUdr', '=', 'ud.idUdr')
            ->leftjoin('ejecutora as e', 'oe.idEjecutora', '=', 'e.idEjecutora')
            ->leftjoin('re_entidad as ent', 'oe.eId', '=', 'ent.eId')
            ->orderBy('pers.pFecCrea','desc')
            ->where('tipp.tPId','=',3)
            ->get();

    }
    public static function getPersonalEdit($id)
    {
        return $query=DB::table('re_personal as pers')
            ->select('pers.pId','pe.numeroDoc','es.descripcion as estab','tipp.tPDescripcion',
                'oe.oId','r.Descripcion', 'ud.nombre', 'e.descripcionEjecutora','es.descripcion','o.oId',
                'pColegiatura','pEspecialidad','us.name as user','pers.idPersona','pers.tPId','pers.oEId',
                DB::raw('LPAD(pers.pId,"5",0) as codpers'),
                DB::raw("DATE_FORMAT(pers.pFecCrea,'%d-%m-%Y') as pFecCrea"),
                DB::raw('concat(pe.numeroDoc," || ",pe.apPaterno," ",pe.apMaterno,", ",pe.pNombre," ",ifnull(pe.sNombre,"")) as person'))
            ->join('persona as pe','pers.idPersona','=','pe.idPersona')
            ->join('re_tip_personal as tipp','tipp.tPId','=','pers.tPId')
            ->join('users as us','us.id','=','pers.pUsuReg')
            ->join('re_oficina_entidad as oe', 'pers.oEId', '=', 'oe.oEId')
            ->join('re_oficina as o', 'oe.oId', '=', 'o.oId')
            ->leftjoin('eess as es', 'oe.idEess', '=', 'es.idEess')
            ->leftjoin('red as r', 'oe.idRed', '=', 'r.idRed')
            ->leftjoin('udr as ud', 'oe.idUdr', '=', 'ud.idUdr')
            ->leftjoin('ejecutora as e', 'oe.idEjecutora', '=', 'e.idEjecutora')
            ->orderBy('pers.pFecCrea','desc')
            ->where('pers.pId','=',$id)
            ->get();

    }
    public static function getPersonalDni($dni)
    {
        return DB::table('persona as pe')->select('*',
            DB::raw('TIMESTAMPDIFF(year,pe.fecNac, now() ) as edad'))
            ->join('re_personal as per', 'pe.idPersona', '=', 'per.idPersona')
            ->join('re_oficina_entidad as oe', 'oe.oEId', '=', 'per.oEId')
            ->join('re_tip_personal as tp', 'tp.tPId', '=', 'per.tPId')
            ->leftjoin('eess as es', 'oe.idEess', '=', 'es.idEess')
            ->leftjoin('red as r', 'oe.idRed', '=', 'r.idRed')
            ->leftjoin('udr as ud', 'oe.idUdr', '=', 'ud.idUdr')
            ->leftjoin('ejecutora as e', 'oe.idEjecutora', '=', 'e.idEjecutora')
            ->leftjoin('re_entidad as ent', 'oe.eId', '=', 'ent.eId')
            ->where('pe.numeroDoc', '=',$dni)
            ->where('per.pEst', '=',1)
            ->first();
    }
    public static function getChoferDni($dni)
    {
        return DB::table('re_personal as per')->select('es.descripcion','per.pId','oe.oId',
            'r.Descripcion','ud.nombre','e.descripcionEjecutora','ent.eDesc',
            DB::raw('case
                        when es.descripcion is not null then CONCAT("IPRESS - ",es.descripcion)
                        when ud.nombre is not null then CONCAT("UDR - ",ud.nombre)
                        when r.Descripcion is not null  then CONCAT("RED - ",r.Descripcion)
                         when e.descripcionEjecutora is not null  then CONCAT("EJEC - ",e.descripcionEjecutora)
                          when ent.eDesc is not null  then CONCAT("OTROS - ",ent.eDesc)
                        end eper
                        '),
            DB::raw("concat(pe.apPaterno,' ',pe.apMaterno ) as apell"),
            DB::raw('concat(pe.pNombre," ",ifnull(pe.sNombre,"")) as nombre'))
            ->join('persona as pe', 'pe.idPersona', '=', 'per.idPersona')
            ->join('re_oficina_entidad as oe', 'oe.oEId', '=', 'per.oEId')
            ->join('re_tip_personal as tp', 'tp.tPId', '=', 'per.tPId')
            ->leftjoin('eess as es', 'oe.idEess', '=', 'es.idEess')
            ->leftjoin('red as r', 'oe.idRed', '=', 'r.idRed')
            ->leftjoin('udr as ud', 'oe.idUdr', '=', 'ud.idUdr')
            ->leftjoin('ejecutora as e', 'oe.idEjecutora', '=', 'e.idEjecutora')
            ->leftjoin('re_entidad as ent', 'oe.eId', '=', 'ent.eId')
            ->where('pe.numeroDoc', '=',$dni)
            ->where('tp.tPId', '=',3)
            ->where('per.pEst', '=',1)
            ->get();
    }
}
