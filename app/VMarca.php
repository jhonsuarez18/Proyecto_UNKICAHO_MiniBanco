<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VMarca extends Model
{
    protected $table = 'v_marca';
    public $primaryKey = 'mId';
    public $timestamps = false;

    public function subMarcas(){
        return $this->hasMany('App\VSubMarca','mId');
    }
}
