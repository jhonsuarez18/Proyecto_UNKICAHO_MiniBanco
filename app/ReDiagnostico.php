<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReDiagnostico extends Model
{
    protected $table = 're_diagnostico';
    public $primaryKey = 'dNId';
    public $timestamps = false;
}
