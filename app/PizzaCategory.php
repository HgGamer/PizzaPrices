<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PizzaCategory extends Model
{
    protected $table = "pizza_category";

    public function pizzas()
    {
        return $this->hasMany('App\Pizza', 'category_id');
    }

}
