<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use mysql_xdevapi\Table;

class EntregaEpp extends Model
{
    protected $table = 'entregaepp';
    public $primaryKey = 'idEntregaEpp';
    public $timestamps = false;

    public static function obtenerEpp()
    {
        $id = '';
        $result = DB::table('entregaepp as epp')->select('epp.idEntregaEpp')->orderby('fecCreacion', 'DESC')->take(1)->get();
        foreach ($result as $r)
            $id = $r->idEntregaEpp;
        return $id;
    }

    public static function obtenerEntregasEpp($idpaciente)
    {
        return $result = DB::table('entregaepppaciente as epa')
            ->select('e.idEpp','ep.fecentregar as feent', 'epa.fecCreacion as fecdar','epa.Cantidad', 'e.descripcion as desc')
            ->rightJoin('entregaepp as ep', function ($q) use ($idpaciente) {
                $q->on('ep.idEntregaEpp', '=', 'epa.idEntregaEpp')
                    ->where('epa.idPacienteCovid', '=', $idpaciente);
            })
            ->join('epp as e', 'e.idEpp', '=', 'ep.idEpp')
            ->orderBy('ep.fecentregar', 'desc')
            ->orderBy('epa.fecCreacion', 'desc')
            ->get();

    }
    public static function getEntregaEpps(){
        return DB::table('entregaepp as eepp')
            ->select('eepp.idEntregaEpp','epp.descripcion','eepp.Cantidad','eepp.fecentregar',
                DB::raw("DATE_FORMAT(fecentregar,'%d-%m-%Y') AS fecentrega"),'us.name as uname','eepp.estado')
            ->join('epp as epp','epp.idEpp','=','eepp.idEpp')
            ->join('users as us','us.id','=','eepp.usuReg')
            ->orderBy('eepp.fecentregar','desc')
            ->get();
    }


}
