<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parentesco extends Model
{
    protected $table = 'parentesco';
    public $primaryKey = 'prtId';
    public $timestamps = false;
}
