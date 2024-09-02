<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Marca extends Model
{
    protected $table = 'marca';
    public $primaryKey = 'mId';
    public $timestamps = false;
    public static function obtenerMarca()
    {
        return DB::table('marca as m')
            ->select('m.mId as mCod', 'm.mDesc', 'm.mEst')
            ->orderBy('m.mId', 'asc')->get();
    }
    public static function obtenerMarcaEditar($idmarca)
    {
        return DB::table('marca as  m')
            ->select('m.mId', 'm.mDesc', 'm.mEst')
            ->where('m.mId', $idmarca)
            ->orderBy('m.mId', 'asc')->first();
    }
}
