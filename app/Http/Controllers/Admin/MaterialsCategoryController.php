<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Material;
use App\MaterialsCategory;

class MaterialsCategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $materialCategories = MaterialsCategory::orderBy('name', 'ASC')->paginate(20);


        return view('dashboard.materials_categories.index')->withMaterialsCategories($materialCategories);
    }


    public function create()
    {
        return view('dashboard.materials_categories.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',

        ]);

        $category = new MaterialsCategory;

        $category->name = $request->input('name');

        $category->save();

        return redirect()->route('materials_categories.index')
            ->with('success','Pizza Materials Category added successfully');;
    }

    public function destroy($id)
    {
        $category = MaterialsCategory::find($id);
        $category->delete();

        return redirect()->route('materials_categories.index')
            ->with('success','Materials Category deleted successfully');
    }

    public function edit($id)
    {
        return view('dashboard.materials_categories.edit')->withMaterialsCategory(MaterialsCategory::find($id));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $category = MaterialsCategory::find($id);

        $category->name = $request->input('name');



        $category->save();

        return redirect()->route('materials_categories.index')
            ->with('success','Material Category updated successfully');;

    }
}
