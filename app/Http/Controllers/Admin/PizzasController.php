<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pizza;
use App\Helper\LogManager;
use App\PizzaCategory;

class PizzasController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $paginatedData = Pizza::where('id', '!=', 1)
                        ->orderBy('name', 'ASC')
                        ->paginate(50);

        $pizzasData =  $paginatedData->getCollection();

        $pizzas = collect();

        foreach ($pizzasData as $pizza) {

            if ($pizza->pizzaCategory == null){
                $errorMSG =  "PizzasController, index() pizza(id: " . $pizza->id . ")->category is NULL";
                //LogManager::shared()->addLog($errorMSG);
            }

            $pizzas[] = $pizza;
        }

        $paginatedData->setCollection($pizzas);

        $pizzaCategories = PizzaCategory::All();

        return view('dashboard.pizza.index')->withPizzas($paginatedData)->withPizzaCategories($pizzaCategories);
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

    public function setPizzaCategory(Request $request){
        if(!$request->pizza_id && !$request->category_id && $request->category_id == 0)
        return;

        $pizza = Pizza::find($request->pizza_id);

        $pizza->category_id= $request->category_id;

        $pizza->save();

        return response()->json(['msg' => 'Pizza Category updated!']);
    }


}
