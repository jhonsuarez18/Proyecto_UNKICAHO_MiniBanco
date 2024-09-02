<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SintomaAtencion extends Model
{
    protected $table = 'sintomaatencion';
    public $primaryKey = 'idSintomaatencion';
    public $timestamps = false;
}
