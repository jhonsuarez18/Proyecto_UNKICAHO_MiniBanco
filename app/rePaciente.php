<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class rePaciente extends Model
{
    protected $table = 're_paciente';
    public $primaryKey = 'pId';
    public $timestamps = false;

    public function persona()
    {
        return $this->hasOne(Persona::class);
    }

    /*public static function getPacienteDni($dni)
    {
       return DB::table('persona as pe')->select('*',DB::raw('TIMESTAMPDIFF(year,pe.fecNac, now() ) as edad'))
            ->join('re_paciente as pa', 'pe.idPersona', '=', 'pa.idPersona')
            ->where('pe.numeroDoc', '=',$dni)
            ->first();
    }*/
    public static function getPacienteDni($dni)
    {
        return DB::table('persona as pe')->select('*',
            DB::raw('TIMESTAMPDIFF(year,pe.fecNac, now() ) as edad'))
            ->join('re_paciente as pa', 'pe.idPersona', '=', 'pa.idPersona')
            ->join('re_pac_tip_segs as pts', 'pts.pId', '=', 'pa.pId')
            ->join('re_tip_seguro as ts', 'ts.tSId', '=', 'pts.tSId')
            ->where('pe.numeroDoc', '=',$dni)
            ->where('pa.pEst', '=',1)
            ->first();
    }
    public static function getPacientes()
    {
        return $query=DB::table('re_paciente as pac')
            ->select('pac.pId','pe.numeroDoc',
                'pac.pEst','ts.tSDescrip','pe.telefono','ds.codigo as coddist','dis.codigo','us.name as user',
                DB::raw('LPAD(pac.pId,"5",0) as codpac'),
                DB::raw("DATE_FORMAT(pac.pFecCrea,'%d-%m-%Y') as pFecCrea"),
                DB::raw('concat(pe.apPaterno," ",pe.apMaterno,", ",pe.pNombre," ",ifnull(pe.sNombre,"")) as person'))
            ->join('persona as pe','pac.idPersona','=','pe.idPersona')
            ->join('re_pac_tip_segs as pts','pac.pId','=','pts.pId')
            ->join('re_tip_seguro as ts','ts.tSId','=','pts.tSId')
            ->leftjoin('centropoblado_distrito as cpd', 'cpd.cPDId', '=', 'pe.cPDId')
            ->leftjoin('distrito as ds', 'ds.idDistrito', '=', 'cpd.idDistrito')
            ->leftjoin('distrito as dis', 'dis.idDistrito', '=', 'pe.idDistrito')
            ->join('users as us','us.id','=','pac.pUsuReg')
            ->orderBy('pac.pFecCrea','desc')
            ->get();

    }

}
