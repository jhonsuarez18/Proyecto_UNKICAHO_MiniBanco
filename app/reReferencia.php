<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Utils;

class reReferencia extends Model
{
    protected $table = 're_referencia';
    public $primaryKey = 'rId';
    public $timestamps = false;


    public function getDiasRef($id)
    {
        return DB::table('re_referencia as re')
            ->select(DB::raw('(abs(datediff(date(rFecRetor),date(rFecRef)))+1) as dias'))
            ->where('rId', '=', $id)->first();
    }

    public function getDias($idv)
    {
        return DB::table('vi_viatico as vi')
            ->select(DB::raw('(abs(datediff(date(rFecRetor),date(rFecRef)))+1) as dias'))
            ->leftJoin('re_doc_file as df', 'df.dFId', '=', 'vi.dFId')
            ->leftJoin('re_referencia as re', 're.rId', '=', 'df.rId')
            ->where('vi.vId', '=', $idv)->first();
    }

    public function referenciasESS($idUsu)
    {

        $result1 = DB::table('re_referencia as re')
            ->select('re.rEstRec', DB::raw('LPAD(re.rId,"5",0) as codref'), 're.rId', 'ess.descripcion as ess', DB::raw('date(re.rFecRef) as rFecRef'), 're.rEst',
                DB::raw('null as plazo'), DB::raw('null as pCantDia'), DB::raw('null as fFecRecep')
                , DB::raw('null as fFecRevi'), DB::raw('null as oNombre'),
                DB::raw('null as fRevEst'), DB::raw('null as oId'), DB::raw('null as uId'))
            ->where('re.idEssRef', '=', function ($q2) use ($idUsu) {
                $q2->from('re_oficina_entidad')->select('idEess')->where('oEId', '=', function ($q) use ($idUsu) {
                    $q->from('re_usu_ofi as uo')
                        ->select('uo.oEId')
                        ->where(['uo.id' => $idUsu]);
                });
            })
            ->leftJoin('eess as ess', 'ess.idEess', '=', 're.idEess');


        $result2 = DB::table('re_ubicacion as u')
            ->select('u.uId', 'u.rId', 'u.oEId', 'u.fRevEst', 'u.fFecRevi', 'u.fFecRecep', 'u.uUsuReg', 'u.uEst', 'u.uFecCrea',
                DB::raw('(pl.pCantDia - DATEDIFF(NOW(),u.fFecRecep)) as plazo'), 'pl.pCantDia', 'of.oNombre', 'of.oId'

            )
            ->joinSub($result1, 'res1', function ($join) {
                $join->on('res1.rId', '=', 'u.rId');
            })
            ->join('re_oficina_entidad as oe', 'u.oEId', '=', 'oe.oEid')
            ->join('re_oficina as of', 'of.oId', '=', 'oe.oId')
            ->join('re_plazo as pl', 'pl.pId', '=', 'of.pId')
            ->where('u.uEst', '=', 1);


        return $result3 = DB::table('re_referencia as re')
            ->select('re.rEstRec', 're.vId', DB::raw('LPAD(re.rId,"5",0) as codref'), 're.rId', 'esss.descripcion as essref', 'ess.descripcion as ess', DB::raw('date(re.rFecRef) as rFecRef'), 're.rEst',
                DB::raw('case when res1.plazo<0 then 0 else res1.plazo end plazo'), 'res1.pCantDia', 'res1.fFecRecep'
                , 'res1.fFecRevi', 'res1.oNombre',
                'res1.fRevEst', 'res1.oId', 'res1.uId',
                DB::raw('case when Day(DATEDIFF(re.rFecRef,date(now())))  <= 4 then 1 else 0 end ed')
            )
            ->where('re.idEssRef', '=', function ($q2) use ($idUsu) {
                $q2->from('re_oficina_entidad')->select('idEess')->where('oEId', '=', function ($q) use ($idUsu) {
                    $q->from('re_usu_ofi as uo')
                        ->select('uo.oEId')
                        ->where(['uo.id' => $idUsu]);
                });
            })
            ->orWhere(['re.rUsuReg' => $idUsu, 're.rUsuMod' => $idUsu])
            ->orWhere([])
            ->leftJoinSub($result2, 'res1', function ($join) {
                $join->on('res1.rId', '=', 're.rId');
            })
            ->Join('eess as ess', 'ess.idEess', '=', 're.idEess')
            ->Join('eess as esss', 'esss.idEess', '=', 're.idEssRef');
        // ->orderBy('res1.oId', 'desc')
        //  ->orderBy('res1.plazo', 'asc');


    }

    public function referenciasRed($idUsu)
    {

        $red = DB::table('re_usu_ofi as uo')->select('idRed')
            ->join('re_oficina_entidad  as oe', 'oe.oEId', '=', 'uo.oEId')
            ->where('uo.id', '=', $idUsu)->first();


        $result1 = DB::table('re_referencia as re')
            ->select('re.rEstRec', DB::raw('LPAD(re.rId,"5",0) as codref'), 're.rId', 'essref.descripcion as essref', 'ess.descripcion as ess', DB::raw('date(re.rFecRef) as rFecRef'), 're.rEst',
                DB::raw('null as plazo'), DB::raw('null as pCantDia'), DB::raw('null as fFecRecep')
                , DB::raw('null as fFecRevi'), DB::raw('null as oNombre'), DB::raw('null as oId'),
                DB::raw('null as fRevEst'), DB::raw('null as uId'))
            ->whereIn('re.idEssRef',
                function ($q1) use ($red) {
                    $q1->from('eess as ess')
                        ->select('ess.idEess')
                        ->whereIn('ess.idMicroRed',
                            function ($q2) use ($red) {
                                $q2->from('microred as mr')
                                    ->select('mr.idMicroRed')
                                    ->where(['mr.idRed' => $red->idRed]);
                            }
                        )->get();

                }
            )
            ->leftJoin('eess as ess', 'ess.idEess', '=', 're.idEess')
            ->leftJoin('eess as essref', 'essref.idEess', '=', 're.idEssRef');


        $result2 = DB::table('re_ubicacion as u')
            ->select('u.uId', 'u.rId', 'u.oEId', 'u.fRevEst', 'u.fFecRevi', 'u.fFecRecep', 'u.uUsuReg', 'u.uEst', 'u.uFecCrea',
                DB::raw('(pl.pCantDia - DATEDIFF(NOW(),u.fFecRecep)) as plazo'), 'pl.pCantDia', 'of.oNombre', 'of.oId'
            )
            ->joinSub($result1, 'res1', function ($join) {
                $join->on('res1.rId', '=', 'u.rId');
            })
            ->join('re_oficina_entidad as oe', 'u.oEId', '=', 'oe.oEid')
            ->join('re_oficina as of', 'of.oId', '=', 'oe.oId')
            ->join('re_plazo as pl', 'pl.pId', '=', 'of.pId')
            ->where('u.uEst', '=', 1);

        return $result3 = DB::table('re_referencia as re')
            ->select('re.rEstRec', DB::raw('LPAD(re.rId,"5",0) as codref'), 're.rId', 'essref.descripcion as essref', 'ess.descripcion as ess', DB::raw('date(re.rFecRef) as rFecRef'), 're.rEst',
                DB::raw('case when res1.plazo<0 then 0 else res1.plazo end plazo'), 'res1.pCantDia', 'res1.fFecRecep'
                , 'res1.fFecRevi', 'res1.oNombre', 'res1.oEId',
                'res1.fRevEst', 'res1.oId', 'res1.uId')
            ->whereIn('re.idEssRef',
                function ($q1) use ($red) {
                    $q1->from('eess as ess')
                        ->select('ess.idEess')
                        ->whereIn('ess.idMicroRed',
                            function ($q2) use ($red) {
                                $q2->from('microred as mr')
                                    ->select('mr.idMicroRed')
                                    ->where(['mr.idRed' => $red->idRed]);
                            }
                        )->get();

                }
            )
            ->leftJoinSub($result2, 'res1', function ($join) {
                $join->on('res1.rId', '=', 're.rId');
            })
            ->Join('eess as ess', 'ess.idEess', '=', 're.idEess')
            ->leftJoin('eess as essref', 'essref.idEess', '=', 're.idEssRef')
            ->orderBy('rFecRef', 'asc')
            ->get();


    }

    public function referenciasUdr($idUsu)
    {
        $udr = DB::table('re_oficina_entidad')
            ->select('idUdr')
            ->where('oEId', function ($q2) use ($idUsu) {
                $q2->from('re_usu_ofi')
                    ->select('oEId')
                    ->where('id', '=', $idUsu);
            })->first();


        $result1 = DB::table('re_referencia as re')
            ->select('re.rEstRec', DB::raw('LPAD(re.rId,"5",0) as codref'), 're.rId', 'essref.descripcion as essref', 'ess.descripcion as ess', DB::raw('date(re.rFecRef) as rFecRef'), 're.rEst',
                DB::raw('null as plazo'), DB::raw('null as pCantDia'), DB::raw('null as fFecRecep')
                , DB::raw('null as fFecRevi'), DB::raw('null as oNombre'), DB::raw('null as oId'),
                DB::raw('null as fRevEst'))
            ->whereIn('re.idEssRef',
                function ($q1) use ($udr) {
                    $q1->from('eess as ess')
                        ->select('ess.idEess')
                        ->whereIn('ess.idEjecutora',
                            function ($q2) use ($udr) {
                                $q2->from('ejecutora as ejec')
                                    ->select('ejec.idEjecutora')
                                    ->where(['ejec.idUdr' => $udr->idUdr]);
                            }
                        )->get();

                }
            )
            ->leftJoin('eess as ess', 'ess.idEess', '=', 're.idEess')
            ->leftJoin('eess as essref', 'essref.idEess', '=', 're.idEssRef');


        return $result2 = DB::table('re_ubicacion as u')
            ->select(DB::raw('date(res1.rFecRef) as rFecRef'), 'res1.essref', 'res1.ess', DB::raw('LPAD(res1.rId,"5",0) as codref'),
                'res1.rEstRec', 'res1.rId', 'u.uId', 'u.rId', 'u.oEId', 'u.fRevEst', 'u.fFecRevi', 'u.fFecRecep', 'u.uUsuReg', 'u.uEst', 'u.uFecCrea',
                DB::raw('(pl.pCantDia - DATEDIFF(NOW(),u.fFecRecep)) as plazo'), 'pl.pCantDia', 'of.oNombre', 'of.oId', 'res1.rEst'
            )
            ->joinSub($result1, 'res1', function ($join) {
                $join->on('res1.rId', '=', 'u.rId');
            })
            ->join('re_oficina_entidad as oe', 'u.oEId', '=', 'oe.oEid')
            ->join('re_oficina as of', 'of.oId', '=', 'oe.oId')
            ->join('re_plazo as pl', 'pl.pId', '=', 'of.pId')
            ->where([
                'u.uEst' => 1,
            ])
            ->whereIn('of.oId', [4, 5])
            ->get();


    }

    /*public function referenciasEjecutor($idUsu)
    {
        $ejec =DB::table('re_oficina_entidad')
            ->select('idEjecutora')
            ->where('oEId', function ($q2) use ($idUsu) {
                $q2->from('re_usu_ofi')
                    ->select('oEId')
                    ->where('id', '=', $idUsu);
            })->first();


        $result1 = DB::table('re_referencia as re')
            ->select('re.rEstRec', DB::raw('LPAD(re.rId,"5",0) as codref'), 're.rId', 'essref.descripcion as essref', 'ess.descripcion as ess', DB::raw('date(re.rFecRef) as rFecRef'), 're.rEst',
                DB::raw('null as plazo'), DB::raw('null as pCantDia'), DB::raw('null as fFecRecep')
                , DB::raw('null as fFecRevi'), DB::raw('null as oNombre'), DB::raw('null as oId'),
                DB::raw('null as fRevEst'))
            ->whereIn('re.idEssRef',
                function ($q1) use ($ejec) {
                    $q1->from('eess as ess')
                        ->select('ess.idEess')
                        ->whereIn('ess.idEjecutora',
                            function ($q2) use ($ejec) {
                                $q2->from('ejecutora as ejec')
                                    ->select('ejec.idEjecutora')
                                    ->where(['ejec.idUdr' => $udr->idUdr]);
                            }
                        )->get();

                }
            )
            ->leftJoin('eess as ess', 'ess.idEess', '=', 're.idEess')
            ->leftJoin('eess as essref', 'essref.idEess', '=', 're.idEssRef');


        return $result2 = DB::table('re_ubicacion as u')
            ->select(DB::raw('date(res1.rFecRef) as rFecRef'),'res1.essref', 'res1.ess',DB::raw('LPAD(res1.rId,"5",0) as codref'),
                'res1.rEstRec','res1.rId','u.uId', 'u.rId', 'u.oEId', 'u.fRevEst', 'u.fFecRevi', 'u.fFecRecep', 'u.uUsuReg', 'u.uEst', 'u.uFecCrea',
                DB::raw('(pl.pCantDia - DATEDIFF(NOW(),u.fFecRecep)) as plazo'), 'pl.pCantDia', 'of.oNombre', 'of.oId','res1.rEst'
            )
            ->joinSub($result1, 'res1', function ($join) {
                $join->on('res1.rId', '=', 'u.rId');
            })
            ->join('re_oficina_entidad as oe', 'u.oEId', '=', 'oe.oEid')
            ->join('re_oficina as of', 'of.oId', '=', 'oe.oId')
            ->join('re_plazo as pl', 'pl.pId', '=', 'of.pId')
            ->where([
                'u.uEst'=> 1,
            ])
            ->whereIn('of.oId',[4,5])
            ->get();


    }*/

    public function detalleref($idref)
    {
        return DB::table('re_referencia as re')
            ->select('re.rId', DB::raw("DATE_FORMAT(af.afi_fecnac,'%d-%m-%Y') AS fecnac"),
                DB::raw('TIMESTAMPDIFF(year,af.afi_fecnac, now() ) as edad'),
                DB::raw('case
                        when ess.descripcion is not null then CONCAT("IPRESS - ",ess.descripcion)
                        when ud.nombre is not null then CONCAT("UDR - ",ud.nombre)
                        when r.Descripcion is not null  then CONCAT("RED - ",r.Descripcion)
                         when eje.descripcionEjecutora is not null  then CONCAT("EJEC - ",eje.descripcionEjecutora)
                          when ent.eDesc is not null  then CONCAT("OTROS - ",ent.eDesc)
                        end eper
                        '),
                DB::raw('Concat(mar.mDesc," - ",sm.sMDesc," - ",md.mDesc) as info'),
                DB::raw('concat(perec.apPaterno," ",perec.apMaterno," ",perec.pNombre," ",ifnull(perec.sNombre,"")) as personalrec'),
                DB::raw('concat(peref.apPaterno," ",peref.apMaterno," ",peref.pNombre," ",ifnull(peref.sNombre,"")) as personalref'),
                DB::raw("DATE_FORMAT(re.rFecRef,'%d-%m-%Y %r') AS rFecRef"),
                DB::raw("DATE_FORMAT(re.rFecRetor ,'%d-%m-%Y %r')AS rFecRetor"),
                'af.afi_appaterno', 'af.afi_apmaterno', 'af.afi_nombres', 'af.afi_DNI', 're.rMotRef', 'estp.ePDescripcion',
                //'ci.cDescripcion',, 're.cId'
                'ts.tSDescrip', 're.ePId', 're.afi_DNI', 're.idEess', 'psrec.pId as perecpId', 'psref.pId as perefpId',
                're.vId', 'v.vPlaca', 're.rNroFua', 'es.idEess as es', 'eso.idEess as eso',
                DB::raw('concat(es.Descripcion," - ",ej.descripcionEjecutora) as Descripcionesde'),
                DB::raw('concat(eso.Descripcion," - ",ejo.descripcionEjecutora) as Descripcionesor')
            )
            ->join('re_afiliados as af', 'af.afi_DNI', '=', 're.afi_DNI')
            ->leftJoin('re_personal as psrec', 'psrec.pId', '=', 're.idPerRec')
            ->leftJoin('persona as perec', 'perec.idPersona', '=', 'psrec.idPersona')
            ->leftJoin('re_personal as psref', 'psref.pId', '=', 're.idPerRef')
            ->leftJoin('persona as peref', 'peref.idPersona', '=', 'psref.idPersona')
            /* ->leftJoin('re_personal as ps', 'ps.pId', '=', 're.idPerRec')
             ->leftJoin('persona as pe', 'pe.idPersona', '=', 'ps.idPersona')*/
            ->leftJoin('v_vehiculo as v', 'v.vId', '=', 're.vId')
            ->leftjoin('re_oficina_entidad as oe', 'oe.oEId', '=', 'v.oEId')
            ->leftjoin('re_entidad as ent', 'oe.eId', '=', 'ent.eId')
            ->leftjoin('eess as ess', 'oe.idEess', '=', 'ess.idEess')
            ->leftjoin('red as r', 'oe.idRed', '=', 'r.idRed')
            ->leftjoin('udr as ud', 'oe.idUdr', '=', 'ud.idUdr')
            ->leftjoin('ejecutora as eje', 'oe.idEjecutora', '=', 'eje.idEjecutora')
            ->leftjoin('v_modelo_tipo_vehiculo as mtv', 'mtv.mTVId', '=', 'v.mTVId')
            ->leftjoin('v_modelo as md', 'md.mId', '=', 'mtv.mId')
            ->leftjoin('v_sub_marca as sm', 'md.sMId', '=', 'sm.sMId')
            ->leftjoin('v_marca as mar', 'mar.mId', '=', 'sm.mId')
            ->join('eess as eso', 'eso.idEess', '=', 're.idEssRef')
            ->join('ejecutora as ejo', 'ejo.idEjecutora', '=', 'eso.idEjecutora')
            ->join('eess as es', 'es.idEess', '=', 're.idEess')
            ->join('ejecutora as ej', 'ej.idEjecutora', '=', 'es.idEjecutora')
            ->join('re_est_paciente as estp', 'estp.ePId', '=', 're.ePId')
            ->join('re_pac_tip_segs as pts', 'pts.afi_DNI', '=', 'af.afi_DNI')
            ->join('re_tip_seguro as ts', 'ts.tSId', '=', 'pts.tSId')
            // ->join('re_cie10 as ci', 'ci.cId', '=', 're.cId')
            ->where('re.rId', '=', $idref)
            ->get();
    }

    public static function detallerefpers($idref)
    {
        return DB::table('re_ref_pers as refp')
            ->select(DB::raw('concat(per.apPaterno," ",per.apMaterno," ",per.pNombre," ",ifnull(per.sNombre,"")) as personals'),
                'tp.tPDescripcion', 'refp.rPId', 'refp.pId', 'refp.RId', 'refp.rPEst')
            ->join('re_referencia as ref', 'ref.rId', '=', 'refp.RId')
            ->join('re_personal as p', 'p.pId', '=', 'refp.pId')
            ->join('re_tip_personal as tp', 'tp.tPId', '=', 'p.tPId')
            ->join('persona as per', 'per.idPersona', '=', 'p.idPersona')
            ->where('ref.rId', '=', $idref)
            ->get();
    }

    public static function getidperef($idper, $idref)
    {
        return DB::table('re_ref_pers as refp')
            ->select('refp.rPId')
            ->where('refp.pId', '=', $idper)
            ->where('refp.Rid', '=', $idref)
            ->get();
    }

    public static function pdfViatico($idvi)
    {
        return DB::table('vi_viatico as vi')
            ->select('vi.vId', 'tp.tPDescripcion', DB::raw('concat(p.apPaterno," ",p.apMaterno," ",p.pNombre," ",ifnull(p.sNombre,"")) as personals'),
                DB::raw('case
                        when ess.descripcion is not null then CONCAT("IPRESS - ",ess.descripcion)
                        when ud.nombre is not null then CONCAT("UDR - ",ud.nombre)
                        when r.Descripcion is not null  then CONCAT("RED - ",r.Descripcion)
                         when eje.descripcionEjecutora is not null  then CONCAT("EJEC - ",eje.descripcionEjecutora)
                          when ent.eDesc is not null  then CONCAT("OTROS - ",ent.eDesc)
                        end eper
                        '), DB::raw('sum(cp.cImp) as tot'))
            ->join('re_personal as ps', 'ps.pId', '=', 'vi.pId')
            ->join('re_oficina_entidad as oe', 'oe.oEId', '=', 'ps.oEId')
            ->join('persona as p', 'p.idPersona', '=', 'ps.idPersona')
            ->join('re_tip_personal as tp', 'tp.tPId', '=', 'ps.tPId')
            ->leftjoin('re_entidad as ent', 'oe.eId', '=', 'ent.eId')
            ->leftjoin('eess as ess', 'oe.idEess', '=', 'ess.idEess')
            ->leftjoin('red as r', 'oe.idRed', '=', 'r.idRed')
            ->leftjoin('udr as ud', 'oe.idUdr', '=', 'ud.idUdr')
            ->leftjoin('ejecutora as eje', 'oe.idEjecutora', '=', 'eje.idEjecutora')
            ->leftjoin('vi_comprobantes as cp', 'cp.vId', '=', 'vi.vId')
            ->where('cp.vId', '=', $idvi)
            ->groupBy('vi.vId', 'tp.tPDescripcion', 'p.apPaterno', 'p.apMaterno', 'p.pNombre', 'p.sNombre',
                'ess.descripcion', 'ud.nombre', 'r.Descripcion', 'eje.descripcionEjecutora', 'ent.eDesc')
            ->get();
    }

    public static function pdfViatico1($idvi)
    {
        return DB::table('vi_comprobantes as cp')
            ->select('cp.vId', 'cp.cId', 'cp.cFecha', 'td.tDDes', 'cp.cNroDoc', 'cp.cRazSoc', 'g.gDesc', 'cp.cImp')
            ->join('vi_tipo_doc_gasts as tdg', 'tdg.tDGId', '=', 'cp.tDGId')
            ->join('vi_gastos as g', 'g.gId', '=', 'tdg.gId')
            ->join('vi_tipo_docs as td', 'td.tDId', '=', 'tdg.tDId')
            ->where('cp.vId', '=', $idvi)
            ->groupBy('cp.vId', 'cp.cId', 'cp.cFecha', 'td.tDDes', 'cp.cNroDoc', 'cp.cRazSoc', 'g.gDesc', 'cp.cImp')
            ->get();
    }

    public static function pdfFormtIII($idr)
    {
        return DB::table('re_doc_file as df')
            ->select('vi.vId', 'tp.tPDescripcion', DB::raw('concat(p.apPaterno," ",p.apMaterno," ",p.pNombre," ",ifnull(p.sNombre,"")) as personals'),
                DB::raw('case
                        when ess.descripcion is not null then CONCAT("IPRESS - ",ess.descripcion)
                        when ud.nombre is not null then CONCAT("UDR - ",ud.nombre)
                        when r.Descripcion is not null  then CONCAT("RED - ",r.Descripcion)
                         when eje.descripcionEjecutora is not null  then CONCAT("EJEC - ",eje.descripcionEjecutora)
                          when ent.eDesc is not null  then CONCAT("OTROS - ",ent.eDesc)
                        end eper
                        '), DB::raw('sum(cp.cImp) as tot'))
            ->join('vi_viatico as vi', 'vi.dFId', '=', 'df.dFId')
            ->join('re_referencia as rf', 'rf.rId', '=', 'df.rId')
            ->join('re_personal as ps', 'ps.pId', '=', 'vi.pId')
            ->join('re_oficina_entidad as oe', 'oe.oEId', '=', 'ps.oEId')
            ->join('persona as p', 'p.idPersona', '=', 'ps.idPersona')
            ->join('re_tip_personal as tp', 'tp.tPId', '=', 'ps.tPId')
            ->leftjoin('re_entidad as ent', 'oe.eId', '=', 'ent.eId')
            ->leftjoin('eess as ess', 'oe.idEess', '=', 'ess.idEess')
            ->leftjoin('red as r', 'oe.idRed', '=', 'r.idRed')
            ->leftjoin('udr as ud', 'oe.idUdr', '=', 'ud.idUdr')
            ->leftjoin('ejecutora as eje', 'oe.idEjecutora', '=', 'eje.idEjecutora')
            ->leftjoin('vi_comprobantes as cp', 'cp.vId', '=', 'vi.vId')
            ->where('df.rId', '=', $idr)
            ->where('df.dId', '=', 1)
            ->groupBy('vi.vId', 'tp.tPDescripcion', 'p.apPaterno', 'p.apMaterno', 'p.pNombre', 'p.sNombre',
                'ess.descripcion', 'ud.nombre', 'r.Descripcion', 'eje.descripcionEjecutora', 'ent.eDesc')
            ->get();
    }

    public static function pdfFormtIII1($idr)
    {
        return DB::table('re_doc_file as df')
            ->select('vi.vId', 'cp.cId', 'cp.cFecha', 'td.tDDes', 'cp.cNroDoc', 'cp.cRazSoc', 'g.gDesc', 'cp.cImp')
            ->join('vi_viatico as vi', 'vi.dFId', '=', 'df.dFId')
            ->join('re_referencia as rf', 'rf.rId', '=', 'df.rId')
            ->join('vi_comprobantes as cp', 'cp.vId', '=', 'vi.vId')
            ->join('vi_tipo_doc_gasts as tdg', 'tdg.tDGId', '=', 'cp.tDGId')
            ->join('vi_gastos as g', 'g.gId', '=', 'tdg.gId')
            ->join('vi_tipo_docs as td', 'td.tDId', '=', 'tdg.tDId')
            ->where('df.rId', '=', $idr)
            ->where('df.dId', '=', 1)
            ->groupBy('vi.vId', 'cp.cId', 'cp.cFecha', 'td.tDDes', 'cp.cNroDoc', 'cp.cRazSoc', 'g.gDesc', 'cp.cImp')
            ->get();
    }

    public static function pdfFormtII($idr)
    {
        return DB::table('re_doc_file as df')
            ->select('vi.vId', 'tp.tPDescripcion', 'rf.rMotRef', 'ess.descripcion',
                DB::raw("DATE_FORMAT(rf.rFecRef,'%d/%m/%Y') AS fecsal"),
                DB::raw('year(now())as ano'),
                DB::raw('LPAD(month(now()),"2",0)  as mes'),
                DB::raw('LPAD(day(now()),"2",0)  as dia'),
                DB::raw("DATE_FORMAT(rf.rFecRetor,'%d/%m/%Y') AS fecretor"),
                DB::raw('(abs(datediff(date(rf.rFecRetor),date(rf.rFecRef)))+1) as dias'),
                DB::raw('concat(p.apPaterno," ",p.apMaterno," ",p.pNombre," ",ifnull(p.sNombre,"")) as personals'),
                DB::raw('sum(cp.cImp) as tot'))
            ->join('vi_viatico as vi', 'vi.dFId', '=', 'df.dFId')
            ->join('re_referencia as rf', 'rf.rId', '=', 'df.rId')
            ->join('re_personal as ps', 'ps.pId', '=', 'vi.pId')
            ->join('re_oficina_entidad as oe', 'oe.oEId', '=', 'ps.oEId')
            ->join('persona as p', 'p.idPersona', '=', 'ps.idPersona')
            ->join('re_tip_personal as tp', 'tp.tPId', '=', 'ps.tPId')
            ->leftjoin('re_entidad as ent', 'oe.eId', '=', 'ent.eId')
            ->leftjoin('vi_comprobantes as cp', 'cp.vId', '=', 'vi.vId')
            ->leftjoin('eess as ess', 'ess.idEess', '=', 'rf.idEess')
            ->where('df.rId', '=', $idr)
            ->where('df.dId', '=', 1)
            ->groupBy('vi.vId', 'tp.tPDescripcion', 'p.apPaterno', 'p.apMaterno', 'p.pNombre', 'p.sNombre',
                'ess.descripcion', 'rf.rMotRef', 'rf.rFecRef', 'rf.rFecRetor')
            ->orderBy('cp.vId', 'asc')
            ->get();
    }

    public static function pdfViaticoII($idvi)
    {
        return DB::table('vi_viatico as vi')
            ->select('vi.vId', 'tp.tPDescripcion', 'rf.rMotRef', 'ess.descripcion',
                DB::raw("DATE_FORMAT(rf.rFecRef,'%d/%m/%Y') AS fecsal"),
                DB::raw('year(now())as ano'),
                DB::raw('LPAD(month(now()),"2",0)  as mes'),
                DB::raw('LPAD(day(now()),"2",0)  as dia'),
                DB::raw("DATE_FORMAT(rf.rFecRetor,'%d/%m/%Y') AS fecretor"),
                DB::raw('(abs(datediff(date(rf.rFecRetor),date(rf.rFecRef)))+1) as dias'),
                DB::raw('concat(p.apPaterno," ",p.apMaterno," ",p.pNombre," ",ifnull(p.sNombre,"")) as personals'),
                DB::raw('sum(cp.cImp) as tot'))
            ->join('re_personal as ps', 'ps.pId', '=', 'vi.pId')
            ->join('re_oficina_entidad as oe', 'oe.oEId', '=', 'ps.oEId')
            ->join('persona as p', 'p.idPersona', '=', 'ps.idPersona')
            ->join('re_tip_personal as tp', 'tp.tPId', '=', 'ps.tPId')
            ->leftjoin('re_entidad as ent', 'oe.eId', '=', 'ent.eId')
            ->leftjoin('re_doc_file as df', 'df.dFId', '=', 'vi.dFId')
            ->leftjoin('re_referencia as rf', 'rf.rId', '=', 'df.rId')
            ->leftjoin('vi_comprobantes as cp', 'cp.vId', '=', 'vi.vId')
            ->leftjoin('eess as ess', 'ess.idEess', '=', 'rf.idEess')
            ->where('cp.vId', '=', $idvi)
            ->groupBy('vi.vId', 'tp.tPDescripcion', 'p.apPaterno', 'p.apMaterno', 'p.pNombre', 'p.sNombre',
                'ess.descripcion', 'rf.rMotRef', 'rf.rFecRef', 'rf.rFecRetor')
            ->get();
    }

    public static function pdfFormtII1($idr, $dias)
    {
        DB::select('DROP TABLE IF EXISTS  dato1;');
        DB::select('DROP TABLE IF EXISTS dato2;');
        DB::select('DROP TABLE IF EXISTS dato3;');
        DB::select('CREATE TEMPORARY TABLE dato1
                SELECT vi.vId idv,g.gId id,g.gDesc gasto,sum(cp.cImp) decla,
                       case when g.gCosDia is null then  sum(cp.cImp)
                     when g.gCosDia is not null and g.gId=2  then (' . $dias . '-1)*g.gCosDia
                     when g.gCosDia is not null and g.gId=1 then  ' . $dias . '*g.gCosDia end fondasig,tg.tGId idtg FROM re_doc_file df
                    join vi_viatico vi on vi.dFId=df.dFId
                    join re_referencia rf on rf.rId=df.rId
                    join vi_comprobantes cp on cp.vId=vi.vId
                    join vi_tipo_doc_gasts tdg on tdg.tDGId=cp.tDGId
                    join vi_tipo_docs td on td.tDId=tdg.tDId
                    join vi_gastos g on g.gId=tdg.gId
                    join vi_tipo_gastos tg on tg.tGId=g.tGId
                where df.rId=' . $idr . ' and td.tDId=1 and df.dId=1
                group by  vi.vId,g.gId,g.gDesc ,tg.tGId,g.gCosDia');
        DB::select('CREATE TEMPORARY TABLE dato2
            SELECT vi.vId idv,g.gId id,g.gDesc gasto,sum(cp.cImp) compro,
                   case when g.gCosDia is null then  sum(cp.cImp)
                     when g.gCosDia is not null and g.gId=2  then (' . $dias . '-1)*g.gCosDia
                     when g.gCosDia is not null and g.gId=1 then  ' . $dias . '*g.gCosDia end fondasig,tg.tGId idtg FROM re_doc_file df
                join vi_viatico vi on vi.dFId=df.dFId
                join re_referencia rf on rf.rId=df.rId
                join vi_comprobantes cp on cp.vId=vi.vId
                join vi_tipo_doc_gasts tdg on tdg.tDGId=cp.tDGId
                join vi_tipo_docs td on td.tDId=tdg.tDId
                join vi_gastos g on g.gId=tdg.gId
                join vi_tipo_gastos tg on tg.tGId=g.tGId
            where df.rId=' . $idr . '  and df.dId=1 and(td.tDId=2 or td.tDId=3 or td.tDId=4)
            group by  vi.vId,g.gId,g.gDesc,tg.tGId,g.gCosDia');

        DB::select('CREATE TEMPORARY TABLE dato3
            select cp.vId,g.tGId,g.gDesc,d2.compro,d1.decla,
            case when g.gCosDia is not null and d1.fondasig=d2.fondasig then  0
             when g.gCosDia is not null and d1.fondasig is not null then d1.fondasig end fondasigd,
             case when g.gCosDia is not null and d1.fondasig=d2.fondasig then d2.fondasig
             when g.gCosDia is not null and d2.fondasig is not null then d2.fondasig end fondasigc,sum(cp.cImp) total
            from re_doc_file df
                join vi_viatico vi on vi.dFId=df.dFId
                join re_referencia rf on rf.rId=df.rId
                join vi_comprobantes cp on cp.vId=vi.vId
                join vi_tipo_doc_gasts tdg on tdg.tDGId=cp.tDGId
                join vi_tipo_docs td on td.tDId=tdg.tDId
                join vi_gastos g on g.gId=tdg.gId
                join vi_tipo_gastos tg on tg.tGId=g.tGId
                left join dato1 d1 on d1.idv=vi.vId and d1.id=tdg.gId
                left join dato2 d2 on d2.idv=vi.vId and d2.id=tdg.gId
            where df.rId=' . $idr . ' and df.dId=1
            group by cp.vId,g.tGId,g.gDesc,d2.compro,d1.decla,d1.fondasig,d2.fondasig,g.gCosDia order by cp.vId');
        $data = DB::select('select d3.vId,d3.tGId,d3.gDesc,d3.compro,d3.decla,
            case when d3.fondasigd is null and d3.fondasigc is null then  d3.total
             when d3.fondasigd is null and d3.fondasigc is not null then d3.fondasigc
             when d3.fondasigc is null and d3.fondasigd is not null then d3.fondasigd
             when d3.fondasigc=0 and d3.fondasigd is not null and d3.fondasigd!=0 then d3.fondasigd
             when d3.fondasigd=0 and d3.fondasigc is not null and d3.fondasigc!=0 then d3.fondasigc end fondasig,d3.total
            from dato3 d3
            group by d3.vId,d3.tGId,d3.gDesc,d3.compro,d3.decla,d3.fondasigd,d3.fondasigc,d3.total order by d3.vId');
        return $data;

    }

    public static function pdfFormtII2($idr, $dias)
    {
        DB::select('DROP TABLE IF EXISTS  dato1;');
        DB::select('DROP TABLE IF EXISTS dato2;');
        DB::select('DROP TABLE IF EXISTS dato3;');
        DB::select('DROP TABLE IF EXISTS dato4;');
        DB::select('CREATE TEMPORARY TABLE dato1
                SELECT vi.vId idv,g.gId id,g.gDesc gasto,sum(cp.cImp) decla,
                       case when g.gCosDia is null then  sum(cp.cImp)
                     when g.gCosDia is not null and g.gId=2  then (' . $dias . '-1)*g.gCosDia
                     when g.gCosDia is not null and g.gId=1 then  ' . $dias . '*g.gCosDia end fondasig,tg.tGId idtg FROM re_doc_file df
                    join vi_viatico vi on vi.dFId=df.dFId
                    join re_referencia rf on rf.rId=df.rId
                    join vi_comprobantes cp on cp.vId=vi.vId
                    join vi_tipo_doc_gasts tdg on tdg.tDGId=cp.tDGId
                    join vi_tipo_docs td on td.tDId=tdg.tDId
                    join vi_gastos g on g.gId=tdg.gId
                    join vi_tipo_gastos tg on tg.tGId=g.tGId
                where df.rId=' . $idr . ' and td.tDId=1 and df.dId=1
                group by  vi.vId,g.gId,g.gDesc ,tg.tGId,g.gCosDia');
        DB::select('CREATE TEMPORARY TABLE dato2
            SELECT vi.vId idv,g.gId id,g.gDesc gasto,sum(cp.cImp) compro,
                   case when g.gCosDia is null then  sum(cp.cImp)
                     when g.gCosDia is not null and g.gId=2  then (' . $dias . '-1)*g.gCosDia
                     when g.gCosDia is not null and g.gId=1 then  ' . $dias . '*g.gCosDia end fondasig,tg.tGId idtg FROM re_doc_file df
                join vi_viatico vi on vi.dFId=df.dFId
                join re_referencia rf on rf.rId=df.rId
                join vi_comprobantes cp on cp.vId=vi.vId
                join vi_tipo_doc_gasts tdg on tdg.tDGId=cp.tDGId
                join vi_tipo_docs td on td.tDId=tdg.tDId
                join vi_gastos g on g.gId=tdg.gId
                join vi_tipo_gastos tg on tg.tGId=g.tGId
            where df.rId=' . $idr . '  and df.dId=1 and(td.tDId=2 or td.tDId=3 or td.tDId=4)
            group by  vi.vId,g.gId,g.gDesc,tg.tGId,g.gCosDia');

        DB::select('CREATE TEMPORARY TABLE dato3
            select cp.vId,g.tGId,g.gDesc,d2.compro,d1.decla,
            case when g.gCosDia is not null and d1.fondasig=d2.fondasig then  0
             when g.gCosDia is not null and d1.fondasig is not null then d1.fondasig end fondasigd,
             case when g.gCosDia is not null and d1.fondasig=d2.fondasig then d2.fondasig
             when g.gCosDia is not null and d2.fondasig is not null then d2.fondasig end fondasigc,sum(cp.cImp) total
            from re_doc_file df
                join vi_viatico vi on vi.dFId=df.dFId
                join re_referencia rf on rf.rId=df.rId
                join vi_comprobantes cp on cp.vId=vi.vId
                join vi_tipo_doc_gasts tdg on tdg.tDGId=cp.tDGId
                join vi_tipo_docs td on td.tDId=tdg.tDId
                join vi_gastos g on g.gId=tdg.gId
                join vi_tipo_gastos tg on tg.tGId=g.tGId
                left join dato1 d1 on d1.idv=vi.vId and d1.id=tdg.gId
                left join dato2 d2 on d2.idv=vi.vId and d2.id=tdg.gId
            where df.rId=' . $idr . ' and df.dId=1
            group by cp.vId,g.tGId,g.gDesc,d2.compro,d1.decla,d1.fondasig,d2.fondasig,g.gCosDia order by cp.vId');
        DB::select('CREATE TEMPORARY TABLE dato4
            select d3.vId,d3.tGId,d3.gDesc,d3.compro,d3.decla,
            case when d3.fondasigd is null and d3.fondasigc is null then  d3.total
             when d3.fondasigd is null and d3.fondasigc is not null then d3.fondasigc
             when d3.fondasigc is null and d3.fondasigd is not null then d3.fondasigd
             when d3.fondasigc=0 and d3.fondasigd is not null and d3.fondasigd!=0 then d3.fondasigd
             when d3.fondasigd=0 and d3.fondasigc is not null and d3.fondasigc!=0 then d3.fondasigc end fondasig,d3.total
            from dato3 d3
            group by d3.vId,d3.tGId,d3.gDesc,d3.compro,d3.decla,d3.fondasigd,d3.fondasigc,d3.total order by d3.vId');

        $data = DB::select('select d4.vId,d4.tGId,
            sum(d4.compro) compro,sum(d4.decla) decla,sum(d4.fondasig) subfond,sum(d4.total) total

            from dato4 d4
            group by d4.vId,d4.tGId order by d4.vId');

        return $data;
    }

    public static function pdfViaticoII1($idvi, $dias)
    {
        DB::select('DROP TABLE IF EXISTS  dato1;');
        DB::select('DROP TABLE IF EXISTS dato2;');
        DB::select('DROP TABLE IF EXISTS dato3;');
        DB::select('CREATE TEMPORARY TABLE dato1
                SELECT cp.vId idv,g.gId id,g.gDesc gasto,sum(cp.cImp) decla,
                case when g.gCosDia is null then  sum(cp.cImp)
                     when g.gCosDia is not null and g.gId=2  then (' . $dias . '-1)*g.gCosDia
                     when g.gCosDia is not null and g.gId=1 then  ' . $dias . '*g.gCosDia end fondasig,tg.tGId idtg FROM vi_comprobantes cp
                    join vi_tipo_doc_gasts tdg on tdg.tDGId=cp.tDGId
                    join vi_tipo_docs td on td.tDId=tdg.tDId
                    join vi_gastos g on g.gId=tdg.gId
                    join vi_tipo_gastos tg on tg.tGId=g.tGId
                where cp.vId=' . $idvi . ' and td.tDId=1
                group by  cp.vId,g.gId,g.gDesc,tg.tGId,g.gCosDia ;
              ');
        DB::select('CREATE TEMPORARY TABLE dato2
            SELECT cp.vId idv,g.gId id,g.gDesc gasto,sum(cp.cImp) compro,
            case when g.gCosDia is null then  sum(cp.cImp)
                     when g.gCosDia is not null and g.gId=2  then (' . $dias . '-1)*g.gCosDia
                     when g.gCosDia is not null and g.gId=1 then  ' . $dias . '*g.gCosDia end fondasig,tg.tGId idtg FROM vi_comprobantes cp
            join vi_tipo_doc_gasts tdg on tdg.tDGId=cp.tDGId
            join vi_tipo_docs td on td.tDId=tdg.tDId
            join vi_gastos g on g.gId=tdg.gId
            join vi_tipo_gastos tg on tg.tGId=g.tGId
            where cp.vId=' . $idvi . '  and(td.tDId=2 or td.tDId=3 or td.tDId=4)
            group by  cp.vId,g.gId,g.gDesc,tg.tGId,g.gCosDia ;');
        DB::select('CREATE TEMPORARY TABLE dato3
            select cp.vId,g.tGId,g.gDesc,d2.compro,d1.decla,
            case when g.gCosDia is not null and d1.fondasig=d2.fondasig then  0
             when g.gCosDia is not null and d1.fondasig is not null then d1.fondasig end fondasigd,
             case when g.gCosDia is not null and d1.fondasig=d2.fondasig then d2.fondasig
             when g.gCosDia is not null and d2.fondasig is not null then d2.fondasig end fondasigc,sum(cp.cImp) total
            from vi_comprobantes cp
            join vi_tipo_doc_gasts tdg on tdg.tDGId=cp.tDGId
            join vi_tipo_docs td on td.tDId=tdg.tDId
            join vi_gastos g on g.gId=tdg.gId
            join vi_tipo_gastos tg on tg.tGId=g.tGId
            left join dato1 d1 on d1.idv=cp.vId and d1.id=tdg.gId
            left join dato2 d2 on d2.idv=cp.vId and d2.id=tdg.gId
            where cp.vId=' . $idvi . '
            group by cp.vId,g.tGId,g.gDesc,d2.compro,d1.decla,d1.fondasig,d2.fondasig,g.gCosDia order by cp.vId');
        $data = DB::select('select d3.vId,d3.tGId,d3.gDesc,d3.compro,d3.decla,
            case when d3.fondasigd is null and d3.fondasigc is null then  d3.total
             when d3.fondasigd is null and d3.fondasigc is not null then d3.fondasigc
             when d3.fondasigc is null and d3.fondasigd is not null then d3.fondasigd
             when d3.fondasigc=0 and d3.fondasigd is not null and d3.fondasigd!=0 then d3.fondasigd
             when d3.fondasigd=0 and d3.fondasigc is not null and d3.fondasigc!=0 then d3.fondasigc end fondasig,d3.total
            from dato3 d3
            group by d3.vId,d3.tGId,d3.gDesc,d3.compro,d3.decla,d3.fondasigd,d3.fondasigc,d3.total order by d3.vId');
        return $data;

    }

    public static function pdfViaticoII2($idvi, $dias)
    {
        DB::select('DROP TABLE IF EXISTS  dato1;');
        DB::select('DROP TABLE IF EXISTS dato2;');
        DB::select('DROP TABLE IF EXISTS dato3;');
        DB::select('DROP TABLE IF EXISTS dato4;');
        DB::select('CREATE TEMPORARY TABLE dato1
                SELECT cp.vId idv,g.gId id,g.gDesc gasto,sum(cp.cImp) decla,
                case when g.gCosDia is null then  sum(cp.cImp)
                     when g.gCosDia is not null and g.gId=2  then (' . $dias . '-1)*g.gCosDia
                     when g.gCosDia is not null and g.gId=1 then  ' . $dias . '*g.gCosDia end fondasig,tg.tGId idtg FROM vi_comprobantes cp
                    join vi_tipo_doc_gasts tdg on tdg.tDGId=cp.tDGId
                    join vi_tipo_docs td on td.tDId=tdg.tDId
                    join vi_gastos g on g.gId=tdg.gId
                    join vi_tipo_gastos tg on tg.tGId=g.tGId
                where cp.vId=' . $idvi . ' and td.tDId=1
                group by  cp.vId,g.gId,g.gDesc,tg.tGId,g.gCosDia ;
              ');
        DB::select('CREATE TEMPORARY TABLE dato2
            SELECT cp.vId idv,g.gId id,g.gDesc gasto,sum(cp.cImp) compro,
            case when g.gCosDia is null then  sum(cp.cImp)
                     when g.gCosDia is not null and g.gId=2  then (' . $dias . '-1)*g.gCosDia
                     when g.gCosDia is not null and g.gId=1 then  ' . $dias . '*g.gCosDia end fondasig,tg.tGId idtg FROM vi_comprobantes cp
            join vi_tipo_doc_gasts tdg on tdg.tDGId=cp.tDGId
            join vi_tipo_docs td on td.tDId=tdg.tDId
            join vi_gastos g on g.gId=tdg.gId
            join vi_tipo_gastos tg on tg.tGId=g.tGId
            where cp.vId=' . $idvi . '  and(td.tDId=2 or td.tDId=3 or td.tDId=4)
            group by  cp.vId,g.gId,g.gDesc,tg.tGId,g.gCosDia ;');
        DB::select('CREATE TEMPORARY TABLE dato3
            select cp.vId,g.tGId,g.gDesc,d2.compro,d1.decla,
            case when g.gCosDia is not null and d1.fondasig=d2.fondasig then  0
             when g.gCosDia is not null and d1.fondasig is not null then d1.fondasig end fondasigd,
             case when g.gCosDia is not null and d1.fondasig=d2.fondasig then d2.fondasig
             when g.gCosDia is not null and d2.fondasig is not null then d2.fondasig end fondasigc,sum(cp.cImp) total
            from vi_comprobantes cp
            join vi_tipo_doc_gasts tdg on tdg.tDGId=cp.tDGId
            join vi_tipo_docs td on td.tDId=tdg.tDId
            join vi_gastos g on g.gId=tdg.gId
            join vi_tipo_gastos tg on tg.tGId=g.tGId
            left join dato1 d1 on d1.idv=cp.vId and d1.id=tdg.gId
            left join dato2 d2 on d2.idv=cp.vId and d2.id=tdg.gId
            where cp.vId=' . $idvi . '
            group by cp.vId,g.tGId,g.gDesc,d2.compro,d1.decla,d1.fondasig,d2.fondasig,g.gCosDia order by cp.vId');
        DB::select('CREATE TEMPORARY TABLE dato4
            select d3.vId,d3.tGId,d3.gDesc,d3.compro,d3.decla,
            case when d3.fondasigd is null and d3.fondasigc is null then  d3.total
             when d3.fondasigd is null and d3.fondasigc is not null then d3.fondasigc
             when d3.fondasigc is null and d3.fondasigd is not null then d3.fondasigd
             when d3.fondasigc=0 and d3.fondasigd is not null and d3.fondasigd!=0 then d3.fondasigd
             when d3.fondasigd=0 and d3.fondasigc is not null and d3.fondasigc!=0 then d3.fondasigc end fondasig,d3.total
            from dato3 d3
            group by d3.vId,d3.tGId,d3.gDesc,d3.compro,d3.decla,d3.fondasigd,d3.fondasigc,d3.total order by d3.vId');

        $data = DB::select('select d4.vId,d4.tGId,
            sum(d4.compro) compro,sum(d4.decla) decla,sum(d4.fondasig) subfond,sum(d4.total) total

            from dato4 d4
            group by d4.vId,d4.tGId order by d4.vId');
        return $data;

    }

    public static function pdfOficio($idr)
    {
        $viaticos = DB::table('re_doc_file as df')
            ->select('rf.rId',
                DB::raw('sum(cp.cImp) as viati'))
            ->leftjoin('vi_viatico as vi', 'vi.dFId', '=', 'df.dFId')
            ->leftjoin('vi_comprobantes as cp', 'cp.vId', 'vi.vId')
            ->leftjoin('re_referencia as rf', 'rf.rId', 'df.rId')
            ->leftjoin('vi_tipo_doc_gasts as tdg', 'tdg.tDGId', 'cp.tDGId')
            ->leftjoin('vi_gastos as g', 'g.gId', 'tdg.gId')
            ->join('vi_tipo_gastos as tg', 'tg.tGId', 'g.tGId')
            ->where(['df.rId' => $idr, 'tg.tGId' => 1])
            ->groupBy('rf.rId');
        $pasaj = DB::table('re_doc_file as df')
            ->select('rf.rId',
                DB::raw('sum(cp.cImp) as pasaj'))
            ->leftjoin('vi_viatico as vi', 'vi.dFId', '=', 'df.dFId')
            ->leftjoin('vi_comprobantes as cp', 'cp.vId', 'vi.vId')
            ->leftjoin('re_referencia as rf', 'rf.rId', 'df.rId')
            ->leftjoin('vi_tipo_doc_gasts as tdg', 'tdg.tDGId', 'cp.tDGId')
            ->leftjoin('vi_gastos as g', 'g.gId', 'tdg.gId')
            ->join('vi_tipo_gastos as tg', 'tg.tGId', 'g.tGId')
            ->where(['df.rId' => $idr, 'tg.tGId' => 2])
            ->groupBy('rf.rId');
        $pasajes = DB::table('re_doc_file as df')
            ->select('rf.rId', 'viaticos.viati', 'pasajes.pasaj', 'vh.vPlaca',
                DB::raw('concat(2,"-",afi.afi_DNI) as nafilia'),
                //DB::raw('concat(pts.tSId,"-",afi.afi_DNI) as nafilia'),
                DB::raw('LPAD(rf.rId,"5",0) as codref'),
                'es.descripcion as estorig', 'rf.rMotRef', 'ess.descripcion as estdesti', 'rf.rNroFua',
                DB::raw("DATE_FORMAT(rf.rFecRef,'%d/%m/%Y') AS fecsal"),
                DB::raw('year(now())as ano'),
                DB::raw('LPAD(month(now()),"2",0)  as mes'),
                DB::raw('LPAD(day(now()),"2",0)  as dia'),
                DB::raw("DATE_FORMAT(rf.rFecRetor,'%d/%m/%Y') AS fecretor"),
                DB::raw('TIMESTAMPDIFF(day,rf.rFecRef, rf.rFecRetor ) as dias'),
                DB::raw('concat(afi.afi_appaterno," ",afi.afi_apmaterno," ",afi.afi_nombres) as afiliado'),
                DB::raw('concat(p.apPaterno," ",p.apMaterno," ",p.pNombre," ",ifnull(p.sNombre,"")) as perref'),
                DB::raw('TIMESTAMPDIFF(year,afi.afi_fecnac, now() ) as edad'))
            ->leftjoin('vi_viatico as vi', 'vi.dFId', '=', 'df.dFId')
            ->leftjoin('vi_comprobantes as cp', 'cp.vId', 'vi.vId')
            ->leftjoin('re_referencia as rf', 'rf.rId', 'df.rId')
            ->leftjoin('v_vehiculo as vh', 'vh.vId', 'rf.vId')
            ->leftjoinSub($viaticos, 'viaticos', function ($join) {
                $join->on('rf.rId', '=', 'viaticos.rId');
            })
            ->leftjoinSub($pasaj, 'pasajes', function ($join) {
                $join->on('rf.rId', '=', 'pasajes.rId');
            })
            ->leftjoin('vi_tipo_doc_gasts as tdg', 'tdg.tDGId', 'cp.tDGId')
            ->leftjoin('vi_gastos as g', 'g.gId', 'tdg.gId')
            ->leftjoin('vi_tipo_gastos as tg', 'tg.tGId', 'g.tGId')
            ->leftjoin('re_afiliados as afi', 'rf.afi_DNI', '=', 'afi.afi_DNI')
            ->leftjoin('re_pac_tip_segs as pts', 'pts.afi_DNI', '=', 'afi.afi_DNI')
            ->leftjoin('eess as ess', 'ess.idEess', '=', 'rf.idEess')
            ->leftjoin('eess as es', 'es.idEess', '=', 'rf.idEssRef')
            ->leftjoin('re_personal as ps', 'ps.pId', '=', 'rf.idPerRef')
            ->leftjoin('persona as p', 'p.idPersona', '=', 'ps.idPersona')
            ->where(['df.rId' => $idr])
            ->groupBy('rf.rId', 'es.descripcion', 'afi.afi_appaterno', 'afi.afi_apmaterno', 'afi.afi_nombres',
                'ess.descripcion', 'rf.rMotRef', 'rf.rFecRef', 'rf.rFecRetor', 'afi.afi_fecnac', 'viaticos.viati',
                'rf.rNroFua', 'pts.tSId', 'afi.afi_DNI', 'pasajes.pasaj', 'vh.vPlaca', 'p.apPaterno', 'p.apMaterno', 'p.pNombre', 'p.sNombre')->get();
        return $pasajes;
    }

    public static function pdfInforme($idr)
    {
        $pasajes = DB::table('re_doc_file as df')
            ->select('rf.rId', 'vh.vPlaca', 'pv.descripcion as provdest', 'pvc.descripcion as provorig',
                DB::raw('concat(2,"-",afi.afi_DNI) as nafilia'),
                //DB::raw('concat(pts.tSId,"-",afi.afi_DNI) as nafilia'),
                DB::raw('LPAD(rf.rId,"5",0) as codref'),
                'es.descripcion as estorig', 'rf.rMotRef', 'ess.descripcion as estdesti', 'rf.rNroFua',
                DB::raw("DATE_FORMAT(rf.rFecRef,'%d/%m/%Y') AS fecsal"),
                DB::raw('year(now())as ano'),
                DB::raw('LPAD(month(now()),"2",0)  as mes'),
                DB::raw('LPAD(day(now()),"2",0)  as dia'),
                DB::raw("DATE_FORMAT(rf.rFecRetor,'%d/%m/%Y') AS fecretor"),
                DB::raw('TIMESTAMPDIFF(day,rf.rFecRef, rf.rFecRetor ) as dias'),
                DB::raw('concat(afi.afi_appaterno," ",afi.afi_apmaterno," ",afi.afi_nombres) as afiliado'),
                DB::raw('TIMESTAMPDIFF(year,afi.afi_fecnac, now() ) as edad'))
            ->leftjoin('vi_viatico as vi', 'vi.dFId', '=', 'df.dFId')
            ->leftjoin('vi_comprobantes as cp', 'cp.vId', 'vi.vId')
            ->leftjoin('re_referencia as rf', 'rf.rId', 'df.rId')
            ->leftjoin('v_vehiculo as vh', 'vh.vId', 'rf.vId')
            ->leftjoin('vi_tipo_doc_gasts as tdg', 'tdg.tDGId', 'cp.tDGId')
            ->leftjoin('vi_gastos as g', 'g.gId', 'tdg.gId')
            ->leftjoin('vi_tipo_gastos as tg', 'tg.tGId', 'g.tGId')
            ->leftjoin('re_afiliados as afi', 'rf.afi_DNI', '=', 'afi.afi_DNI')
            ->leftjoin('re_pac_tip_segs as pts', 'pts.afi_DNI', '=', 'afi.afi_DNI')
            ->leftjoin('eess as ess', 'ess.idEess', '=', 'rf.idEess')
            ->leftjoin('eess as es', 'es.idEess', '=', 'rf.idEssRef')
            ->leftjoin('distrito as ds', 'ds.idDistrito', '=', 'ess.idDistrito')
            ->leftjoin('distrito as dt', 'dt.idDistrito', '=', 'es.idDistrito')
            ->leftjoin('provincia as pv', 'pv.idProvincia', '=', 'ds.idProvincia')
            ->leftjoin('provincia as pvc', 'pvc.idProvincia', '=', 'dt.idProvincia')
            ->where(['df.rId' => $idr])
            ->groupBy('rf.rId', 'es.descripcion', 'afi.afi_appaterno', 'afi.afi_apmaterno', 'afi.afi_nombres',
                'ess.descripcion', 'rf.rMotRef', 'rf.rFecRef', 'rf.rFecRetor', 'afi.afi_fecnac',
                'rf.rNroFua', 'pts.tSId', 'afi.afi_DNI', 'vh.vPlaca', 'pv.descripcion', 'pvc.descripcion')->get();
        return $pasajes;
    }

    public static function pdfOficio1($idr)
    {
        return DB::table('re_referencia as rf')
            ->select('rf.rId', 'tp.tPDescripcion',
                DB::raw('concat(p.apPaterno," ",p.apMaterno," ",p.pNombre," ",ifnull(p.sNombre,"")) as personals'))
            ->leftjoin('re_ref_pers as rps', 'rps.RId', '=', 'rf.rId')
            ->leftjoin('re_personal as ps', 'ps.pId', '=', 'rps.pId')
            ->leftjoin('persona as p', 'p.idPersona', '=', 'ps.idPersona')
            ->leftjoin('eess as ess', 'ess.idEess', '=', 'rf.idEess')
            ->leftjoin('eess as es', 'es.idEess', '=', 'rf.idEssRef')
            ->leftjoin('re_tip_personal as tp', 'tp.tPId', '=', 'ps.tPId')
            ->where('rf.rId', '=', $idr)
            ->where('rps.rPEst', '=', 1)
            ->groupBy('rf.rId', 'p.apPaterno', 'p.apMaterno', 'p.pNombre', 'p.sNombre', 'tp.tPDescripcion')
            ->get();
    }

    public static function pdfFormtI($idr)
    {
        return DB::table('re_doc_file as df')
            ->select('vi.vId', 'tp.tPDescripcion', 'rf.rMotRef', 'ess.descripcion',
                DB::raw('case
                        when eess.descripcion is not null then eess.descripcion
                        when ud.nombre is not null then ud.nombre
                        when r.Descripcion is not null  then r.Descripcion
                         when eje.descripcionEjecutora is not null  then eje.descripcionEjecutora
                          when ent.eDesc is not null  then ent.eDesc
                        end unidorg
                        '),
                DB::raw("DATE_FORMAT(rf.rFecRef,'%d-%m-%Y') AS fecsal"),
                DB::raw('year(now())as ano'),
                DB::raw('LPAD(month(now()),"2",0)  as mes'),
                DB::raw('LPAD(day(now()),"2",0)  as dia'),
                DB::raw("DATE_FORMAT(rf.rFecRetor,'%d-%m-%Y') AS fecretor"),
                DB::raw('TIMESTAMPDIFF(day,rf.rFecRef, rf.rFecRetor ) as dias'),
                DB::raw('concat(p.apPaterno," ",p.apMaterno," ",p.pNombre," ",ifnull(p.sNombre,"")) as personals'),
                DB::raw('sum(cp.cImp) as tot'))
            ->join('vi_viatico as vi', 'vi.dFId', '=', 'df.dFId')
            ->join('re_referencia as rf', 'rf.rId', '=', 'df.rId')
            ->join('re_personal as ps', 'ps.pId', '=', 'vi.pId')
            ->join('re_oficina_entidad as oe', 'oe.oEId', '=', 'ps.oEId')
            ->join('persona as p', 'p.idPersona', '=', 'ps.idPersona')
            ->join('re_tip_personal as tp', 'tp.tPId', '=', 'ps.tPId')
            ->leftjoin('re_entidad as ent', 'oe.eId', '=', 'ent.eId')
            ->leftjoin('vi_comprobantes as cp', 'cp.vId', '=', 'vi.vId')
            ->leftjoin('eess as ess', 'ess.idEess', '=', 'rf.idEess')
            ->leftjoin('eess as eess', 'oe.idEess', '=', 'eess.idEess')
            ->leftjoin('red as r', 'oe.idRed', '=', 'r.idRed')
            ->leftjoin('udr as ud', 'oe.idUdr', '=', 'ud.idUdr')
            ->leftjoin('ejecutora as eje', 'oe.idEjecutora', '=', 'eje.idEjecutora')
            ->where('df.rId', '=', $idr)
            ->where('df.dId', '=', 1)
            ->groupBy('vi.vId', 'tp.tPDescripcion', 'p.apPaterno', 'p.apMaterno', 'p.pNombre', 'p.sNombre',
                'ess.descripcion', 'rf.rMotRef', 'rf.rFecRef', 'rf.rFecRetor', 'eess.descripcion',
                'ud.nombre', 'r.Descripcion', 'eje.descripcionEjecutora', 'ent.eDesc')
            ->orderBy('cp.vId', 'asc')
            ->get();
    }

    public static function pdfFormReembols($idr)
    {
        return DB::table('re_referencia as r')
            ->select('r.rNroFua', 'r.rMotRef', 'eess.descripcion as ipresorig',
                'ess.descripcion as ipresdest', 'vh.vPlaca', 'm.mDesc', 'tc.tCDesc',
                DB::raw('substring_index(r.rNroFua,2,-3) as fua'),
                DB::raw('concat(2,"-",af.afi_DNI) as codafi'),
                //DB::raw('concat(pts.tSId,"-",af.afi_DNI) as codafi'),
                DB::raw('concat(d.descripcion,"-",ds.descripcion,"-",d.descripcion) as recorr'),
                DB::raw("DATE_FORMAT(af.afi_fecnac,'%d/%m/%Y') AS fecnac"),
                DB::raw("DATE_FORMAT(r.rFecRef,'%d/%m/%Y') AS fecsal"),
                DB::raw("DATE_FORMAT(r.rFecRef,'%H:%i') AS hora"),
                DB::raw("DATE_FORMAT(now(),'%d/%m/%Y') AS fecact"),
                DB::raw("replace(ltrim(replace(eess.codigoRenaes,'0',' ')),' ','0') as codrena"),
                DB::raw('LPAD(month(now()),"2",0)  as mes'),
                DB::raw('LPAD(day(now()),"2",0)  as dia'),
                DB::raw("DATE_FORMAT(r.rFecRetor,'%d-%m-%Y') AS fecretor"),
                DB::raw('TIMESTAMPDIFF(day,r.rFecRef, r.rFecRetor ) as dias'),
                DB::raw('concat(af.afi_nombres," ",af.afi_appaterno," ",af.afi_apmaterno) as afiliado'),
                DB::raw('TIMESTAMPDIFF(year,af.afi_fecnac, now() ) as edad'))
            ->join('re_afiliados as af', 'af.afi_DNI', '=', 'r.afi_DNI')
            ->join('re_pac_tip_segs as pts', 'af.afi_DNI', '=', 'pts.afi_DNI')
            ->leftjoin('eess as ess', 'ess.idEess', '=', 'r.idEess')
            ->leftjoin('eess as eess', 'eess.idEess', '=', 'r.idEssRef')
            ->leftjoin('distrito as ds', 'ds.idDistrito', '=', 'ess.idDistrito')
            ->leftjoin('distrito as d', 'd.idDistrito', '=', 'eess.idDistrito')
            ->leftjoin('v_vehiculo as vh', 'vh.vId', '=', 'r.vId')
            ->leftjoin('v_modelo_tipo_vehiculo as mtv', 'mtv.mTVId', '=', 'vh.mTVId')
            ->leftjoin('v_modelo as md', 'md.mId', '=', 'mtv.mId')
            ->leftjoin('v_tipo_combustible as tc', 'tc.tCId', '=', 'md.tCId')
            ->leftjoin('v_sub_marca as sm', 'sm.sMId', '=', 'md.sMId')
            ->leftjoin('v_marca as m', 'm.mId', '=', 'sm.mId')
            ->where('r.rId', '=', $idr)
            ->groupBy('r.rId', 'pts.tSId', 'af.afi_DNI', 'eess.codigoRenaes', 'r.rFecRef', 'tc.tCDesc',
                'r.rFecRetor', 'af.afi_nombres', 'af.afi_appaterno', 'af.afi_apmaterno', 'af.afi_fecnac',
                'r.rNroFua', 'r.rMotRef', 'eess.descripcion', 'ess.descripcion', 'vh.vPlaca', 'm.mDesc', 'd.descripcion', 'ds.descripcion')
            ->orderBy('r.rId', 'asc')
            ->get();
    }

    public static function pdfCie10($idr)
    {
        return DB::table('re_diagnostico as dg')
            ->select('ci.cCodigo', 'ci.cDescripcion')
            ->join('re_cie10 as ci', 'ci.cId', '=', 'dg.cId')
            ->where('dg.rId', '=', $idr)
            ->where('dg.dNEst', '=', 1)
            ->groupBy('ci.cCodigo', 'dg.dNId', 'ci.cDescripcion')
            ->orderBy('dg.dNId', 'asc')
            ->get();
    }

    public static function nroDocRev($idr)
    {
        return DB::table('re_revision as rv')
            ->select(DB::raw('count(rv.rId) as nro'))
            ->join('re_ubicacion as u', 'u.uId', '=', 'rv.uId')
            ->join('re_doc_file as df', 'df.dFId', '=', 'rv.dFId')
            ->where('rv.rEstRev', '=', 1)
            ->where('u.rId', '=', $idr)
            ->where('rv.rEst', '=', 1)
            ->where('u.uEst', '=', 1)
            ->where('df.dFEst', '=', 1)
            ->whereIn('df.dId', [2, 3, 4, 5, 6, 9, 10, 11, 12, 13, 14, 18])
            ->get();
    }

    public static function pdfFormtI1($idr, $dias)
    {
        DB::select('CREATE TEMPORARY TABLE dato1
                SELECT vi.vId idv,g.gId idg,g.gDesc gast,g.gCosDia cosxdia,tg.tGId idtg,
                     case when g.gId=2  then (' . $dias . '-1)
                     when g.gId=1 then  ' . $dias . '
                     when g.gId=3 then  ' . $dias . ' end dias,
                     case when g.gCosDia is null then  sum(cp.cImp)
                     when g.gCosDia is not null and g.gId=2  then (' . $dias . '-1)*g.gCosDia
                     when g.gCosDia is not null and g.gId=1 then  ' . $dias . '*g.gCosDia end decla FROM re_doc_file df
                    join vi_viatico vi on vi.dFId=df.dFId
                    join re_referencia rf on rf.rId=df.rId
                    left join vi_comprobantes cp on cp.vId=vi.vId
                    left join vi_tipo_doc_gasts tdg on tdg.tDGId=cp.tDGId
                    left join vi_tipo_docs td on td.tDId=tdg.tDId
                    left join vi_gastos g on g.gId=tdg.gId
                    left join vi_tipo_gastos tg on tg.tGId=g.tGId
                where df.rId=' . $idr . ' and df.dId=1
                group by  vi.vId,tg.tGId,g.gCosDia,g.gId,g.gDesc');
        $data = DB::select('select d1.idv,d1.idtg,d1.idg,d1.gast,d1.cosxdia,d1.dias,d1.decla
            from dato1 d1');
        return $data;
    }
}
