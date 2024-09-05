<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado_civil extends Model
{
    protected $table = 'estado_civil';
    public $primaryKey = 'ecId';
    public $timestamps = false;
}
