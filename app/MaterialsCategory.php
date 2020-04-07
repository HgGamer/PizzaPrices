<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaterialsCategory extends Model
{
    protected $table = "pizza_materials_category";

    public function materials()
    {
        return $this->hasMany('App\Material', 'category_id');
    }
}
