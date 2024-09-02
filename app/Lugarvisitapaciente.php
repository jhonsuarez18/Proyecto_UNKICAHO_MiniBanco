<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Lugarvisitapaciente extends Model
{
    protected $table = 'lugarvisitapaciente';
    public $primaryKey = 'idLugarVisitaPaciente';
    public $timestamps = false;

    public static function obtenerRuta($idpaciente)
    {
        $query = DB::table('contactovisita as cv')
            ->select('lvp.idPacienteCovid as lvpidPacienteCovid','cv.idContactoVisita as cvidContactoVisita', 'cv.idPersona as cvidPersona', 'cv.descripcion as cvdescripcion',
                'lcv.idLugarvisitacontactovisita as lcvidLugarvisitacontactovisita', 'lcv.idContactoVisita as lcvidContactoVisita', 'lcv.idLugarVisitaPaciente as lcvidLugarVisitaPaciente',
                'lvp.idLugarVisitaPaciente as lvpidLugarVisitaPaciente', 'lvp.idDistrito as lvpidDistrito', 'lvp.actividad as lvpactividad', 'lvp.fecVisita as lvpfecVisita',
                DB::raw('concat (dep.descripcion,\' - \',prov.descripcion,\' - \',dis.descripcion) as lugar'))
            ->join('lugarvisitacontactovisita as lcv', 'cv.idContactoVisita', '=', 'lcv.idContactoVisita')
            ->join('lugarvisitapaciente as lvp', 'lvp.idLugarVisitaPaciente', '=', 'lcv.idLugarVisitaPaciente')
            ->join('distrito as dis', 'dis.idDistrito', '=', 'lvp.idDistrito')
            ->join('provincia as prov', 'prov.idProvincia', '=', 'dis.idProvincia')
            ->join('departamento as dep', 'dep.idDepartamento', '=', 'prov.idDepartamento')
            ->where('lvp.idPacienteCovid', '=', $idpaciente)
            ->orderBy('lvp.fecVisita')
            ->get();
        return $query;
    }
}
