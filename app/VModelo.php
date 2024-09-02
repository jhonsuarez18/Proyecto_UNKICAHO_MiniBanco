<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class VModelo extends Model
{
    protected $table = 'v_modelo';
    public $primaryKey = 'mId';
    public $timestamps = false;

   public function tipoCombustible(){
        return $this->hasOne('App\VTipoCombustible','sMId');
    }

    public static function getModelsAct()
    {
        return DB::table('v_modelo as md')
            ->select('md.mId','md.mEst',
                DB::raw("concat(m.mDesc,' | ',sm.sMDesc,' | ',tc.tCDesc,' | ',md.mDesc) AS model"),
                DB::raw("DATE_FORMAT(md.mFecCrea,'%d-%m-%Y') AS mFecCrea"))
            ->join('v_sub_marca as sm','sm.sMId','=','md.sMId')
            ->join('v_marca as m', 'm.mId', '=', 'sm.mId')
            ->join('v_tipo_combustible as tc', 'tc.tCId', '=', 'md.tCId')
            ->where('md.mEst','=',1)
            ->orderby('md.mFecCrea', 'desc')->get();

    }
}
