<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TourTransportation;
use Illuminate\Http\Request;

class TourTransportationController extends Controller
{
    public function index(){
        $transportations = TourTransportation::paginate(10);
        return view('pages.tour.transportation.index',compact('transportations'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $transportation = new TourTransportation();
        $transportation->name = $request->name;
        $transportation->save();

        return redirect()->route('admin.transportation.index');
    }

    public function update(Request $request,$id){
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $transportation = TourTransportation::findOrFail($id);
        $transportation->name = $request->name;
        $transportation->update();

        return redirect()->route('admin.transportation.index');
    }

    public function destroy($id){
        $transportation = TourTransportation::findOrFail($id);
        $transportation->delete();

        return redirect()->route('admin.transportation.index');
    }
}
