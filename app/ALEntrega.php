<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ALEntrega extends Model
{
    protected $table = 'a_l_entrega';
    public $primaryKey = 'eId';
    public $timestamps = false;

    public function getEntrega($idloc)
    {
        return DB::table('a_l_entrega as e')
            ->select(DB::raw('ifnull(ess.descripcion,"SIN EESS") as ess'),'e.eEst', 'e.eId', 'e.eMotivo', 'e.eEnt', 'e.eFecEntrega', 'e.eUsuReg', 'u.name', DB::raw('count(es.eId ) as itms'))
            ->leftJoin('eess as ess','ess.idEess','=','e.idEess')
            ->join('a_l_entrega_stock as es', 'e.eId', '=', 'es.eId')
            ->join('a_l_stock as s', 's.sId', '=', 'es.sId')
            ->join('a_l_ingreso as i', 'i.iId', '=', 's.iId')
            ->join('a_l_local as l', 'l.lId', '=', 'i.lId')
            ->join('users as u', 'e.eUsuReg', '=', 'u.id')
            ->where('i.lId', '=', $idloc)
            ->orderBy('e.eFecEntrega','desc')
            ->groupBy('e.eEst','e.eId', 'e.eMotivo', 'e.eEnt','u.name', 'e.eFecEntrega', 'e.eUsuReg','ess.descripcion')->get();
    }

    public function getItmsEntrega($eId)
    {
        return DB::table('a_l_entrega_stock as es')
            ->select('es.esId','m.mCodMed','m.mMedNom as med', 'tm.tmDesc', 'es.esCantUni as cant','es.esFecCrea')
            ->join('a_l_stock as s', 's.sId', '=', 'es.sId')
            ->join('a_l_material as m', 'm.mId', '=', 's.mId')
            ->join('a_l_tip_mat as tm', 'tm.tmId', '=', 'm.tmId')
            ->where('es.eId', '=', $eId)

            ->get();


    }

    public function showEntrega($eId){
        return DB::table('a_l_entrega as e')
            ->select('*')
            ->join('eess as ess','ess.idEess','=','e.idEess')
            ->where('e.eId', '=', $eId)
            ->first();
    }

}












