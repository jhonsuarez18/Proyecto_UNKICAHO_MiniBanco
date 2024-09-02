<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ViComprobante extends Model
{
    protected $table = 'vi_comprobantes';
    public $primaryKey = 'cId';
    public $timestamps = false;
}
