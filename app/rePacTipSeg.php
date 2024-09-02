<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class rePacTipSeg extends Model
{

    protected $table = 're_pac_tip_segs';
    public $primaryKey = 'pId';
    public $timestamps = false;

    public function getTipSeg($pid)
    {
      return  DB::table('re_pac_tip_segs as pts')->select('*')
            ->join('re_tip_seguro as ts', 'ts.tSId', '=', 'pts.tSId')
            ->where('pts.afi_DNI','=',$pid)
            ->get();
    }

}
