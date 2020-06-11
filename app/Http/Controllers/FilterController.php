<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FilterController extends Controller
{


    public function index(){

        return view('pizzafilter.index');

    }

    public function filter(Request $request){


        return "asd";

    }

}
