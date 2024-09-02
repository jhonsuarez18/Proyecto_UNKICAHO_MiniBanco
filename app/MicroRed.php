<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MicroRed extends Model
{
    //
    protected $table = 'microred';
    public $primaryKey = 'idMicroRed';
    public $timestamps = false;

    public function Eess()
    {
        return $this->hasMany(Eess::class);
    }
}
