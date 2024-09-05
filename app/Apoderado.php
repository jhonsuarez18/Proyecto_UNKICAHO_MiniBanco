<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Apoderado extends Model
{
    protected $table = 'apoderado';
    public $primaryKey = 'apId';
    public $timestamps = false;

    public static function getApoderados()
    {
        return $query=DB::table('apoderado as ap')
            ->select('ap.apId','ap.apNumeroDoc','td.tdDescCorta',
                'ap.apEstado','ap.apTelefono','dis.codigo',
                DB::raw('LPAD(ap.apId,"5",0) as codap'),
                DB::raw("DATE_FORMAT(ap.apFecCreacion,'%d-%m-%Y') as apFecCreacion"),
                DB::raw("DATE_FORMAT(ap.apFecNac,'%d-%m-%Y') as apFecNac"),
                DB::raw('concat(IFNULL(ap.apAPPaterno,"")," ",IFNULL(ap.apAPMaterno,"")," ",ap.apNombres) as apoderad'))
            ->leftjoin('distrito as dis', 'dis.dtId', '=', 'ap.idDt')
            ->leftjoin('tipo_doc as td', 'td.tdId', '=', 'ap.idTD')
            ->orderBy('ap.apFecCreacion','desc')
            ->get();
    }
    public static function getApoderadoDni($dni)
    {
        return DB::table('apoderado as ap')->select('*',
            DB::raw('TIMESTAMPDIFF(year,ap.apFecNac, now() ) as edad'))
            ->where('ap.apNumeroDoc', '=',$dni)
            ->where('ap.apEstado', '=',1)
            ->first();
    }
}
