<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pizza;
use App\Material;
use App\PizzaCategory;
use App\MaterialsCategory;

class PizzaPickerController extends Controller
{
    public function index(){

        $categories = MaterialsCategory::all();

        foreach ($categories as $category){

            $category->materials;

        }
        //Alap materialok id-ét külön is átdobni
        $baseMaterialIds = [];
        foreach ($categories[0]['materials'] as $baseMaterial) {
            $baseMaterialIds[] = $baseMaterial['id'];
        }

        return view('pizzabuilder.index')->withCategories($categories)->withBaseMaterialIds($baseMaterialIds);
    }
}
