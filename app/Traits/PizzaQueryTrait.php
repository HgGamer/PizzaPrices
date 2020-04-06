<?php

namespace App\Traits;
use App\StoreData;
use App\Material;
use Illuminate\Support\Facades\Log;
use App\Helper\LogManager;

trait PizzaQueryTrait {

    public function getInfinitPizzas(){

        $paginatedData = StoreData::paginate(10);

        $storeDatas =  $paginatedData->getCollection();

        $pizzas = collect();
        foreach ($storeDatas as $storeData) {

            if ($storeData->pizza == null){
                $errorMSG =  "PizzaQueryTrait, getInfinitPizzas StoreData(id: " . $storeData->id . ")->pizza is NULL";
                LogManager::shared()->addLog($errorMSG);
                continue;
            }

            $receptekString = $storeData->pizza->recept;

            $receptekString = substr(substr_replace($receptekString, '', 0, 1), 0, -1); // első utolsó karakter levágása

            $receptekString = explode(",",$receptekString); //tömbé konvertálás

            $receptekNeve = array();

            foreach ($receptekString as $receptString) {
                $name = Material::find($receptString);
                if($name != null){
                    $receptekNeve[] =  $name['name'];
                }else{
                    $errorMSG =  "PizzaQueryTrait, getInfinitPizzas Material(id: " . $receptString . ")->Material is NULL";
                    LogManager::shared()->addLog($errorMSG);
                    continue;
                }
            }

            $storeData->pizza->recept = $receptekNeve;

            if (!$storeData->website){
                $errorMSG =  "PizzaQueryTrait, getInfinitPizzas StoreData(id: " . $storeData->id . ")->website is NULL";
                LogManager::shared()->addLog($errorMSG);
            }

            $pizzas[] = $storeData;
        }

        $paginatedData->setCollection($pizzas);

        return $paginatedData;

    }
}
