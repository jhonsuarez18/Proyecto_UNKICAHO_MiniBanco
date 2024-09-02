<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class VVehiculo extends Model
{
    protected $table = 'v_vehiculo';
    public $primaryKey = 'vId';
    public $timestamps = false;

    public function showVehiculo()
    {
        return $table = DB::table('v_vehiculo as v')->SELECT('*', DB::raw('case
                        when es.descripcion is not null then CONCAT("IPRESS - ",es.descripcion)
                        when ud.nombre is not null then CONCAT("UDR - ",ud.nombre)
                        when re.Descripcion is not null  then CONCAT("RED - ",re.Descripcion)
                         when ej.descripcionEjecutora is not null  then CONCAT("EJEC - ",ej.descripcionEjecutora)
                          when ent.eDesc is not null  then CONCAT("OTROS - ",ent.eDesc)
                        end eper
                        '), 'm.mId as moId', 'm.mDesc as moDesc')
            ->join('v_modelo_tipo_vehiculo as mtv', 'v.mTVId', '=', 'mtv.mTVId')
            ->join('v_tipo_vehiculo as tv', 'tv.tVId', '=', 'mtv.tVId')
            ->join('v_modelo as m', 'm.mId', '=', 'mtv.mId')
            ->join('v_sub_marca as sm', 'sm.sMId', '=', 'm.sMId')
            ->join('v_marca as ma', 'ma.mId', '=', 'sm.mId')
            ->Join('re_oficina_entidad as oe', 'oe.oEId', '=', 'v.oEId')
            ->leftJoin('eess as es', 'oe.idEess', '=', 'es.idEess')
            ->leftJoin('udr as ud', 'oe.idUdr', '=', 'ud.idUdr')
            ->leftJoin('red as re', 'oe.idRed', '=', 're.idRed')
            ->leftJoin('ejecutora as ej', 'oe.idEjecutora', '=', 'ej.idEjecutora')
            ->leftJoin('re_entidad as ent', 'oe.eId', '=', 'ent.eId')->get();


    }

    public function showVehiculoEdit($id)
    {
        return $table = DB::table('v_vehiculo as v')->SELECT('*', DB::raw('case
                         when es.descripcion is not null then es.descripcion
                        when ud.nombre is not null then ud.nombre
                        when re.Descripcion is not null  then re.Descripcion
                         when ej.descripcionEjecutora is not null  then ej.descripcionEjecutora
                         when ent.eDesc is not null  then ent.eDesc
                        end eper
                        '), 'm.mId as moId', 'm.mDesc as moDesc')
            ->join('v_modelo_tipo_vehiculo as mtv', 'v.mTVId', '=', 'mtv.mTVId')
            ->join('v_tipo_vehiculo as tv', 'tv.tVId', '=', 'mtv.tVId')
            ->join('v_modelo as m', 'm.mId', '=', 'mtv.mId')
            ->join('v_sub_marca as sm', 'sm.sMId', '=', 'm.sMId')
            ->join('v_marca as ma', 'ma.mId', '=', 'sm.mId')
            ->Join('re_oficina_entidad as oe', 'oe.oEId', '=', 'v.oEId')
            ->leftJoin('eess as es', 'oe.idEess', '=', 'es.idEess')
            ->leftJoin('udr as ud', 'oe.idUdr', '=', 'ud.idUdr')
            ->leftJoin('red as re', 'oe.idRed', '=', 're.idRed')
            ->leftJoin('ejecutora as ej', 'oe.idEjecutora', '=', 'ej.idEjecutora')
            ->leftJoin('re_entidad as ent', 'oe.eId', '=', 'ent.eId')
            ->where([
                //  'v.vEst' => 1, 'mtv.mTVEst' => 1, 'tv.tVEst' => 1, 'm.mEst' => 1, 'sm.sMEst' => 1,
                // 'ma.mEst' => 1,
                'v.vId' => $id])->get();


    }

    public static function getVehiPlaca($plc)
    {
        return DB::table('v_vehiculo as v')->select(
            DB::raw('case
                        when es.descripcion is not null then CONCAT("IPRESS - ",es.descripcion)
                        when ud.nombre is not null then CONCAT("UDR - ",ud.nombre)
                        when re.Descripcion is not null  then CONCAT("RED - ",re.Descripcion)
                         when ej.descripcionEjecutora is not null  then CONCAT("EJEC - ",ej.descripcionEjecutora)
                          when ent.eDesc is not null  then CONCAT("OTROS - ",ent.eDesc)
                        end eper
                        '), 'v.vId', 'v.vConKil', DB::raw('Concat(mar.mDesc," - ",sm.sMDesc," - ",md.mDesc) as info')
        )
            ->join('re_oficina_entidad as oe', 'oe.oEId', '=', 'v.oEId')
            ->leftjoin('re_entidad as ent', 'oe.eId', '=', 'ent.eId')
            ->leftjoin('eess as es', 'oe.idEess', '=', 'es.idEess')
            ->leftjoin('red as re', 'oe.idRed', '=', 're.idRed')
            ->leftjoin('udr as ud', 'oe.idUdr', '=', 'ud.idUdr')
            ->leftjoin('ejecutora as ej', 'oe.idEjecutora', '=', 'ej.idEjecutora')
            ->leftjoin('v_modelo_tipo_vehiculo as mtv', 'mtv.mTVId', '=', 'v.mTVId')
            ->join('v_modelo as md', 'md.mId', '=', 'mtv.mId')
            ->join('v_sub_marca as sm', 'md.sMId', '=', 'sm.sMId')
            ->join('v_marca as mar', 'mar.mId', '=', 'sm.mId')
            ->where('v.vPlaca', '=', $plc)
            ->where('v.vEst', '=', 1)
            ->get();
    }
}
