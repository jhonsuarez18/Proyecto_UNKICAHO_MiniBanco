<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VTipoVehiculo extends Model
{
    protected $table = 'v_tipo_vehiculo';
    public $primaryKey = 'tVId';
    public $timestamps = false;
}
