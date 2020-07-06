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
use DB;

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

        $pizza->receptArray = $pizza->recept;

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

        $similarPizzasCount =  DB::table('store_data')
        ->join('pizza_pizzas', 'store_data.pizzaid', '=', 'pizza_pizzas.id')
        ->select('*')
        ->Where("category_id", $pizza->category_id)
        ->orWhere("category_id", $pizza->category_id)
        ->orWhere("category_id", $pizza->category_id)
        ->count();

        if($similarPizzasCount <9){
            $similarPizzas = DB::table('store_data')
            ->join('pizza_pizzas', 'store_data.pizzaid', '=', 'pizza_pizzas.id')
            ->join('website', 'store_data.websiteid', '=', 'website.id')
            ->select('*', 'store_data.url as pizzaurl')
            ->Where("category_id", $pizza->category_id)
            ->orWhere("category_id", $pizza->category_id)
            ->orWhere("category_id", $pizza->category_id)
            ->get()
            ->random($similarPizzasCount);
        }else{
            $similarPizzas = DB::table('store_data')
            ->join('pizza_pizzas', 'store_data.pizzaid', '=', 'pizza_pizzas.id')
            ->join('website', 'store_data.websiteid', '=', 'website.id')
            ->select('*', 'store_data.url as pizzaurl')
            ->Where("category_id", $pizza->category_id)
            ->orWhere("category_id", $pizza->category_id)
            ->orWhere("category_id", $pizza->category_id)
            ->get()
            ->random(9);
        }

        $similarPizzasResult = [];

        foreach ($similarPizzas as $similarPizza) {
            $similarPizza->recept_array = $similarPizza->recept;
            $receptekString = $similarPizza->recept;
            $materialObjects = $this->getMaterialObjects($receptekString);
            $similarPizza->recept = $this->orderMaterialObjects($materialObjects);
            $similarPizzasResult[] = $similarPizza;
        }

        return response()->json([
            'pizza' => $pizza,
            'storeDatas' => $storeDatas,
            'similarPizzas' => $similarPizzasResult
        ]);
    }

    public function bestPizzas(){

        $pizzaOfTheMonthId = 111;
        $pizzaOfTheWeakId = 243;

        $monthPizza = StoreData::find($pizzaOfTheMonthId);
        $weekPizza = StoreData::find($pizzaOfTheWeakId);

        if($monthPizza == null){
            $monthPizza = StoreData::all()->random();
        }
        if($weekPizza == null){
            $weekPizza = StoreData::all()->random();
        }

        $monthPizza->pizza;
        $monthPizza->website;

        $weekPizza->pizza;
        $weekPizza->website;

        $receptekString = $monthPizza->pizza->recept;
        $materialObjects = $this->getMaterialObjects($receptekString);
        $monthPizza->recept = $this->orderMaterialObjects($materialObjects);

        $receptekString = $weekPizza->pizza->recept;
        $materialObjects = $this->getMaterialObjects($receptekString);
        $weekPizza->recept = $this->orderMaterialObjects($materialObjects);

        return response()->json([
            'monthPizza' => $monthPizza,
            'weekPizza' => $weekPizza
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
