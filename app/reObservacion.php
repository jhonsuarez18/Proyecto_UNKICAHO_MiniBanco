<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class reObservacion extends Model
{
    protected $table = 're_observacion';
    public $primaryKey = 'oId';
    public $timestamps = false;

    public function getObservacion($rId)
    {
      return  DB::table('re_observacion as ob')
          ->select('ob.oMotivo','df.dFDescripcion',DB::raw('LPAD(rf.rId,"5",0) as codref'))
            ->join('re_revision as re', 're.rId', '=', 'ob.rId')
            ->join('re_doc_file as df', 'df.dFId', '=', 're.dFId')
            ->join('re_referencia as rf', 'rf.rId', '=', 'df.rId')
            ->where(['ob.rId' => $rId, 'ob.rEst' => 1])->first();
    }
}
