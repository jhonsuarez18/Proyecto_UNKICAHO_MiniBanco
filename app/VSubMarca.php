<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class VSubMarca extends Model
{
    protected $table = 'v_sub_marca';
    public $primaryKey = 'sMId';
    public $timestamps = false;

    public function modelossubM($id){

       return DB::table('v_modelo as m')->select('*')
            ->join('v_tipo_combustible as tc','tc.tCId','=','m.tCId')
            ->where('m.sMId','=',$id)->get();
    }
}
