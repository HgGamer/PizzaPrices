<?php

namespace App\Traits;
use App\StoreData;
use App\Material;
use Illuminate\Support\Facades\Log;
use App\Helper\LogManager;

trait PizzaQueryTrait {

    public function getInfinitPizzas(){

        $storeDatas = StoreData::all()->random(10);

        $pizzas = collect();
        foreach ($storeDatas as $storeData) {

            if ($storeData->pizzaAlias == null){
                $errorMSG =  "PizzaQueryTrait, getInfinitPizzas StoreData(id: " . $storeData->id . ")->pizzaAlias is NULL";
                LogManager::shared()->addLog($errorMSG);
                continue;
            }

            $receptekString = $storeData->pizzaAlias->recept;

            $receptekString = substr(substr_replace($receptekString, '', 0, 1), 0, -1); // első utolsó karakter levágása

            $receptekString = explode(",",$receptekString); //tömbé konvertálás

            $materialObjects = array();

            foreach ($receptekString as $receptString) {
                $material= Material::find($receptString);
                if($material != null){
                    $materialObjects[] =  $material;
                }else{
                    $errorMSG =  "PizzaQueryTrait, getInfinitPizzas Material(id: " . $receptString . ")->Material is NULL";
                    LogManager::shared()->addLog($errorMSG);
                    continue;
                }
            }

            $storeData->pizzaAlias->recept = $this->orderMaterialObjects($materialObjects);

            if (!$storeData->website){
                $errorMSG =  "PizzaQueryTrait, getInfinitPizzas StoreData(id: " . $storeData->id . ")->website is NULL";
                LogManager::shared()->addLog($errorMSG);
            }

            $pizzas[] = $storeData;
        }

       return $pizzas;
    }

    public function orderMaterialObjects($materialObjects){
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
