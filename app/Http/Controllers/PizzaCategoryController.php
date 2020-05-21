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

    $pizzas = Pizza::where('category_id', $category->id)
                ->orWhere('category_id2', $category->id )
                ->orWhere('category_id3', $category->id )
                ->get();

    foreach ($pizzas as $pizza) {
        $pizza->recept_array = $pizza->recept;

        $receptekString = $pizza->recept;

        $receptekString = substr(substr_replace($receptekString, '', 0, 1), 0, -1); // első utolsó karakter levágása

        $receptekString = explode(",",$receptekString); //tömbé konvertálás

        $materialObjects = array();

        foreach ($receptekString as $receptString) {
            $material = Material::find($receptString);
            if($material != null){
                $materialObjects[] =  $material;
            }else{
                $errorMSG =  "User::PizzaCategoryController, pizzasForCategory, Material(id: " . $receptString . ")->Material is NULL";
                LogManager::shared()->addLog($errorMSG);
                continue;
            }
        }

        $pizza->recept = $this->orderMaterialObjects($materialObjects);
    }

    return view('pizzacategory.index')->withPizzas($pizzas)->withCategoryName($category->name);
    //return $pizzas;
    }


    private function orderMaterialObjects($materialObjects){
        $c = collect($materialObjects);

        $materialObjects = $c->sortBy('category_id')->values();

        $finalMaterialsArray = [];
        foreach ($materialObjects as $material) {
            if  (!isset($material->name)){
                continue;
            }
            $finalMaterialsArray[] = $material->name;
        }
        //Csak a neveket adja vissza tömbként
        return $finalMaterialsArray;
    }

    public function getAllCategories(){
        $pizzaCategories = PizzaCategory::all();

        return response($pizzaCategories, 200);

    }

}
