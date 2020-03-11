<?php

namespace App\Http\Controllers;

use App\RawPizza;
use Illuminate\Http\Request;

class RawPizzaController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RawPizza  $rawPizza
     * @return \Illuminate\Http\Response
     */
    public function show(RawPizza $rawPizza)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RawPizza  $rawPizza
     * @return \Illuminate\Http\Response
     */
    public function edit(RawPizza $rawPizza)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RawPizza  $rawPizza
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RawPizza $rawPizza)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RawPizza  $rawPizza
     * @return \Illuminate\Http\Response
     */
    public function destroy(RawPizza $rawPizza)
    {
        //
    }
}
