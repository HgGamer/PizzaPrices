<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Website;
use Illuminate\Http\Request;

class WebsitesController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $websites = Website::orderBy('id', 'DESC')->paginate(10);

        return view('dashboard.website.index')->withWebsites($websites);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.website.create');
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
            'url' => 'required',
            'logo' => 'required'
        ]);

        $website = new Website;

        $website->title = $request->input('title');

        $website->url = $request->input('url');

        if($request->input('delivery_prices') != null) {
            $website->delivery_prices = $request->input('delivery_prices');
        }

        if($request->input('other_infos') != null) {
            $website->other_infos = $request->input('other_infos');
        }

        $website->logo = $this->uploadFile('logo', public_path('uploads/'), $request)["filename"];

        $website->save();

        return redirect()->route('websites.index');
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
        return view('dashboard.website.edit')->withWebsite(Website::find($id));
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
            'url' => 'required'
        ]);

        $website = Website::find($id);

        $website->title = $request->input('title');

        $website->url = $request->input('url');

        if($request->input('delivery_prices') != null) {
            $website->delivery_prices = $request->input('delivery_prices');
        }

        if($request->input('other_infos') != null) {
            $website->other_infos = $request->input('other_infos');
        }

        if($request->file('logo') != null) {

            $website->logo = $this->uploadFile('logo', public_path('uploads/'), $request)["filename"];
        }

        $website->save();

        return redirect()->route('websites.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $website = Website::find($id);
        $website->delete();

        return redirect()->route('websites.index')
                        ->with('success','Website deleted successfully');
    }
}
