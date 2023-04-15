<?php

namespace App\Http\Controllers;

use App\Models\Sites;
use Illuminate\Http\Request;

class SitesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createSite($id)
    {
        return view('customers.sitecreate', compact('id'));

    }

    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('customers.sitecreate');
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        Sites::create([
            'name' => $request->name,
            'address' => $request->address,
            'city' => $request->city,
            'details' => $request->details,
            'customer_id' => $request->customerId,
        ]);

        return redirect()->back()->with('success', __('Site successfully updated.'));


        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Sites $site)
    {
        //
        return view('customers.siteedit', compact('site'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sites $site)
    {
        //

        $site->name=$request->name;
        $site->address=$request->address;
        $site->city=$request->city;
        $site->details=$request->details;
        $site->save();

        return redirect()->back()->with('success', __('Site successfully updated.'));


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sites $site)
    {
        //
        $site->delete();

        return redirect()->back()->with('success', __('Site successfully deleted.'));
    }
}
