<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ItemSchema;
use Illuminate\Http\Request;

class ItemSchemaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $itemSchema = ItemSchema::orderBy('id', 'DESC')->paginate(10);

        return view('dashboard.item_schema.index')->withItemSchemas($itemSchema);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.item_schema.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'css_expression' => 'required',
            'full_content_selector' => 'required'
        ]);

        $itemSchema = new ItemSchema;

        $itemSchema->title = $request->input('title');

        if($request->input('pizzaSize') != null) {
            $itemSchema->pizza_size = $request->input('pizzaSize');
        }

        if($request->input('is_full_url') != null) {

            $itemSchema->is_full_url = 1;
        } else {
            $itemSchema->is_full_url = 0;
        }

        $itemSchema->css_expression = $request->input('css_expression');

        $itemSchema->full_content_selector = $request->input('full_content_selector');

        $itemSchema->save();

        return redirect()->route('item-schema.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('dashboard.item_schema.edit')->withItemSchema(ItemSchema::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'css_expression' => 'required',
            'full_content_selector' => 'required'
        ]);

        $itemSchema = ItemSchema::find($id);

        $itemSchema->title = $request->input('title');

        if($request->input('pizzaSize') != null) {
            $itemSchema->pizza_size = $request->input('pizzaSize');
        }

        if($request->input('is_full_url') != null) {

            $itemSchema->is_full_url = 1;
        } else {
            $itemSchema->is_full_url = 0;
        }

        $itemSchema->css_expression = $request->input('css_expression');

        $itemSchema->full_content_selector = $request->input('full_content_selector');

        $itemSchema->save();

        return redirect()->route('item-schema.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $itemSchema = ItemSchema::find($id);
        $itemSchema->delete();

        return redirect()->route('item-schema.index')
                        ->with('success','Item schema deleted successfully');
    }
}
