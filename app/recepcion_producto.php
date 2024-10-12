<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class recepcion_producto extends Model
{
    protected $table = 'recepcion_producto';
    public $primaryKey = 'rcpId';
    public $timestamps = false;
}
