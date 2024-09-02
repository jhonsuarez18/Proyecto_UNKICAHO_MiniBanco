<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class reCie10 extends Model
{
    protected $table = 're_cie10';
    public $primaryKey = 'cId';
    public $timestamps = false;

    public static function getCie10($term)
    {
        $query = DB::table('re_cie10 as c')->select('c.cId', 'c.cCodigo', 'c.cDescripcion', DB::raw('concat(c.cCodigo," - ",c.cDescripcion) as descripcion'))
            ->Where(DB::raw('concat(c.cCodigo," ",c.cDescripcion)'), 'LIKE', "%$term%")
            ->Where(['c.cEst' => 1])
            ->limit(10000)
            ->get();
        return $query;
    }

    public function idrCie10($rid)
    {
        return DB::table('re_cie10 as c')->select('*')
            ->join('re_diagnostico as d', 'd.cId', '=', 'c.cId')
            ->where(['d.rId'=> $rid])->get();
    }

}
