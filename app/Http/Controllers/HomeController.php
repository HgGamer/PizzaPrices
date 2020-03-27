<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StoreData;
use App\Material;
use App\PizzaCategory;
use App\Traits\PizzaQueryTrait;
use App\Feedback;

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

    public function storeFeedback(Request $request){
            $this->validate($request, [
                'body' => 'required|max:512'
            ]);


            $feedback = new Feedback();

            $feedback->body = $request->input('body');

            $feedback->save();

            $response = array(
                'status' => 'success',
                'msg' => "Siker",
            );
            return response()->json($response);

    }

}
