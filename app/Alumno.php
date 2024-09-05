<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    protected $table = 'alumno';
    public $primaryKey = 'alId';
    public $timestamps = false;
}
