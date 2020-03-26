<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PizzaCategoryController extends Controller
{
    public function index(){

        return view('pizzacategory.index');
    }
}
