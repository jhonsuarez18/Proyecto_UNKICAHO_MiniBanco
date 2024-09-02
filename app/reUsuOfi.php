<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class reUsuOfi extends Model
{
    protected $table = 're_usu_ofi';
    public $primaryKey = 'uOId';
    public $timestamps = false;

    public function getTrabEss($idU)
    {
        //obtiene estabkencimiento del trabajador
        return DB::table('re_usu_ofi as uo')->select('*')
            ->join('re_oficina_entidad as oe', 'uo.oEId', '=', 'oe.oEId')
            ->join('eess as e', 'e.idEess', '=', 'oe.idEess')
            ->where(['e.estado' => 1, 'oe.oEEst' => 1, 'uOEst' => 1, 'uo.id' => $idU])->first();
    }


    public function getTrabEnti($idu)
    {
//obtiene la entidad donde trabaja, ejecutora, udr o red
        return DB::table('re_usu_ofi as uo')
            ->select('*', DB::raw('case when oe.idRed is not null then concat("RED ",r.Descripcion) else
                    case when oe.idEjecutora is not null then concat("EJECUTORA ",ej.descripcionEjecutora) else
                    case when oe.idUdr is not null then concat("UDR ",ud.nombre) end end end nomb'),
                DB::raw('case when oe.idRed is not null then 1 else
                    case when oe.idEjecutora is not null then 2 else
                    case when oe.idUdr is not null then 3 end end end ofitrab'))
            ->join('re_oficina_entidad as oe', 'uo.oEId', '=', 'oe.oEId')
            ->leftJoin('ejecutora as ej', 'ej.idEjecutora', '=', 'oe.idEjecutora')
            ->leftJoin('red as  r', 'r.idRed', '=', 'oe.idRed')
            ->leftJoin('udr as  ud', 'ud.idUdr', '=', 'oe.idUdr')
            ->where('uo.id', '=', $idu)->first();

    }

    public static function getUsuOficina()
    {
        return DB::table('re_usu_ofi as uo')
            ->select('uo.uOId', 'oe.oId', 'o.oNombre', 'uo.id', 'es.descripcion',
                'r.Descripcion', 'ud.nombre', 'e.descripcionEjecutora', 'p.numeroDoc', 'usa.name as uname',
                DB::raw('concat(p.apPaterno," ",p.apMaterno,", ",p.pNombre," ",ifnull(p.sNombre,"")) as usuario'),
                DB::raw('concat(pes.apPaterno," ",pes.apMaterno,", ",pes.pNombre," ",ifnull(pes.sNombre,"")) as usuari2'),
                DB::raw("DATE_FORMAT(uo.uOFecCrea,'%d-%m-%Y') AS uOFecCrea"), 'uo.uOEst')
            ->join('users as us', 'uo.id', '=', 'us.id')
            ->join('persona as p', 'p.idUser', '=', 'us.id')
            ->join('users as usa', 'uo.uOUsuReg', '=', 'usa.id')
            ->join('persona as pes', 'pes.idUser', '=', 'usa.id')
            ->join('re_oficina_entidad as oe', 'uo.oEId', '=', 'oe.oEId')
            ->join('re_oficina as o', 'oe.oId', '=', 'o.oId')
            ->leftjoin('eess as es', 'oe.idEess', '=', 'es.idEess')
            ->leftjoin('red as r', 'oe.idRed', '=', 'r.idRed')
            ->leftjoin('udr as ud', 'oe.idUdr', '=', 'ud.idUdr')
            ->leftjoin('ejecutora as e', 'oe.idEjecutora', '=', 'e.idEjecutora')
            ->get();

    }

    public static function getUsuOfEdit($id)
    {
        return DB::table('re_usu_ofi as uo')
            ->select('uo.uOId', 'oe.oEId', 'oe.oId', 'o.oNombre', 'uo.id', 'es.descripcion', 'r.Descripcion', 'ud.nombre', 'e.descripcionEjecutora', 'p.numeroDoc', 'us.name as uname',
                DB::raw("CONCAT(p.numeroDoc,' || ',p.pNombre,' ',ifnull(p.sNombre,''),'',p.apPaterno,' ',p.apMaterno) as usuario"),
                DB::raw("CONCAT(pes.pNombre,' ',pes.sNombre,' ',pes.apPaterno,' ',pes.apMaterno) as usuari2"),
                DB::raw("DATE_FORMAT(uo.uOFecCrea,'%d-%m-%Y') AS uOFecCrea"), 'uo.uOEst')
            ->join('users as us', 'uo.id', '=', 'us.id')
            ->join('persona as p', 'p.idUser', '=', 'us.id')
            ->join('users as usa', 'uo.uOUsuReg', '=', 'usa.id')
            ->join('persona as pes', 'pes.idUser', '=', 'usa.id')
            ->join('re_oficina_entidad as oe', 'uo.oEId', '=', 'oe.oEId')
            ->join('re_oficina as o', 'oe.oId', '=', 'o.oId')
            ->leftjoin('eess as es', 'oe.idEess', '=', 'es.idEess')
            ->leftjoin('red as r', 'oe.idRed', '=', 'r.idRed')
            ->leftjoin('udr as ud', 'oe.idUdr', '=', 'ud.idUdr')
            ->leftjoin('ejecutora as e', 'oe.idEjecutora', '=', 'e.idEjecutora')
            ->where('uo.uOId', '=', $id)
            ->get();

    }
}
