<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Gestante extends Model
{
    protected $table = 'gestante';
    public $primaryKey = 'idGestante';
    public $timestamps = false;

    public static function obtenerGestantes($idEss, $hist, $dni)
    {

        $query = DB::table('persona as p')
            ->select('g.estado as gestado', 'p.estado as pestado', 'p.telefono as telef', 'g.idGestante as id', 'g.nroHistoria as hisclini',
                'p.tipoDoc as tipdoc', 'p.numeroDoc as nrdoc', DB::raw('concat(p.apPaterno,\' \',p.apMaterno,\', \',p.pNombre,\' \',ifnull(p.sNombre,"")) as nombre'),
                'p.fecNac as fecnac', 'g.fecProbParto as fecprobparto', 'g.fecParto as fecparto', 'g.esPuerpera as partu',
                'pr.descripcion as provdesc'
                , 'd.descripcion as dist',
                'ej.descripcionEjecutora as ejec',
                'r.Descripcion as red', 'mr.descripcion as mrred',
                'e.descripcion as ess'
            )
            ->join('gestante  as g', 'g.idPersona', '=', 'p.idPersona')
            ->join('eess  as e', 'e.idEess', '=', 'g.idEss')
            ->join('distrito as d', 'e.idDistrito', '=', 'd.idDistrito')
            ->join('provincia as pr', 'pr.idProvincia', '=', 'd.idProvincia')
            ->join('ejecutora as ej', 'ej.idEjecutora', '=', 'e.idEjecutora')
            ->join('microred as mr', 'mr.idMicroRed', '=', 'e.idMicroRed')
            ->join('red as r', 'r.idRed', '=', 'mr.idRed');
        if ($dni !== '0')
            $query = $query->where('p.numeroDoc', '=', $dni);
        if ($hist === '0' && $dni === '0')
            $query = $query->where('e.idEess', '=', $idEss);
        if ($hist !== '0')
            $query = $query->where('g.nroHistoria', '=', $hist);

        return $query->get();
    }

    public static function obtenerGestanteDni($dni)
    {
        $query = DB::table('persona as p')
            ->select('*', 'd.descripcion as dist', 'pr.descripcion as prov')
            ->join('gestante  as g', 'g.idPersona', '=', 'p.idPersona')
            ->join('distrito as d', 'p.idDistrito', '=', 'd.idDistrito')
            ->join('provincia as pr', 'pr.idProvincia', '=', 'd.idProvincia')
            ->where('p.numeroDoc', '=', $dni)
            ->first();
        return $query;
    }

    public static function obtenerGestanteId($idgestante)
    {
        $query = DB::table('persona as p')
            ->select('*', 'd.descripcion as dist', 'd.idProvincia', 'pr.descripcion as prov', 'g.idEss as estab', 'es.idDistrito as disest', 'de.idProvincia as provest','pr.idDepartamento as dep')
            ->join('gestante  as g', 'g.idPersona', '=', 'p.idPersona')
            ->join('eess as es', 'es.idEess', '=', 'g.idEss')
            ->join('distrito as de', 'es.idDistrito', '=', 'de.idDistrito')
            ->join('distrito as d', 'p.idDistrito', '=', 'd.idDistrito')
            ->join('provincia as pr', 'pr.idProvincia', '=', 'd.idProvincia')
            ->where('g.idGestante', '=', $idgestante)
            ->first();
        return $query;
    }

    public static function obtenerGestante($idGestante)
    {
        $query = DB::table('persona as p')
            ->select('g.idGestante as id', 'g.nroHistoria as hisclini',
                'p.tipoDoc as tipdoc', 'p.numeroDoc as nrdoc', DB::raw('concat(p.apPaterno,\' \',p.apMaterno,\', \',p.pNombre,\' \',ifnull(p.sNombre,"")) as nombre'),
                'p.fecNac as fecnac', 'g.fecProbParto as fecprobparto', DB::raw('ifnull(g.fecParto,g.abortFecha) as fecparto'), 'g.abortFecha as fecabor', 'g.fecParto as atefecParto',
                'g.esPuerpera as partu', 'g.resultadoVBG', 'g.tamizajeVBG', 'g.factorRH', 'g.grupSanguineo', 'g.viaParto', 'g.cnvTipo', 'g.cnvFecha', 'g.luParto', 'g.usuRegParto', 'g.hemoPuerperio',
                'g.planifiFami', 'g.nombContacto', 'g.telfContacto', 'g.Observaciones'

            )->join('gestante  as g', 'g.idPersona', '=', 'p.idPersona')
            ->where('g.idGestante', '=', $idGestante)
            ->first();
        return $query;
    }

    public static function obtenerControlGestante($idGestante, $idActividad)
    {

        $query = DB::select(' select  t1.idSubActividad as idac, observacion as obs,t1.nombre as subact, t2.Resultado as res,t2.ateEstado as est,t2.fechaAtencion as fecate, t2.fecCreacion as feccrea, u.name as usu, e.descripcion as ess 
                     from subActividad as t1
                        left   Join gestanteSubActividad as t2 on t1.idSubActividad = t2.idSubActividad and
                        t2.idGestante=' . $idGestante . '
                     left Join users as u on t2.usuCrea = u.id
                     left Join eess as e on u.idEss =e.idEess
                     where t1.estado =1  and t1.idActividad =' . $idActividad);
        return $query;
    }

    public static function modificarTamizaje($idgestante, $tamizaje, $resultado, $usu)
    {
        $query = DB::table('gestante')
            ->where('idGestante', $idgestante)
            ->update(['tamizajeVBG' => $tamizaje, 'resultadoVBG' => $resultado, 'usuEdiVBG' => $usu]);
        return $query;
    }

    public static function modificarGrupoSanguineo($idgestante, $gruposanguine, $factorrh, $usu)
    {
        $query = DB::table('gestante')
            ->where('idGestante', $idgestante)
            ->update(['grupSanguineo' => $gruposanguine, 'factorRH' => $factorrh, 'usuEdiGS' => $usu]);
        return $query;
    }

    public static function modificarEstadoPartu($idgestante)
    {
        $query = DB::table('gestante')
            ->where('idGestante', $idgestante)
            ->update(['esPuerpera' => 1]);
        return $query;
    }

    public static function modificarGestanteParto($idgestante, $fecParto, $viaParto, $cnvTipo, $cnvFecha, $abortFecha, $luParto, $usuRegParto)
    {
        $query = DB::table('gestante')
            ->where('idGestante', $idgestante)
            ->update(['fecParto' => $fecParto, 'viaParto' => $viaParto, 'cnvTipo' => $cnvTipo, 'cnvFecha' => $cnvFecha, 'abortFecha' => $abortFecha, 'luParto' => $luParto, 'usuRegParto' => $usuRegParto]);
        return $query;
    }

    public static function modificarDatosPuerperio($idgestante, $hemoglobina, $planificacion)
    {
        $query = DB::table('gestante')
            ->where('idGestante', $idgestante)
            ->update(['hemoPuerperio' => $hemoglobina, 'planifiFami' => $planificacion]);
        return $query;
    }

    public static function modificarDatosObservaciones($idgestante, $nombcont, $telefcont, $observ)
    {
        $query = DB::table('gestante')
            ->where('idGestante', $idgestante)
            ->update(['nombContacto' => $nombcont, 'telfContacto' => $telefcont, 'Observaciones' => $observ]);
        return $query;
    }
}
