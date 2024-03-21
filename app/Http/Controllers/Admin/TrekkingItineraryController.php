<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TrekkingItinerary;
use Illuminate\Http\Request;

class TrekkingItineraryController extends Controller
{
    public function index($trekking_id){
        $trekkingItineraries = TrekkingItinerary::where('trekking_id',$trekking_id)->get();
        return view('pages.trekking-itinerary.index',compact('trekkingItineraries','trekking_id'));
    }
    public function store(Request $request){
        $request->validate([
            'day' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'answer' => 'nullable|string',
            'trekking_id' => 'required|exists:trekkings,id',
        ]);
        $trekkingItinerary = new TrekkingItinerary();
        $trekkingItinerary->day = $request->day;
        $trekkingItinerary->title = $request->title;
        $trekkingItinerary->answer = $request->answer;
        $trekkingItinerary->trekking_id = $request->trekking_id;
        $trekkingItinerary->save();
        drakify('success');
        return redirect()->route('admin.trekking.itinerary.index',$trekkingItinerary->trekking_id);
    }
    public function update(Request $request,$id){
        $request->validate([
            'day' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'answer' => 'nullable|string',
            'trekking_id' => 'required|exists:trekkings,id',
        ]);
        $trekkingItinerary = TrekkingItinerary::findOrFail($id);
        $trekkingItinerary->day = $request->day;
        $trekkingItinerary->title = $request->title;
        $trekkingItinerary->answer = $request->answer;
        $trekkingItinerary->trekking_id = $request->trekking_id;
        $trekkingItinerary->save();
        drakify('success');
        return redirect()->route('admin.trekking.itinerary.index',$trekkingItinerary->trekking_id);
    }
    public function destroy($id){
        $trekkingItinerary = TrekkingItinerary::findOrFail($id);
        $trekkingItinerary->delete();
        drakify('success');
        return redirect()->route('admin.trekking.itinerary.index',$trekkingItinerary->trekking_id);
    }
}
