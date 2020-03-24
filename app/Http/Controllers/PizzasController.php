<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StoreData;
use App\Material;
use Illuminate\Support\Facades\Log;
class PizzasController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getInfinitPizzas(){

        //return $request->page;
        $paginatedData = StoreData::paginate(10);

        $storeDatas =  $paginatedData->getCollection();

        $pizzas = collect();
        foreach ($storeDatas as $storeData) {
            $receptekString = $storeData->pizza->recept;

            $receptekString = substr(substr_replace($receptekString, '', 0, 1), 0, -1); // első utolsó karakter levágása
    
             $receptekString = explode(",",$receptekString); //tömbé konvertálás
    
            $receptekNeve = array();
    
            foreach ($receptekString as $receptString) {
               $receptekNeve[] =  Material::find($receptString)['name'];
            }
    
            $storeData->pizza->recept = $receptekNeve;

            $pizzas[] = $storeData;
        }

        $paginatedData->setCollection($pizzas);

        return $paginatedData;

    }


}
