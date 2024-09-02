<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class S_Error extends Model
{
    protected $table = 's_error';
    public $primaryKey = 'eId';
    public $timestamps = false;
}
