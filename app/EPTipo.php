<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EPTipo extends Model
{
    protected $table = 'e_p_tipo';
    public $primaryKey = 'tId';
    public $timestamps = false;

    Public static function obtenertipo(){
        return DB::table('e_p_tipo as t')
            ->select('t.tId','t.tCod','t.tDesc','t.tFecCrea','t.tEst','u.name as Usuario')
            ->leftJoin('users as u','t.tUsuReg','=','u.id')
            ->orderby('t.tCod', 'desc')->get();
    }
}
