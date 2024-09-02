<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class reEstPaciente extends Model
{
    protected $table = 're_est_paciente';
    public $primaryKey = 'ePId';
    public $timestamps = false;
}
