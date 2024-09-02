<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class pacientecovid extends Model
{
    protected $table = 'pacientecovid';
    public $primaryKey = 'idPacienteCovid';
    public $timestamps = false;

    static function editarPacienteIdPaciente($idpaciente)
    {
        $query = DB::table('persona as pe')
            ->select('pe.idPersona', 'pe.pNombre', DB::raw('IFNULL(pe.sNombre,\' \') as sNombre'),
                'pe.apPaterno', 'pe.apMaterno', 'pe.numeroDoc',
                'dis.idProvincia as peidprovincia',
                'pe.idDistrito as peidDistrito', 'pro.idDepartamento as peidDepartamento',
             //   , 'dispa.idDistrito as paidDistrito', 'propa.idProvincia as paidprovincia',
                'pe.tipoDoc', 'pe.direccion as pedireccion', 'pe.referencia', 'pe.fecNac', 'pe.telefono', 'pa.idPacienteCovid', 'pa.idDistrito', 'pa.direccion',
                'pa.fecExamen', 'pa.fecSintIni', 'pa.estadoPrueba', 'pa.idDistrito as paidDistrito')
            ->join('pacientecovid as pa', 'pa.idPersona', '=', 'pe.idPersona')
            ->rightJoin('distrito as dis', 'dis.idDistrito', '=', 'pe.idDistrito')
            ->join('provincia as pro', 'pro.idProvincia', '=', 'dis.idProvincia')
            ->join('departamento as dep', 'dep.idDepartamento', '=', 'pro.idDepartamento')
           /* ->rightJoin('distrito as dispa', 'dispa.idDistrito', '=', 'pa.idDistrito')
           ->join('provincia as propa', 'propa.idProvincia', '=', 'dispa.idProvincia')
            ->join('departamento  as deppa', 'deppa.idDepartamento', '=', 'propa.idDepartamento')*/
            ->where('pa.idPacienteCovid', '=', $idpaciente)
            ->first();
        return $query;
    }

    /*
        static function reportarCasosCovid()
        {
            $query = DB::table('pacientecovid as pa')
                ->select('pa.idPacienteCovid', 'pe.numeroDoc',
                    DB::raw('concat(pe.apPaterno,\' \',pe.apMaterno,\', \',pe.pNombre,\' \',' . DB::raw('IFNULL(pe.sNombre,\' \')') . ') as nomb'),
                    DB::raw('concat(dep.descripcion,\' - \',pro.descripcion,\' - \',dis.descripcion) as dirrec'), 'pe.direccion',
                    'pe.telefono',
                    DB::raw('concat(dispa . descripcion, \' - \',propa.descripcion,\' - \',deppa.descripcion) as dircont'),
                    'pa.fecExamen', 'pa.fecSintIni', 'pa.estadoPrueba', 'pa.fecCreacion')
                ->join('persona as pe', 'pe.idPersona', '=', 'pa.idPersona')
                ->join('distrito as dis', 'dis.idDistrito', '=', 'pe.idDistrito')
                ->join('provincia as pro', 'pro.idProvincia', '=', 'dis.idProvincia')
                ->join('departamento as dep', 'dep.idDepartamento', '=', 'pro.idDepartamento')
                ->join('distrito as dispa', 'dispa.idDistrito', '=', 'pa.idDistrito')
                ->join('provincia as propa', 'propa.idProvincia', '=', 'dispa.idProvincia')
                ->join('departamento  as deppa', 'deppa.idDepartamento', '=', 'propa.idDepartamento')
                ->orderBy('pe.fecCreacion', 'desc')
                ->get();

            return $query;
        }*/

    static function reportarCasosCovid()
    {
        $query = DB::table('pacientecovid as pa')
            ->select('pa.idPacienteCovid', 'pe.numeroDoc',
                DB::raw('concat(pe.apPaterno,\' \',pe.apMaterno,\', \',pe.pNombre,\' \',' . DB::raw('IFNULL(pe.sNombre,\' \')') . ') as nomb'),
                DB::raw('concat(dep.descripcion,\' - \',pro.descripcion,\' - \',dis.descripcion) as dirrec'), 'pe.direccion',
                'pe.telefono',
                DB::raw('concat(ess.descripcion,\' - \',ofi.descripcion)  as dircont'),
                'pa.fecExamen', 'pa.fecSintIni', 'pa.estadoPrueba', 'pa.fecCreacion')
            ->join('persona as pe', 'pe.idPersona', '=', 'pa.idPersona')
            ->join('distrito as dis', 'dis.idDistrito', '=', 'pe.idDistrito')
            ->join('provincia as pro', 'pro.idProvincia', '=', 'dis.idProvincia')
            ->join('departamento as dep', 'dep.idDepartamento', '=', 'pro.idDepartamento')
            ->join('esstablecimientooficina as esof', 'esof.idEsstaboficina', '=', 'pa.idEsstaboficina')
            ->join('oficina as ofi', 'ofi.idOficina', '=', 'esof.idOficina')
            ->join('eess as ess', 'ess.idEess', '=', 'esof.idEess')
            ->whereNotNull('esof.idEsstaboficina')
            ->orderBy('pe.fecCreacion', 'desc')
            ->get();

        return $query;
    }

    static function buscarPacienteCovidDni($dni)
    {
        $query = DB::table('persona as pe')
            ->select('pa.idPacienteCovid', 'pe.idPersona', 'pe.idDistrito', 'pe.pNombre', DB::raw('IFNULL(pe.sNombre,\' \') as sNombre'), 'pe.apPaterno', 'pe.apMaterno', 'pe.numeroDoc',
                'pe.tipoDoc', 'pe.direccion', 'pe.referencia', 'pe.fecNac', 'pe.telefono', 'pa.idPacienteCovid', 'pa.idDistrito', 'pa.direccion', 'pa.fecExamen', 'pa.fecSintIni', 'pa.estadoPrueba', 'pa.idDistrito as paidDistrito')
            ->join('pacientecovid as pa', 'pa.idPersona', '=', 'pe.idPersona')
            ->where('pe.numeroDoc', '=', $dni)
            ->first();
        return $query;
    }

    static function buscarPacienteCovidIdPaciente($idpaciente)
    {
        $query = DB::table('persona as pe')
            ->select('pe.idPersona', 'pe.idDistrito as dispe', 'pe.pNombre', DB::raw('IFNULL(pe.sNombre,\' \') as sNombre'), 'pe.apPaterno', 'pe.apMaterno', 'pe.numeroDoc',
                'pe.tipoDoc', 'pe.direccion as pedir', 'pe.referencia', 'pe.fecNac', 'pe.telefono', 'pa.idPacienteCovid', 'pa.idDistrito', 'pa.direccion', 'pa.fecExamen', 'pa.fecSintIni', 'pa.estadoPrueba', 'pa.idDistrito as paidDistrito',
                DB::raw('concat(ess.descripcion,\' - \',ofi.descripcion)  as dircont'))
            ->join('pacientecovid as pa', 'pa.idPersona', '=', 'pe.idPersona')
            ->join('esstablecimientooficina as esof', 'esof.idEsstaboficina', '=', 'pa.idEsstaboficina')
            ->join('oficina as ofi', 'ofi.idOficina', '=', 'esof.idOficina')
            ->join('eess as ess', 'ess.idEess', '=', 'esof.idEess')
            ->where('pa.idPacienteCovid', '=', $idpaciente)
            ->first();
        return $query;
    }

    /*
        static function reportarAtencionesDiariasCovid($fecha)
        {
            $query = DB::table('pacientecovid as pa')
                ->select('pa.idPacienteCovid', 'pe.numeroDoc',
                    DB::raw('concat(pe.apPaterno,\' \',pe.apMaterno,\', \',pe.pNombre,\' \',' . DB::raw('IFNULL(pe.sNombre,\' \')') . ') as nomb'),
                    DB::raw('concat(dep.descripcion,\' - \',pro.descripcion,\' - \',dis.descripcion) as dirrec'), 'pe.direccion',
                    'pe.telefono',
                    DB::raw('concat(dispa . descripcion, \' - \',propa.descripcion,\' - \',deppa.descripcion) as dircont'),
                    'pa.fecExamen', 'pa.fecSintIni', 'pa.fecCreacion', 'pa.estadoPrueba', 'a.estado as atenc', DB::raw('datediff(' . $fecha . ',pa.fecCreacion)+1 as dia', 'pa.fecCreacion as feccr'))
                ->leftJoin('atencion  as a', function ($q) use ($fecha) {
                    $q->on('a.idPacienteCovid', '=', 'pa.idPacienteCovid')
                        ->where(DB::raw('date(a.fecCreacion)'), '=', DB::raw('date(' . $fecha . ')'));
                })
                ->join('persona as pe', 'pe.idPersona', '=', 'pa.idPersona')
                ->join('distrito as dis', 'dis.idDistrito', '=', 'pe.idDistrito')
                ->join('provincia as pro', 'pro.idProvincia', '=', 'dis.idProvincia')
                ->join('departamento as dep', 'dep.idDepartamento', '=', 'pro.idDepartamento')
                ->join('distrito as dispa', 'dispa.idDistrito', '=', 'pa.idDistrito')
                ->join('provincia as propa', 'propa.idProvincia', '=', 'dispa.idProvincia')
                ->join('departamento  as deppa', 'deppa.idDepartamento', '=', 'propa.idDepartamento')
              //  ->whereBetween(DB::raw('datediff(' . $fecha . ',pa.fecCreacion)'), [0, 13])
              ->whereNotNull('esof.idEsstaboficina')
                ->orderBy('pe.fecCreacion', 'desc')
                ->get();

            return $query;
        }
    */

    static function reportarAtencionesDiariasCovid($fecha)
    {
        $query = DB::table('pacientecovid as pa')
            ->select('pa.idPacienteCovid', 'pe.numeroDoc',
                DB::raw('concat(pe.apPaterno,\' \',pe.apMaterno,\', \',pe.pNombre,\' \',' . DB::raw('IFNULL(pe.sNombre,\' \')') . ') as nomb'),
                DB::raw('concat(dep.descripcion,\' - \',pro.descripcion,\' - \',dis.descripcion) as dirrec'), 'pe.direccion',
                'pe.telefono',
                DB::raw('ofi.descripcion as dircont'),
                'pa.fecExamen', 'pa.fecSintIni', 'pa.fecCreacion', 'pa.estadoPrueba', 'a.estado as atenc', DB::raw('DATE(' . $fecha . ') as dia'), 'pa.fecCreacion as feccr'
                )
            ->leftJoin('atencion  as a', function ($q) use ($fecha) {
                $q->on('a.idPacienteCovid', '=', 'pa.idPacienteCovid')
                    ->where(DB::raw('date(a.fecCreacion)'), '=', DB::raw('date(' . $fecha . ')'));
            })
            ->join('persona as pe', 'pe.idPersona', '=', 'pa.idPersona')
            ->join('distrito as dis', 'dis.idDistrito', '=', 'pe.idDistrito')
            ->join('provincia as pro', 'pro.idProvincia', '=', 'dis.idProvincia')
            ->join('departamento as dep', 'dep.idDepartamento', '=', 'pro.idDepartamento')
            ->join('esstablecimientooficina as esof', 'esof.idEsstaboficina', '=', 'pa.idEsstaboficina')
            ->join('oficina as ofi', 'ofi.idOficina', '=', 'esof.idOficina')
            ->join('eess as ess', 'ess.idEess', '=', 'esof.idEess')
            ->whereNotNull('esof.idEsstaboficina')
            ->where('pe.estado',1)
            ->where('pa.estado',1)
            ->orderBy('pe.apPaterno', 'asc')
            ->orderBy('pe.apMaterno', 'asc')
            ->orderBy('pe.pNombre', 'asc')
            ->get();

        return $query;
    }

    static function reportarAtenciones($idPaciente)
    {
        DB::select('DROP TABLE IF EXISTS  tempTable1;');
        DB::select('DROP TABLE IF EXISTS tempTable2;');
        DB::select('CREATE TEMPORARY TABLE tempTable1
         select datediff(ate.fecCreacion,pc.fecCreacion)+1 as DIA, date(ate.fecCreacion) as FEC,sint.descripcion,ate.Detalles as OBS from pacientecovid pc
        join atencion ate on pc.idPacienteCovid=ate.idPacienteCovid
		join sintomaatencion sinate on sinate.idAtencion=ate.idAtencion
        join sintoma sint on sint.idSintoma=sinate.idSintoma
        where ate.idPacienteCovid=' . $idPaciente . '
        union
		select datediff(ate.fecCreacion,pc.fecCreacion)+1 as DIA,date(ate.fecCreacion) as FEC ,0 descripcion,ate.Detalles as OBS from pacientecovid pc
        join atencion ate on pc.idPacienteCovid=ate.idPacienteCovid
        left join sintomaatencion sinate on sinate.idAtencion=ate.idAtencion
         where ate.idPacienteCovid=' . $idPaciente . ' and sinate.idSintomaatencion is null;');
        DB::select('CREATE TEMPORARY   TABLE tempTable2
        select DIA,  CASE WHEN descripcion="FIEBRE" THEN 1 END AS "FIEBRE", CASE WHEN descripcion="TOS" THEN 1 END AS "TOS",
         CASE WHEN descripcion="DOLOR DE GARGANTA" THEN 1 END AS "DOLORDEGARGANTA", CASE WHEN descripcion="CONGESTION NASAL" THEN 1 END AS "CONGESTIONNASAL",
          CASE WHEN descripcion="DIFICULTAD RESPIRATORIA" THEN 1 END AS "DIFICULTADRESPIRATORIA", CASE WHEN descripcion="OTRO" THEN 1 END AS "OTRO",OBS,FEC
          from tempTable1
        order by DIA;');
        $data = DB::select('select  CONCAT(DIA," DIA") as DIA, ifnull(MAX(FIEBRE),0) as FIEBRE , ifnull(MAX(TOS),0)  as TOS ,  ifnull(MAX(DOLORDEGARGANTA),0)  as DOLORDEGARGANTA,
        ifnull(MAX(CONGESTIONNASAL),0)  as CONGESTIONNASAL, ifnull(MAX(DIFICULTADRESPIRATORIA),0)  as DIFICULTADRESPIRATORIA,
        ifnull(MAX(OTRO),0) as OTRO, ifnull(MAX(OBS),0) as OB,MAX(FEC) as FEC
         from tempTable2
        group by DIA');
        return $data;
    }


}
