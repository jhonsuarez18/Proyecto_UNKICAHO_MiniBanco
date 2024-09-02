<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ViViatico extends Model
{
    protected $table = 'vi_viatico';
    public $primaryKey = 'vId';
    public $timestamps = false;

    public function getViaitcoId($id)
    {
        return DB::table('vi_viatico as v')
            ->select('*', 'v.vId'
                , DB::raw('concat(pe.apPaterno," ",pe.apMaterno," ",pe.pNombre," ",ifnull(pe.sNombre,"")) as nomb'),
                DB::raw('case
                        when es.descripcion is not null then es.descripcion
                        when ud.nombre is not null then ud.nombre
                        when r.Descripcion is not null  then r.Descripcion
                         when eje.descripcionEjecutora is not null  then eje.descripcionEjecutora
                          when ent.eDesc is not null  then ent.eDesc
                        end descripcion
                        ')
                , DB::raw('DATE_FORMAT(rFecRetor, "%d-%m-%Y") as rFecRetorv')
            )
            ->join('re_doc_file as df', 'df.dFId', '=', 'v.dFId')
            ->join('re_referencia as ref', 'ref.rId', '=', 'df.rId')
            ->join('re_personal as pers', 'pers.pId', '=', 'v.pId')
            ->join('persona as pe', 'pe.idPersona', '=', 'pers.idPersona')
            ->join('re_oficina_entidad as oe', 'pers.oEId', '=', 'oe.oEId')
            ->join('re_tip_personal as tp', 'tp.tPId', '=', 'pers.tPId')
            ->leftjoin('eess as es', 'oe.idEess', '=', 'es.idEess')
            ->leftjoin('red as r', 'oe.idRed', '=', 'r.idRed')
            ->leftjoin('udr as ud', 'oe.idUdr', '=', 'ud.idUdr')
            ->leftjoin('ejecutora as eje', 'oe.idEjecutora', '=', 'eje.idEjecutora')
            ->leftjoin('re_entidad as ent', 'oe.eId', '=', 'ent.eId')
            ->where('v.vId', '=', $id)->first();
        /*return DB::table('vi_viatico as v')
            ->select('*', 'v.vId'
                , DB::raw('concat(pe.apPaterno," ",pe.apMaterno,", ",pe.pNombre," ",pe.sNombre) as nomb'),
                'es.descripcion'
                , DB::raw('DATE_FORMAT(rFecRetor, "%d-%m-%Y") as rFecRetorv')
            )
            ->join('re_doc_file as df', 'df.dFId', '=', 'v.dFId')
            ->join('re_referencia as ref', 'ref.rId', '=', 'df.rId')
            ->join('re_personal as pers', 'pers.pId', '=', 'v.pId')
            ->join('persona as pe', 'pe.idPersona', '=', 'pers.idPersona')
            ->join('re_oficina_entidad as oe', 'pers.oEId', '=', 'oe.oEId')
            ->join('re_tip_personal as tp', 'tp.tPId', '=', 'pers.tPId')
            ->join('eess as es', 'oe.idEess', '=', 'es.idEess')
            ->where('v.vId', '=', $id)->first();*/
    }

    public function getCompVId($vid)
    {
        return DB::table('vi_comprobantes as c')->SELECT('*')
            ->join('vi_tipo_doc_gasts as tdg', 'tdg.tDGId', '=', 'c.tDGId')
            ->join('vi_tipo_docs as td', 'td.tDId', '=', 'tdg.tDId')
            ->join('vi_gastos as tg', 'tg.gId', '=', 'tdg.gId')
            ->where('c.vId', '=', $vid)->get();

    }

    public function getCantViatiIdR($rid)
    {
        return DB::table('re_doc_file as rf')->
        SELECT(DB::raw('count(*) as cant'))
            ->join('vi_viatico  as vi', 'vi.dFId', '=', 'rf.dFId')
            ->join('vi_comprobantes as vc', 'vc.vId', '=', 'vi.vId')
            ->where('rId', '=', $rid)->first();
    }


}
