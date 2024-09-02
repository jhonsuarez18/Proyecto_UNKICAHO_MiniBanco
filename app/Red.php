<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Red extends Model
{
    //
    protected $table = 'red';
    public $primaryKey = 'idRed';
    public $timestamps = false;
    public function microRedes()
    {
        return $this->hasMany(MicroRed::class);
    }
}
