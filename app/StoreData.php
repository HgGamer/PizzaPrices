<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreData extends Model
{
    protected $table = "store_data";

    public function pizza(){
        return $this->belongsTo('App\Pizza', 'pizzaid', 'id');
    }

    public function pizzaAlias(){
        return $this->belongsTo('App\PizzaAlias', 'pizzaAliasId', 'id');
    }

    public function website(){
        return $this->belongsTo('App\Website', 'websiteid', 'id');
    }
}
