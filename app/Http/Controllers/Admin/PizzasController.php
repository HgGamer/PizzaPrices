<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pizza;

class PizzasController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $pizzas = Pizza::orderBy('name', 'ASC')->paginate(50);

        return view('dashboard.pizza.index')->withPizzas($pizzas);
    }

    public function create()
    {
        return view('dashboard.pizza.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $pizza = new Pizza;

        $pizza->name = $request->input('name');

        $pizza->save();

        return redirect()->route('pizzas.index')->with('success','Pizza saved successfully');;
    }

    public function edit($id)
    {
        return view('dashboard.pizza.edit')->withPizza(Pizza::find($id));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $pizza = Pizza::find($id);

        $pizza->name = $request->input('name');

        $pizza->save();

        return redirect()->route('pizzas.index')
                ->with('success','Pizza updated successfully');;
    }

    public function destroy($id)
    {
        $pizza = Pizza::find($id);
        $pizza->delete();

        return redirect()->route('pizzas.index')
                        ->with('success','Pizza deleted successfully');
    }

}
