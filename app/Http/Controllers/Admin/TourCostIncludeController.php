<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TourCostInclude;
use Illuminate\Http\Request;

class TourCostIncludeController extends Controller
{
    public function index($tour_id){
        $tourCost = TourCostInclude::where('tour_id',$tour_id)->first();
        return view('pages.tour-cost-details.index',compact('tourCost','tour_id'));
    }
    public function store(Request $request){
        $request->validate([
            'tour_id' => 'required|exists:tours,id',
            'description' => 'string',
        ]);
        $tourCost = new TourCostInclude();
        $tourCost->tour_id = $request->tour_id;
        $tourCost->description = $request->description;
        $tourCost->save();
        drakify('success');
        return redirect()->route('admin.tour.cost.index',$tourCost->tour_id);
    }
    public function update(Request $request,$id){
        $request->validate([
            'tour_id' => 'required|exists:tours,id',
            'description' => 'string',
        ]);
        $tourCost = TourCostInclude::findOrFail($id);
        $tourCost->tour_id = $request->tour_id;
        $tourCost->description = $request->description;
        $tourCost->save();
        drakify('success');
        return redirect()->route('admin.tour.cost.index',$tourCost->tour_id);
    }
    public function destroy($id){
        $tourCost = TourCostInclude::findOrFail($id);
        $tourCost->delete();
        return redirect()->route('admin.tour.cost.index',$tourCost->tour_id);
    }
}
