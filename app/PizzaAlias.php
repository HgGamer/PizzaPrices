<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PizzaAlias extends Model
{
    protected $table = "pizza_pizzaalias";


    public function storeDatas()
    {
        return $this->hasMany('App\StoreData', 'pizzaid');
    }

}
