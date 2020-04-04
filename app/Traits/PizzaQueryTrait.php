<?php

namespace App\Traits;
use App\StoreData;
use App\Material;

trait PizzaQueryTrait {

    public function getInfinitPizzas(){

        $paginatedData = StoreData::paginate(10);

        $storeDatas =  $paginatedData->getCollection();

        $pizzas = collect();
        foreach ($storeDatas as $storeData) {
            if($storeData == null || $storeData->pizza == null)
            {
                //TODO:: ezt kilogolni
                break;
            }
            $receptekString = $storeData->pizza->recept;

            $receptekString = substr(substr_replace($receptekString, '', 0, 1), 0, -1); // első utolsó karakter levágása

            $receptekString = explode(",",$receptekString); //tömbé konvertálás

            $receptekNeve = array();

            foreach ($receptekString as $receptString) {
                $name = Material::find($receptString);
                if($name != null){
                    $receptekNeve[] =  $name['name'];
                }

            }

            $storeData->pizza->recept = $receptekNeve;

            $pizzas[] = $storeData;
        }

        $paginatedData->setCollection($pizzas);

        return $paginatedData;

    }
}
