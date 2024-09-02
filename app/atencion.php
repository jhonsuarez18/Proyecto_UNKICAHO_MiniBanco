<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class atencion extends Model
{
    protected $table = 'atencion';
    public $primaryKey = 'idAtencion';
    public $timestamps = false;
}
