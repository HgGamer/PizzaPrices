<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PizzaCategory;

class PizzaCategoryController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $pizzaCategories = PizzaCategory::orderBy('sorrend', 'ASC')->paginate(20);

        return view('dashboard.pizza_categories.index')->withPizzaCategories($pizzaCategories);
    }

    public function create()
    {
        return view('dashboard.pizza_categories.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'link' => 'required',
            'url' => 'required',
            'sorrend' => 'required|numeric'
        ]);

        $category = new PizzaCategory;

        $category->name = $request->input('name');

        $category->link = $request->input('link');

        $category->url = $request->input('url');

        $category->sorrend = $request->input('sorrend');

        $category->url= $this->uploadFile('url', public_path('img/glry/'), $request)["filename"];

        $category->save();

        return redirect()->route('pizza_categories.index')
                    ->with('success','Pizza Category added successfully');;
    }

    public function edit($id)
    {
        return view('dashboard.pizza_categories.edit')->withPizzaCategory(PizzaCategory::find($id));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'link' => 'required',
            'url' => 'required',
            'sorrend' => 'required|numeric'
        ]);

        $category = PizzaCategory::find($id);

        $category->name = $request->input('name');

        $category->link = $request->input('link');

        $category->url = $request->input('url');

        $category->sorrend = $request->input('sorrend');

        if($request->file('url') != null) {

            $category->url = $this->uploadFile('url', public_path('img/glry/'), $request)["filename"];
        }

        $category->save();

        return redirect()->route('pizza_categories.index')
                    ->with('success','Pizza Category updated successfully');;

    }

    public function destroy($id)
    {
        $category = PizzaCategory::find($id);
        $category->delete();

        return redirect()->route('pizza_categories.index')
                        ->with('success','Pizza Category deleted successfully');
    }

}
