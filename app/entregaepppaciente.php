<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class entregaepppaciente extends Model
{
    protected $table = 'entregaepppaciente';
    public $primaryKey = 'idEntregaEppPaciente';
    public $timestamps = false;
    public static function getReportEntregaEppGeneral()
    {
        return DB::table('entregaepppaciente as eppp')
            ->select(DB::raw('concat(ps.apPaterno," ",ps.apMaterno,", ",ps.pNombre," ",ifnull(ps.sNombre,"")) as paciente')
                ,'epp.fecentregar','ep.descripcion','eppp.Cantidad')
            ->leftjoin('entregaepp as epp', 'epp.idEntregaEpp', '=', 'eppp.idEntregaEpp')
            ->leftjoin('epp as ep', 'ep.idEpp', '=', 'epp.idEpp')
            ->leftjoin('pacientecovid as pc', 'pc.idPacienteCovid', '=', 'eppp.idPacienteCovid')
            ->leftjoin('persona as ps', 'ps.idPersona', '=', 'pc.idPersona')
            ->orderBy('epp.fecentregar', 'asc')
            ->orderBy('ps.apPaterno', 'asc')
            ->get();
    }
    public static function getReportentregaFecha($fecha)
    {
        return DB::table('entregaepppaciente as eppp')
            ->select(DB::raw('concat(ps.apPaterno," ",ps.apMaterno,", ",ps.pNombre," ",ifnull(ps.sNombre,"")) as paciente')
                ,'epp.fecentregar','ep.descripcion','eppp.Cantidad')
            ->leftjoin('entregaepp as epp', 'epp.idEntregaEpp', '=', 'eppp.idEntregaEpp')
            ->leftjoin('epp as ep', 'ep.idEpp', '=', 'epp.idEpp')
            ->leftjoin('pacientecovid as pc', 'pc.idPacienteCovid', '=', 'eppp.idPacienteCovid')
            ->leftjoin('persona as ps', 'ps.idPersona', '=', 'pc.idPersona')
            ->whereRaw(DB::raw("DATE_FORMAT(epp.fecentregar,'%d-%m-%Y')= ?"),$fecha)
            ->orderBy('ps.apPaterno', 'asc')
            ->get();
    }
}
