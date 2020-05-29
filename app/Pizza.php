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

    public function pizzaCategory2(){
        return $this->belongsTo('App\PizzaCategory', 'category_id2', 'id');
    }

    public function pizzaCategory3(){
        return $this->belongsTo('App\PizzaCategory', 'category_id3', 'id');
    }

}
