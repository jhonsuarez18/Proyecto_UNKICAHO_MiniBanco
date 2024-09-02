<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EPMetaEpecificaGasto extends Model
{
    protected $table = 'e_p_meta_epecifica_gasto';
    public $primaryKey = 'mEGId';
    public $timestamps = false;

    public static function obtenerEPMetaEpecificaGasto($idmet, $esp)
    {
        return DB::table('e_p_meta_epecifica_gasto')->select('*')
            ->where('mId', '=', $idmet)->where('eGId', '=', $esp)->first();
    }
}
