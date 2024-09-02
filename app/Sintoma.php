<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sintoma extends Model
{
    protected $table = 'sintoma';
    public $primaryKey = 'idSintoma';
    public $timestamps = false;

    public static function obtenerSintomas()
    {
        $query = DB::table('sintoma')->select('idSintoma','descripcion')
            ->where('estado', '=', 1)
            ->get();
        return $query;
    }
}
