<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class presentacion extends Model
{
    protected $table = 'presentacion';
    public $primaryKey = 'psId';
    public $timestamps = false;
}
