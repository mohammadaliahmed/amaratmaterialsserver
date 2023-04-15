<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Locations;
use App\Models\SubLocations;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LocationController extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->isMethod('post')) {
            Locations::create([
                'name'=>$request->name
            ]);
            return redirect()->back();
        } else {
            $locations = Locations::all();
            return view('locations.index',compact('locations'));
        }
    }
    public function deleteLocation(Request $request,$id){
        Locations::find($id)->delete();
        return redirect()->back();
    }
    public function updateLocation(Request $request,$id){
        $location=Locations::find($id);
        $location->name=$request->name;
        $location->update();
        return redirect()->back();
    }

    public function deleteSubLocation(Request $request,$id){
        SubLocations::find($id)->delete();
        return redirect()->back();
    }
    public function updateSubLocation(Request $request,$id){
        $subLocation=SubLocations::find($id);
        $subLocation->name=$request->name;
        $subLocation->update();
        return redirect()->back();
    }
    public function addSubLocation(Request  $request,$id){

        if ($request->isMethod('post')) {
            SubLocations::create([
                'name'=>$request->name,
                'location_id'=>$id,
            ]);
            return redirect()->back();
        } else {
            $location=Locations::find($id);
            $subLocations = SubLocations::where('location_id',$id)->get();
            return view('locations.subLocation',compact('location','subLocations'));
        }
    }
}
