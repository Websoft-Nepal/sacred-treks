<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TourPage;
use Illuminate\Http\Request;

class TourPageController extends Controller
{
    public function index(){
        $tour = TourPage::first();
        $tour = optional($tour);
        return view('display-pages.tour-page.index',compact('tour'));
    }
    public function update(Request $request,$id){
        $request->validate([
            'itinerary_quotes' => 'required|string',
        ]);
        $tour = TourPage::findOrFail($id);
        $tour->itinerary_quotes = $request->itinerary_quotes;
        $tour->save();
        drakify('success');
        return redirect()->route('admin.page.tour.index');

    }
    public function destroy($id){
        $tour = TourPage::findOrFail($id);
        $tour->delete();
        drakify('success');
        return redirect()->route('admin.page.tour.index');

    }
}
