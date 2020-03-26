<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StoreData;
use App\Material;
use App\PizzaCategory;
use App\Traits\PizzaQueryTrait;

class HomeController extends Controller
{
    use PizzaQueryTrait ;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('welcome');
    }

    public function home(){

        $paginatedData = $this->getInfinitPizzas();

        return view('home')->withPizzas($paginatedData->getCollection())->withMaxLoad($paginatedData->lastPage())->withPaginatedBy($paginatedData->perPage());
    }

    public function contacts(){

        return view('contacts');
    }

    public function pizzacategories(){

        $Category = PizzaCategory::orderBy('sorrend','ASC')->get();

        return view('pizzacategories', compact('Category'));
    }

}
