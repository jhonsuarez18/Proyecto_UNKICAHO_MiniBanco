<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Grado_Seccion extends Model
{
    protected $table = 'grado_seccion';
    public $primaryKey = 'gsId';
    public $timestamps = false;
    public static function obtenerGradoSecc($idgrad)
    {
        $query = DB::table('grado_seccion as gs')->select('gs.idS', 'gs.gsId',
            's.sDesc')
            ->join('seccion as s','s.sId','=','gs.idS')
            ->where('idGA', '=', $idgrad)
            ->get();
        return $query;
    }
}
