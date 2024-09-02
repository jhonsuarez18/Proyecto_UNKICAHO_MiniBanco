<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EPConcepto extends Model
{
    protected $table = 'e_p_concepto';
    public $primaryKey = 'cId';
    public $timestamps = false;
}
