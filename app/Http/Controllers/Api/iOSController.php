<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\PizzaQueryTrait;
use Illuminate\Http\Request;
use App\PizzaCategory;
use App\Material;
use App\Pizza;
use App\Helper\LogManager;
use App\StoreData;

class iOSController extends Controller
{

    use PizzaQueryTrait;

    public function test(){

        $pizzas = $this->getInfinitPizzas();

        return response()->json([
            'pizzas' => $pizzas
        ]);
    }

    public function infinitePizzas(){

        $pizzas = $this->getInfinitPizzas();

        return response()->json([
            'pizzas' => $pizzas
        ]);
    }

    function pizzasForCategory($id){
        $category = PizzaCategory::find($id);

        if (!isset($category)) {
           $pizzas = [];
           return response()->json([
                'pizzas' => $pizzas,
                'categoryName' => ""
            ]);
        }

        $pizzas = Pizza::where('category_id', $category->id)
                    ->orWhere('category_id2', $category->id )
                    ->orWhere('category_id3', $category->id )
                    ->get();

        foreach ($pizzas as $pizza) {
            $pizza->recept_array = $pizza->recept;

            $receptekString = $pizza->recept;

            $materialObjects = $this->getMaterialObjects($receptekString);

            $pizza->recept = $this->orderMaterialObjects($materialObjects);
        }

        return response()->json([
            'pizzas' => $pizzas,
            'categoryName' => $category->name
        ]);
    }



    public function pizzas($id){

        $pizza = Pizza::where('id', $id)->first();

        $receptekString = $pizza->recept;

        $materialObjects = $this->getMaterialObjects($receptekString);

        $pizza->recept = $this->orderMaterialObjects($materialObjects);

        $storeDatas = StoreData::where('pizzaid', $id)->orderBy('price', 'asc')->get();

        foreach ($storeDatas as $storeData) {

            if (!$storeData->website){
                $errorMSG =  "User::PizzasController, Show StoreData(id: " . $storeData->id . ")->website is NULL";
                LogManager::shared()->addLog($errorMSG);
            }

            if (!$storeData->pizzaAlias){
                $errorMSG =  "User::PizzasController, Show StoreData(id: " . $storeData->id . ")->pizzaAlias is NULL";
                LogManager::shared()->addLog($errorMSG);
            }

        }

        return response()->json([
            'pizza' => $pizza,
            'storeDatas' => $storeDatas
        ]);
    }



    //MATERIAL RENDEZÉSEK LEKÉRÉSEK

    private function getMaterialObjects($pizzaRecept){
        $receptekString = $pizzaRecept;

        $receptekString = substr(substr_replace($receptekString, '', 0, 1), 0, -1); // első utolsó karakter levágása

        $receptekString = explode(",",$receptekString); //tömbé konvertálás

        $materialObjects = array();

        foreach ($receptekString as $receptString) {
            $material = Material::find($receptString);
            if($material != null){
                $materialObjects[] =  $material;
            }else{
                $errorMSG =  "User::PizzasController, Show Material(id: " . $receptString . ")->Material is NULL";
                LogManager::shared()->addLog($errorMSG);
                continue;
            }
        }
        return $materialObjects;
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


}
