<?php

namespace App\Http\Controllers;

use App\PizzaType;
use Illuminate\Http\Request;

class PizzaTypesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $pizzaTypes = PizzaType::orderBy('id', 'DESC')->paginate(10);
 
        return view('dashboard.pizza_types.index')->withPizzaTypes($pizzaTypes);
    }

    public function create()
    {
        return view('dashboard.pizza_types.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required'
        ]);
 
        $pizzaType = new PizzaType;

        $pizzaType->title = $request->input('title');

        if ($request->hasFile('logo')) {
        	$pizzaType->image = $this->uploadFile('logo', public_path('uploads/'), $request)["filename"];
        }	
 
        $pizzaType->save();
 
        return redirect()->route('pizza-types.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        return view('dashboard.pizza_types.edit')->withPizzaType(PizzaType::find($id));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);
 
        $pizzaType = PizzaType::find($id);
 
        $pizzaType->title = $request->input('title');
 
        if ($request->hasFile('logo')) {
        	$pizzaType->image = $this->uploadFile('logo', public_path('uploads/'), $request)["filename"];
        }

 
        $pizzaType->save();
 
        return redirect()->route('pizza-types.index');
    }

    public function destroy($id)
    {   
        $pizzaType = PizzaType::find($id);
        $pizzaType->delete();
  
        return redirect()->route('pizza-types.index')
                        ->with('success','Pizza type deleted successfully');
    }
}
