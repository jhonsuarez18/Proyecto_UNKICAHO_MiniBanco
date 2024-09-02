<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EPDetallePedido extends Model
{
    protected $table = 'e_p_detalle_pedido';
    public $primaryKey = 'dPeId';
    public $timestamps = false;
}
