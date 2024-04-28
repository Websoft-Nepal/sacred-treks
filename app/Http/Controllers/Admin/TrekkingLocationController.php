<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TrekkingLocation;
use Illuminate\Http\Request;

class TrekkingLocationController extends Controller
{
    public function index(){
        $locations = TrekkingLocation::all( );
        return view('pages.trekking.location.index',compact('locations'));
    }

    public function store(Request $request){
        $request->validate([
            'location'=>'required|string|max:255',
        ]);
        $location = new TrekkingLocation();
        $location->location = $request->location;
        $location->save();

        if(TrekkingLocation::where('location'))

        return redirect()->route('admin.location.index');
    }

    public function update(Request $request,$id){
        $request->validate([
            'location'=>'required|string|max:255',
        ]);
        $location = TrekkingLocation::findOrFail($id);
        $location->location = $request->location;
        $location->update();

        return redirect()->route('admin.location.index');

    }

    public function destroy($id){
        $location = TrekkingLocation::findOrFail($id);
        $location->delete();
        return redirect()->route('admin.location.index');
    }
}
