<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conviviente extends Model
{
    protected $table = 'conviviente';
    public $primaryKey = 'cvId';
    public $timestamps = false;
}
