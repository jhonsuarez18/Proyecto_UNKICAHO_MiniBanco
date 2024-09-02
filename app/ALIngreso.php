<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ALIngreso extends Model
{
    protected $table = 'a_l_ingreso';
    public $primaryKey = 'iId';
    public $timestamps = false;
}
