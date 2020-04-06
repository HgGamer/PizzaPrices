<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreData extends Model
{
    protected $table = "store_data";

    public function pizza(){
        return $this->belongsTo('App\PizzaAlias', 'pizzaid', 'pizzaid');
    }

    public function website(){
        return $this->belongsTo('App\Website', 'websiteid', 'id');
    }
}
