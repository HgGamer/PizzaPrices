<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Material;

class MaterialController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $material = Material::orderBy('name', 'ASC')->paginate(50);

        return view('dashboard.material.index')->withMaterials($material);
    }

    public function create()
    {
        return view('dashboard.material.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $material = new Material;

        $material->name = $request->input('name');

        $material->save();

        return redirect()->route('materials.index');
    }

    public function edit($id)
    {
        return view('dashboard.material.edit')->withMaterial(Material::find($id));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $material = Material::find($id);

        $material->name = $request->input('name');

        $material->save();

        return redirect()->route('materials.index');
    }

    public function destroy($id)
    {
        $material = Material::find($id);
        $material->delete();

        return redirect()->route('materials.index')
                        ->with('success','Material deleted successfully');
    }

}
