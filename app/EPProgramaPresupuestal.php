<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EPProgramaPresupuestal extends Model
{
    protected $table = 'e_p_programa_presupuestal';
    public $primaryKey = 'pPId';
    public $timestamps = false;
}
