<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StoreData;
use Illuminate\Support\Facades\Log;
use App\Website;

class FilterController extends Controller
{


    public function index(){

        $websites = Website::all();

        //return $websites;
        return view('pizzafilter.index')->withWebsites($websites);

    }

    public function filter(Request $request){

        $websites = $request->websites;

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


        return $storeDatas;

    }

}
