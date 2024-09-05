<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grado_Intruccion extends Model
{
    protected $table = 'grado_instruccion';
    public $primaryKey = 'giId';
    public $timestamps = false;
}
