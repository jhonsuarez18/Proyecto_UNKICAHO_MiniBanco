<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\DB;

class VConsumo extends Model
{
    protected $table = 'v_consumo';
    public $primaryKey = 'cId';
    public $timestamps = false;

    public static function getMetaEGVale($idocc)
    {
        return DB::table('v_c_oc_t_combust as cot')
            ->select('cb.cMId', 'mt.mCod')
            ->join('v_combustible as cb', 'cb.cOTId', '=', 'cot.cOTId')
            ->join('e_p_meta_epecifica_gasto as meg', 'meg.mEGId', '=', 'cb.mEGId')
            ->join('e_p_meta as mt', 'mt.mId', '=', 'meg.mId')
            ->where('cot.cOTId', '=', $idocc)
            ->groupBy('cb.cMId', 'mt.mCod')->get();

    }

    public static function getValConsumos()
    {
        return DB::table('v_consumo as cs')
            ->select('oc.oNumOC', 'pp.pPDesc', 'oc.oCNumFact', 'gf.gDesc', 'vh.vPlaca',
                'cs.cActiv', 'tc.tCDesc', 'cs.cCantGal', 'cs.cFecEnt', 'cs.cEst', 'cs.cId',
                DB::raw('LPAD(cs.cId,"5",0) as codcons'),
                DB::raw('concat(p.apPaterno," ",p.apMaterno,", ",p.pNombre," ",ifnull(p.sNombre,"")) as chofer'),
                DB::raw('case when cs.cFecEnt = date(now()) then 1 else 0 end ed'))
            ->join('v_combustible as cb', 'cb.cMId', '=', 'cs.cMId')
            ->join('v_vehiculo as vh', 'vh.vId', '=', 'cs.vId')
            ->join('re_personal as ps', 'ps.pId', '=', 'cs.pId')
            ->join('persona as p', 'p.idPersona', '=', 'ps.idPersona')
            ->join('e_p_meta_epecifica_gasto as meg', 'meg.mEGId', '=', 'cb.mEGId')
            ->join('e_p_meta as mt', 'mt.mId', '=', 'meg.mId')
            ->join('e_p_programa_presupuestal as pp', 'pp.pPId', '=', 'mt.pPId')
            ->join('v_c_oc_t_combust as cot', 'cot.cOTId', '=', 'cb.cOTId')
            ->join('v_orden_compra as oc', 'oc.oCId', '=', 'cot.oCId')
            ->join('v_grifo as gf', 'gf.gId', '=', 'oc.gId')
            ->join('v_tipo_combustible as tc', 'tc.tCId', '=', 'cot.tCId')
            ->orderBy('cs.cId','desc')
            ->get();
    }
    public static function getValesOC($idcm)
    {
        return DB::table('v_consumo as cs')
            ->select('oc.oCNumFact', 'tc.tCDesc', 'cs.cActiv','cs.cCantGal',
                DB::raw('LPAD(cs.cId,"5",0) as codcons'),
                DB::raw("DATE_FORMAT(cs.cFecEnt,'%d-%m-%Y') AS cFecEnt"))
            ->join('v_combustible as cb', 'cb.cMId', '=', 'cs.cMId')
            ->join('v_vehiculo as vh', 'vh.vId', '=', 'cs.vId')
            ->join('e_p_meta_epecifica_gasto as meg', 'meg.mEGId', '=', 'cb.mEGId')
            ->join('e_p_meta as mt', 'mt.mId', '=', 'meg.mId')
            ->join('e_p_programa_presupuestal as pp', 'pp.pPId', '=', 'mt.pPId')
            ->join('v_c_oc_t_combust as cot', 'cot.cOTId', '=', 'cb.cOTId')
            ->join('v_orden_compra as oc', 'oc.oCId', '=', 'cot.oCId')
            ->join('v_tipo_combustible as tc', 'tc.tCId', '=', 'cot.tCId')
            ->where('cs.cMId','=',$idcm)
            ->where('cs.cEst','=',1)->get();
    }
    public static function getValConsumoEdit($idc)
    {
        return DB::table('v_consumo as cs')
            ->select('oc.oCId', 'pp.pPDesc', 'oc.oCNumFact', 'cot.cOTId', 'vh.vPlaca', 'md.mCilindra',
                'cs.cActiv', 'tc.tCDesc', 'cs.cCantGal', 'cs.cCantKil', 'cs.cDocAuto', 'cs.cEst',
                'cs.cId', 'vh.vId', 'ps.pId', 'cb.cMId',  'oep.oId',
                    'ofev.oId as idof',
                DB::raw("CONCAT(gf.gRuc,'-',gf.gDesc) as grif"),
                DB::raw('LPAD(cs.cId,"5",0) as codcons'), 'p.numeroDoc', 'gf.gId', 'vh.vConKil',
                DB::raw('concat(p.pNombre," ",ifnull(p.sNombre,"")) as nombres'),
                DB::raw("DATE_FORMAT(cs.cFecEnt,'%d-%m-%Y') AS cFecEnt"),
                DB::raw('concat(p.apPaterno," ",p.apMaterno) as apellidos'),
                DB::raw('case when ofev.idRed is not null then concat("RED/",rdv.Descripcion)
                else
                  case when ofev.idEjecutora is not null then concat("EJECUTORA/",ejv.descripcionEjecutora) else
                  case when ofev.idUdr is not null then concat("UDR/",udrv.nombre) else
                  case when ofev.eId is not null then concat("ENT/",entv.eDesc) else
                  case when ofev.idEess is not null then concat("IPRESS/",essv.descripcion)
                  end
                  end end end end
                  entv'),
                DB::raw('Concat(mar.mDesc," - ",sm.sMDesc," - ",md.mDesc) as info'),
                DB::raw('case when oep.idRed is not null then concat("RED/",rp.Descripcion)
                else
                  case when oep.idEjecutora is not null then concat("EJECUTORA/",ep.descripcionEjecutora) else
                  case when oep.idUdr is not null then concat("UDR/",udp.nombre) else
                  case when oep.eId is not null then concat("ENT/",entp.eDesc) else
                  case when oep.idEess is not null then concat("IPRESS/",esp.descripcion)
                  end
                  end end end end
                  entp')
            )
            ->join('v_combustible as cb', 'cb.cMId', '=', 'cs.cMId')
            ->join('v_vehiculo as vh', 'vh.vId', '=', 'cs.vId')
            ->join('re_oficina_entidad as ofev', 'ofev.oEId', '=', 'vh.oEId')
            ->leftjoin('eess as essv', 'ofev.idEess', '=', 'essv.idEess')
            ->leftjoin('red as rdv', 'ofev.idRed', '=', 'rdv.idRed')
            ->leftjoin('udr as udrv', 'ofev.idUdr', '=', 'udrv.idUdr')
            ->leftjoin('ejecutora as ejv', 'ofev.idEjecutora', '=', 'ejv.idEjecutora')
            ->leftJoin('re_entidad as entv', 'ofev.eId','=','entv.eId' )

            ->join('v_modelo_tipo_vehiculo as mtv', 'mtv.mTVId', '=', 'vh.mTVId')
            ->join('v_modelo as md', 'md.mId', '=', 'mtv.mId')
            ->join('v_sub_marca as sm', 'md.sMId', '=', 'sm.sMId')
            ->join('v_marca as mar', 'mar.mId', '=', 'sm.mId')

            ->join('re_personal as ps', 'ps.pId', '=', 'cs.pId')
            ->join('persona as p', 'p.idPersona', '=', 'ps.idPersona')

            ->join('re_oficina_entidad as oep', 'oep.oEId', '=', 'ps.oEId')
            ->leftjoin('eess as esp', 'oep.idEess', '=', 'esp.idEess')
            ->leftjoin('red as rp', 'oep.idRed', '=', 'rp.idRed')
            ->leftjoin('udr as udp', 'oep.idUdr', '=', 'udp.idUdr')
            ->leftjoin('ejecutora as ep', 'oep.idEjecutora', '=', 'ep.idEjecutora')
            ->leftJoin('re_entidad as entp', 'oep.eId','=','entp.eId' )

            ->join('e_p_meta_epecifica_gasto as meg', 'meg.mEGId', '=', 'cb.mEGId')
            ->join('e_p_meta as mt', 'mt.mId', '=', 'meg.mId')
            ->join('e_p_programa_presupuestal as pp', 'pp.pPId', '=', 'mt.pPId')
            ->join('v_c_oc_t_combust as cot', 'cot.cOTId', '=', 'cb.cOTId')
            ->join('v_orden_compra as oc', 'oc.oCId', '=', 'cot.oCId')
            ->join('v_grifo as gf', 'gf.gId', '=', 'oc.gId')
            ->join('v_tipo_combustible as tc', 'tc.tCId', '=', 'cot.tCId')
            ->where('cs.cId', '=', $idc)
            ->get();

    }

    public function pdfConsumo($id)
    {
        return $data = DB::table('v_consumo as c')
            ->SELECT(DB::raw('LPAD(c.cId,"7",0) AS cId'), 'me.mCod','g.gDesc', 'c.cActiv', 'v.vPlaca','c.cCantGal',
                DB::raw('concat(per.apPaterno," ",per.apMaterno,", ",per.pNombre," ",ifnull(per.sNombre," "))  as nomb'),
                DB::raw('case when oe.idRed is not null then concat("RED/",r.Descripcion)
                else
  case when oe.idEjecutora is not null then concat("EJECUTORA/",ej.descripcionEjecutora) else
  case when oe.idUdr is not null then concat("UDR/",ud.nombre) else
  case when oe.eId is not null then concat("ENT/",ent.eDesc) else
  case when oe.idEess is not null then concat("IPRESS/",e.descripcion)
  end
  end end end end
  ent'),
                DB::raw('case when oep.idRed is not null then concat("RED/",rp.Descripcion)
                else
  case when oep.idEjecutora is not null then concat("EJE/",ejp.descripcionEjecutora) else
  case when oep.idUdr is not null then concat("UDR/",udp.nombre) else
  case when oep.eId is not null then concat("A/",entp.eDesc) else
  case when oep.idEess is not null then concat("IPRESS/",ep.descripcion)
  end
  end end end end
  entp'),
                DB::raw('year(cFecEnt)as ano'),
                DB::raw('LPAD(month(cFecEnt),"2",0)  as mes'),
                DB::raw('LPAD(day(cFecEnt),"2",0)  as dia'),
                'oc.oNumOC', 'tc.tCDesc', 'oc.oCNumFact', 'pp.pPDesc', 'oep.oEId','c.cEst')
            ->join('v_vehiculo as v', 'v.vId', '=', 'c.vId')
            ->join('re_oficina_entidad as oe', 'oe.oEId', '=', 'v.oEId')
            ->leftJoin('ejecutora as ej', 'ej.idEjecutora', '=', 'oe.idEjecutora')
            ->leftJoin('red as r', 'r.idRed', '=', 'oe.idRed')
            ->leftJoin('udr as ud', 'ud.idUdr', '=', 'oe.idUdr')
            ->leftJoin('re_entidad as ent', 'ent.eId', '=', 'oe.eId')
            ->leftJoin('eess as e', 'e.idEess', '=', 'oe.idEess')
            ->join('re_personal as p', 'p.pId', '=', 'c.pId')
            ->join('re_oficina_entidad as oep', 'oep.oEId', '=', 'p.oEId')
            ->leftJoin('ejecutora as ejp', 'ejp.idEjecutora', '=', 'oep.idEjecutora')
            ->leftJoin('red as rp', 'rp.idRed', '=', 'oep.idRed')
            ->leftJoin('eess as ep', 'ep.idEess', '=', 'oep.idEess')
            ->leftJoin('udr as udp', 'udp.idUdr', '=', 'oep.idUdr')
            ->leftJoin('re_entidad as entp', 'entp.eId', '=', 'oep.eId')
            ->join('persona as per', 'per.idPersona', '=', 'p.idPersona')
            ->join('v_combustible as cm', 'cm.cMId', '=', 'c.cMId')
            ->join('v_c_oc_t_combust as vc', 'vc.cOTId', '=', 'cm.cOTId')
            ->join('v_orden_compra as oc', 'oc.oCId', '=', 'vc.oCId')
            ->join('v_grifo as g', 'g.gId', '=', 'oc.gId')
            ->join('v_tipo_combustible as tc', 'tc.tCId', '=', 'vc.tCId')
            ->join('e_p_meta_epecifica_gasto as em', 'em.mEGId', '=', 'cm.mEGId')
            ->join('e_p_meta as me', 'me.mId', '=', 'em.mId')
            ->join('e_p_programa_presupuestal as pp', 'pp.pPId', '=', 'me.pPId')
            ->where(['c.cId' => $id])->get();


    }
    public static function reportegeneralval()
    {
        return DB::table('v_consumo as cs')
            ->select('oc.oNumOC', 'pp.pPDesc', 'oc.oCNumFact', 'gf.gDesc', 'vh.vPlaca',
                'cs.cActiv', 'tc.tCDesc', 'cs.cCantGal', 'cs.cFecEnt', 'cs.cEst', 'cs.cId','mt.mCod',
                DB::raw('LPAD(cs.cId,"5",0) as codcons'),
                DB::raw('concat(p.apPaterno," ",p.apMaterno,", ",p.pNombre," ",ifnull(p.sNombre,"")) as chofer'),
                DB::raw('case when cs.cFecEnt = date(now()) then 1 else 0 end ed'))
            ->join('v_combustible as cb', 'cb.cMId', '=', 'cs.cMId')
            ->join('v_vehiculo as vh', 'vh.vId', '=', 'cs.vId')
            ->join('re_personal as ps', 'ps.pId', '=', 'cs.pId')
            ->join('persona as p', 'p.idPersona', '=', 'ps.idPersona')
            ->join('e_p_meta_epecifica_gasto as meg', 'meg.mEGId', '=', 'cb.mEGId')
            ->join('e_p_meta as mt', 'mt.mId', '=', 'meg.mId')
            ->join('e_p_programa_presupuestal as pp', 'pp.pPId', '=', 'mt.pPId')
            ->join('v_c_oc_t_combust as cot', 'cot.cOTId', '=', 'cb.cOTId')
            ->join('v_orden_compra as oc', 'oc.oCId', '=', 'cot.oCId')
            ->join('v_grifo as gf', 'gf.gId', '=', 'oc.gId')
            ->join('v_tipo_combustible as tc', 'tc.tCId', '=', 'cot.tCId')
            ->orderBy('cs.cId','desc')
            ->get();
    }

}
