<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class VModeloTipoVehiculo extends Model
{
    protected $table = 'v_modelo_tipo_vehiculo';
    public $primaryKey = 'mTVId';
    public $timestamps = false;


    public function getTipoVehiculoId($idModelo)
    {
      return  DB::table('v_modelo_tipo_vehiculo as mtv')->select('*')
            ->join('v_tipo_vehiculo as tv', 'tv.tVId', '=', 'mtv.tVId')
            ->where('mId', $idModelo)->get();
    }
    public static function getModelTipVehic()
    {
        return DB::table('v_modelo_tipo_vehiculo as mtv')
            ->select('mtv.mTVId','md.mDesc as model','tv.tVDesc', 'sm.sMDesc','m.mDesc','tc.tCDesc','mtv.mTVEst',
                DB::raw("DATE_FORMAT(mtv.mTVFecCrea,'%d-%m-%Y') AS mTVFecCrea"),
                'mtv.tVId','mtv.mId','us.name as uname')
            ->join('v_modelo as md', 'md.mId', '=', 'mtv.mId')
            ->join('v_tipo_vehiculo as tv', 'tv.tVId', '=', 'mtv.tVId')
            ->join('v_sub_marca as sm','sm.sMId','=','md.sMId')
            ->join('v_marca as m', 'm.mId', '=', 'sm.mId')
            ->join('v_tipo_combustible as tc', 'tc.tCId', '=', 'md.tCId')
            ->join('users as us', 'us.id', '=', 'mtv.mTVUsuReg')
            ->orderby('mtv.mTVFecCrea', 'desc')->get();

    }
}
