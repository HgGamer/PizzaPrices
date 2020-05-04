<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\LogManager;

use App\Material;
use App\MaterialsCategory;

class MaterialController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $material = Material::orderBy('name', 'ASC')->paginate(50);

        $materialsCategories = MaterialsCategory::all();


        return view('dashboard.material.index')->withMaterials($material)->withMaterialsCategories($materialsCategories);
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

       if($request->file('img') != null) {

            $material->img = $this->uploadFile('img', public_path('img/feltetek/'), $request)["filename"];
       }

       if($request->file('gen_img') != null) {

        $material->gen_img = $this->uploadFile('gen_img', public_path('img/generated_feltetek/'), $request)["filename"];
        }

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

        if($request->file('img') != null) {
            $material->img = $this->uploadFile('img', public_path('img/feltetek/'), $request)["filename"];
        }

        if($request->file('gen_img') != null) {
            $material->gen_img = $this->uploadFile('gen_img', public_path('img/generated_feltetek/'), $request)["filename"];
        }

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

    public function materialsByIDs(Request $request){

        $feltetek = json_decode($request->feltetek);

        $feltetekResult = [];

        foreach ($feltetek as $id) {
            $material = Material::find($id);

            if(!isset($material)){

                LogManager::shared()->addLog("Material controller, materialsByIDs, feltetId: " . $id . " NOT DEFINED");
                $feltetekResult[] = "UNDEFINED";
                continue;

            }

            $feltetekResult[] = $material->name;
        }

        return response()->json(['feltetek' => $feltetekResult]);

    }

    public function setMaterialsCategory(Request $request){
        if(!$request->materials_id && !$request->category_id && $request->category_id == 0)
            return;

        $material = Material::find($request->materials_id);

        $material->category_id= $request->category_id;

        $material->save();

        return response()->json(['msg' => 'Material Category updated!']);
    }

}
