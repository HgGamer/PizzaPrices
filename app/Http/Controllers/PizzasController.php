<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Traits\PizzaQueryTrait;
use App\Pizza;
use App\StoreData;
use App\Helper\LogManager;
use App\Material;

class PizzasController extends Controller
{

    use PizzaQueryTrait;

    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function infinitePizzas(){
        $paginatedData = $this->getInfinitPizzas();

        return $paginatedData;
    }
    // [ kezdővel nem kell keresni mert az csak egy feltétesnél fordulhat elő, olyan meg nem lehetséges pizza pickernél(meg amugy se)
    //https://laravel.com/docs/7.x/queries       Or Statements ful alatt


    public function pizzasByMaterials(Request $request){

        return $request->materials;

        $materials = [221,228,318];

        $pizzas = Pizza::where('recept', 'like',  '%221,%')
            ->get();

        return $pizzas;
    }



    public function show($id){
        $pizza = Pizza::where('id', $id)->first();

        $receptekString = $pizza->recept;

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

        //return $storeDatas;

        return view('pizza.show')->withDatas($storeDatas)->withPizza($pizza);
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
