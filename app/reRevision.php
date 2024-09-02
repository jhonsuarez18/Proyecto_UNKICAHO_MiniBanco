<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class reRevision extends Model
{
    protected $table = 're_revision';
    public $primaryKey = 'rId';
    public $timestamps = false;
}
