<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubMenu extends Model
{
    protected $table = 'submenu';
    public $primaryKey = 'idSubMenu';
    public $timestamps = false;
}
