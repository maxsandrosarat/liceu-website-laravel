<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    public function pedido()
    {
        return $this->belongsTo('App\Pedido', 'pedido_id', 'id');
    }
}
