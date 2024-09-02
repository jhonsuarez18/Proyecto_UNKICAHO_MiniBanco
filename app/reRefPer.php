<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class reRefPer extends Model
{
    protected $table = 're_ref_pers';
    public $primaryKey = 'rPId';
    public $timestamps = false;

    public function getViatDoc($rid, $pid)
    {
      return  DB::table('vi_viatico as vi')
            ->select('*')
            ->join('re_doc_file as df', 'df.dFId', '=', 'vi.dFId')
            ->where(['rId' => $rid, 'vi.pId' => $pid])->first();
    }


}
