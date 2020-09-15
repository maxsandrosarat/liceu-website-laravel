<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormaPagamento extends Model
{
    public function pedido()
    {
        return $this->belongsTo('App\Pedido', 'pedido_id', 'id');
    }
}
