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

    public function show($id){
        $pizza = Pizza::where('id', $id)->first();

        $receptekString = $pizza->recept;

        $receptekString = substr(substr_replace($receptekString, '', 0, 1), 0, -1); // első utolsó karakter levágása

        $receptekString = explode(",",$receptekString); //tömbé konvertálás

        $receptekNeve = array();

        foreach ($receptekString as $receptString) {
            $name = Material::find($receptString);
            if($name != null){
                $receptekNeve[] =  $name['name'];
            }else{
                $errorMSG =  "User::PizzasController, Show Material(id: " . $receptString . ")->Material is NULL";
                LogManager::shared()->addLog($errorMSG);
                continue;
            }
        }

        $pizza->recept = $receptekNeve;

        $storeDatas = StoreData::where('pizzaid', $id)->orderBy('price', 'asc')->get();

        foreach ($storeDatas as $storeData) {

            if (!$storeData->website){
                $errorMSG =  "User::PizzasController, Show StoreData(id: " . $storeData->id . ")->website is NULL";
                LogManager::shared()->addLog($errorMSG);
            }

        }

        //return $storeDatas;

        return view('pizza.show')->withDatas($storeDatas)->withPizza($pizza);
    }


}
