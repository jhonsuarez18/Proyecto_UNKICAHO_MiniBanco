<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDoc extends Model
{
    protected $table = 'tipo_doc';
    public $primaryKey = 'tdId';
    public $timestamps = false;
}
