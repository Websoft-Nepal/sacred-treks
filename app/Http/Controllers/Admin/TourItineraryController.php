<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TourItinerary;
use Illuminate\Http\Request;

class TourItineraryController extends Controller
{
    public function index($tour_id){
        $tourItineraries = TourItinerary::where('tour_id',$tour_id)->get();
        return view('pages.tour-itinerary.index',compact('tourItineraries','tour_id'));
    }
    public function store(Request $request){
        $request->validate([
            'day' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'answer' => 'string',
            'tour_id' => 'required|exists:tours,id',
        ]);
        $tourItinerary = new TourItinerary();
        $tourItinerary->day = $request->day;
        $tourItinerary->title = $request->title;
        $tourItinerary->answer = $request->answer;
        $tourItinerary->tour_id = $request->tour_id;
        $tourItinerary->save();
        drakify('success');
        return redirect()->route('admin.tour.itinerary.index',$tourItinerary->tour_id);
    }
    public function update(Request $request,$id){
        $request->validate([
            'day' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'answer' => 'string',
            'tour_id' => 'required|exists:tours,id',
        ]);
        $tourItinerary = TourItinerary::findOrFail($id);
        $tourItinerary->day = $request->day;
        $tourItinerary->title = $request->title;
        $tourItinerary->answer = $request->answer;
        $tourItinerary->tour_id = $request->tour_id;
        $tourItinerary->save();
        drakify('success');
        return redirect()->route('admin.tour.itinerary.index',$tourItinerary->tour_id);
    }
    public function destroy($id){
        $tourItinerary = TourItinerary::findOrFail($id);
        $tourItinerary->delete();
        drakify('success');
        return redirect()->route('admin.tour.itinerary.index',$tourItinerary->tour_id);
    }
}
