<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClienteTelefone extends Model
{
    public function cliente(){
        return $this->belongsTo('App\User');
    }

    public function telefone(){
        return $this->belongsTo('App\Telefone');
    }
}
