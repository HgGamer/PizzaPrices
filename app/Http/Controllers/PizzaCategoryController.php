<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Pizza;
use App\Material;
use App\PizzaCategory;
use App\Helper\LogManager;

class PizzaCategoryController extends Controller
{

function pizzasForCategory($slug){
    $category = PizzaCategory::where('link', $slug)
    ->first();

    if (!isset($category)) {
       $pizzas = [];
       return view('pizzacategory.index')->withPizzas($pizzas)->withCategoryName("");
    }

    $pizzas = Pizza::where('category_id', $category->id)  ->get();

    foreach ($pizzas as $pizza) {
        $receptekString = $pizza->recept;

        $receptekString = substr(substr_replace($receptekString, '', 0, 1), 0, -1); // első utolsó karakter levágása

        $receptekString = explode(",",$receptekString); //tömbé konvertálás

        $receptekNeve = array();

        foreach ($receptekString as $receptString) {
            $name = Material::find($receptString);
            if($name != null){
                $receptekNeve[] =  $name['name'];
            }else{
                $errorMSG =  "User::PizzaCategoryController, pizzasForCategory, Material(id: " . $receptString . ")->Material is NULL";
                LogManager::shared()->addLog($errorMSG);
                continue;
            }
        }

        $pizza->recept = $receptekNeve;
    }

    return view('pizzacategory.index')->withPizzas($pizzas)->withCategoryName($category->name);
    //return $pizzas;
    }
}
