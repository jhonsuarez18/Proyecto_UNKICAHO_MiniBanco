<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ALMaterial extends Model
{
    protected $table = 'a_l_material';
    public $primaryKey = 'mId';
    public $timestamps = false;


    static function getMat($term){
        $query = DB::table('a_l_material as al')->select('*')
            ->join('a_l_tip_mat as tm','al.tmId','=','tm.tmId')
            ->Where('al.mMedNom', 'LIKE', "%$term%")
            ->where('al.mEst','=',1)
            ->limit(10000)
            ->get();
        return $query;
    }
    public static function getMaterial()
    {
        return DB::table('a_l_material as m')
            ->select('m.mId','tm.tmDesc','m.mCodMed','m.mMedNom','m.mMedCnc','m.mMedPres',DB::raw("DATE_FORMAT(m.mFecCrea,'%d-%m-%Y') AS mFecCrea"),'u.name as uname','mEst')
            ->leftJoin('a_l_tip_mat as tm', 'tm.tmId', '=', 'm.tmId')
            ->leftJoin('users as u', 'u.id', '=', 'm.mUsuReg')
            ->orderby('m.mFecCrea','DESC')
            ->get();
    }
}
