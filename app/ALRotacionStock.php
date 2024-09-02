<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ALRotacionStock extends Model
{
    protected $table = 'a_l_rotacion_stock';
    public $primaryKey = 'rsId';
    public $timestamps = false;
}
