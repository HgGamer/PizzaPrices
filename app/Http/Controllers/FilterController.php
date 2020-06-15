<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StoreData;
use Illuminate\Support\Facades\Log;
use App\Website;
use App\Helper\LogManager;
use App\Material;

class FilterController extends Controller
{


    public function index(){

        $websites = Website::all();

        //return $websites;
        return view('pizzafilter.index')->withWebsites($websites);

    }

    public function filter(Request $request){

        $websites = [3,17];

        if ($request->pizzaSize) {
            $pizzaSize = $request->pizzaSize;
        }else{
            $pizzaSize = 0;
        }

        if ($request->pizzaPriceCategory) {
            $pizzaPriceCategory = $request->pizzaPriceCategory;
        }else{
            $pizzaPriceCategory = 0;
        }


        //Log::debug(count($websites));

        //return "asd";
        $storeDatas = StoreData::query();

        if ($pizzaSize == 26 || $pizzaSize == 28 || $pizzaSize == 30 || $pizzaSize == 32) {
            switch ($pizzaSize) {
                case 26:
                    $storeDatas = $storeDatas->where('pizzaSize', 26);
                    break;
                case 28:
                    $storeDatas = $storeDatas->where('pizzaSize', 28);
                    break;
                case 30:
                    $storeDatas = $storeDatas->where('pizzaSize', 30);
                    break;
                case 32:
                    $storeDatas = $storeDatas->where('pizzaSize', 32);
                    break;
            }
        }

        if ($pizzaPriceCategory == 1 || $pizzaPriceCategory == 2 || $pizzaPriceCategory == 3) {
            switch ($pizzaPriceCategory) {
                case 1:
                    $storeDatas = $storeDatas->where('price', '<' , 1500);
                    break;
                case 2:
                    $storeDatas = $storeDatas->where('price', '>' , 1500);
                    $storeDatas = $storeDatas->where('price', '<' , 2000);
                    break;
                case 3:
                    $storeDatas = $storeDatas->where('price', '>' , 2000);
                    break;
            }
        }

        if (count($websites) > 0) {
            $storeDatas = $storeDatas->whereIn('websiteid', $websites);
        }

        $storeDatas = $storeDatas->get();

        foreach ($storeDatas as $storeData) {
            if ($storeData->pizzaAlias == null){
                $errorMSG =  "FilterController, filter() StoreData(id: " . $storeData->id . ")->pizzaAlias is NULL";
                LogManager::shared()->addLog($errorMSG);
                continue;
            }

            $storeData->pizzaAlias->recept_array = $storeData->pizzaAlias->recept;

            $receptekString =$storeData->pizzaAlias->recept;

            $materialObjects = $this->getMaterialObjects($receptekString);

            $storeData->pizzaAlias->recept = $this->orderMaterialObjects($materialObjects);

            if (!$storeData->website){
                $errorMSG =  "FilterController, filter() StoreData(id: " . $storeData->id . ")->website is NULL";
                LogManager::shared()->addLog($errorMSG);
            }
        }

        return $storeDatas;

    }

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
