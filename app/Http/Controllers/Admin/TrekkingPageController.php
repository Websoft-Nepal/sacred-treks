<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TrekkingPage;
use Illuminate\Http\Request;

class TrekkingPageController extends Controller
{
    public function index(){
        $trekking = TrekkingPage::first();
        $trekking = optional($trekking);
        return view('display-pages.trekking-page.index',compact('trekking'));
    }
    public function update(Request $request,$id){
        $request->validate([
            'itinerary_quotes' => 'required|string',
        ]);
        $trekking = TrekkingPage::findOrFail($id);
        $trekking->itinerary_quotes = $request->itinerary_quotes;
        $trekking->save();
        drakify('success');
        return redirect()->route('admin.page.trekking.index');
    }
    public function destroy($id){
        $trekking = TrekkingPage::findOrFail($id);
        $trekking->delete();
        return redirect()->route('admin.page.trekking.index');
    }
}
