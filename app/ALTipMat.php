<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ALTipMat extends Model
{
    protected $table = 'a_l_tip_mat';
    public $primaryKey = 'tmId';
    public $timestamps = false;

    public function materiales()
    {
        return $this->hasMany('App\AlMaterial');
    }
}
