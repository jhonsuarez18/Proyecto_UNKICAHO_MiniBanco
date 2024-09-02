<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class contactovisita extends Model
{
    protected $table = 'contactovisita';
    public $primaryKey = 'idContactoVisita';
    public $timestamps = false;

    public static function buscarContacto($descripion, $idpaciente)
    {
        $id = '';
        $query = DB::table('contactovisita as cv')
            ->select('cv.idContactoVisita')
            ->join('lugarvisitacontactovisita as lcv', 'cv.idContactoVisita', '=', 'lcv.idContactoVisita')
            ->join('lugarvisitapaciente as lvp', 'lvp.idLugarVisitaPaciente', '=', 'lcv.idLugarVisitaPaciente')
            ->where('lvp.idPacienteCovid', '=', $idpaciente)
            ->where('cv.descripcion', 'like', $descripion)
            ->get();

        foreach ($query as $q) {
            $id = $q->idContactoVisita;
        }
        return $id;
    }

    public  static function contactosIdnetificados($idpaciente)
    {
        $query = DB::table('contactovisita as cov')
            ->select('pv2.idPacienteCovid as idPacienteCovid2','pv.idPacienteCovid', 'cov.descripcion',
                DB::raw('concat(per.apPaterno,\' \',per.apMaterno,\', \',per.pNombre,\' \','.DB::raw('IFNULL(per.sNombre,\' \')').') as nombres')
                , 'per.numeroDoc', 'per.telefono', 'lvp.actividad as atcdesc', 'lvp.fecVisita as feccontact')
            ->join('persona as per', 'cov.idPersona', '=', 'per.idPersona')
            ->join('lugarvisitacontactovisita as lcv', 'lcv.idContactoVisita', '=', 'cov.idContactoVisita')
            ->join('lugarvisitapaciente as lvp', 'lvp.idLugarVisitaPaciente', '=', 'lcv.idLugarVisitaPaciente')
            ->join('pacientecovid as pv', 'pv.idPacienteCovid', '=', 'lvp.idPacienteCovid')
            ->join('pacientecovid as pv2', 'pv2.idPersona','=','per.idPersona')
            ->where('pv.idPacienteCovid', '=', $idpaciente)->get();
        return $query;
    }
}
