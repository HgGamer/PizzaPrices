<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{
    protected $table = "pizza_pizzas";

    public function storeDatas()
    {
        return $this->hasMany('App\StoreData', 'pizzaid');
    }

    public function pizzaCategory(){
        return $this->belongsTo('App\PizzaCategory', 'category_id', 'id');
    }

}
