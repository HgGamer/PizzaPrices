<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PizzaPickerController extends Controller
{
    public function index(){

        return view('pizzabuilder.index');
    }
}
