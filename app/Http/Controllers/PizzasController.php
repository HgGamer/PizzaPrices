<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Traits\PizzaQueryTrait;

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


}
