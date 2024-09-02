<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ViTipoDocGast extends Model
{
    protected $table = 'vi_tipo_doc_gasts';
    public $primaryKey = 'tDGId';
    public $timestamps = false;

    static function getTipDG(){
        return DB::table('vi_tipo_doc_gasts as tdg')
            ->select('tdg.tDGId','td.tDDes','g.gDesc',
                DB::raw("DATE_FORMAT(tdg.tDGFecCrea,'%d-%m-%Y') as tDGFecCrea"),'tdg.tDGEst')
            ->leftJoin('vi_tipo_docs as td','td.tDId','=','tdg.tDId')
            ->leftJoin('vi_gastos as g','g.gId','=','tdg.gId')
            ->get();
    }

}
