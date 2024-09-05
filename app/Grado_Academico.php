<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grado_Academico extends Model
{
    protected $table = 'grado_academico';
    public $primaryKey = 'gaId';
    public $timestamps = false;
}
