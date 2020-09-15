<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClienteEndereco extends Model
{
    public function cliente(){
        return $this->belongsTo('App\User');
    }

    public function endereco(){
        return $this->belongsTo('App\Endereco');
    }
}
