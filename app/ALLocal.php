<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ALLocal extends Model
{
    protected $table = 'a_l_local';
    public $primaryKey = 'lId';
    public $timestamps = false;

    public function ejecutora()
    {
        return $this->hasOne('App\Ejecutora');
    }
}
