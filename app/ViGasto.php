<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ViGasto extends Model
{
    protected $table = 'vi_gastos';
    public $primaryKey = 'gId';
    public $timestamps = false;
    public function tipDoc($id){
    return DB::table('vi_tipo_doc_gasts as tg')->select('*')
         ->join('vi_tipo_docs as d','d.tDId','=','tg.tDId')
         ->where(['tg.gId'=>$id])->get();
    }

    public function getGastVi(){
    // DB::table('re_referencia')

    }

    public function getGasto(){
         DB::table('vi_gasto as g')
             ->select('g.gId,g.gDesc',
              db::raw("DATE_FORMAT(tGFecCrea,'%d-%m-%Y') as tGFecCrea")
             )
             ->leftJoin('vi_tipo_gastos as tg','tg.tGId','=','g.tGId')
             ->get();

    }
    static function getGastos(){
       return DB::table('vi_gastos as gs')
            ->select('gs.gId','gs.gDesc','tg.tGDesc','gCosDia',
                DB::raw("DATE_FORMAT(gs.gFecCrea,'%d-%m-%Y') as gFecCrea"),'gs.gEst')
            ->leftJoin('vi_tipo_gastos as tg','tg.tGId','=','gs.tGId')
            ->get();
    }
}
