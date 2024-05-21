<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TourEnquiry;
use App\Models\TrekkingEnquiry;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    public function tour(){
        $enquiries = TourEnquiry::latest()->get();
        return view('pages.enquiry.tour',compact('enquiries'));
    }

    public function tourDelete($id){
        $data = TourEnquiry::findOrFail($id);
        $data->delete();
        drakify('success');
        return redirect()->route('admin.enquiry.tour.index');
    }

    public function trekking(){
        $enquiries = TrekkingEnquiry::latest()->get();
        return view('pages.enquiry.trekking',compact('enquiries'));
    }

    public function trekkingDelete($id){
        $data = TrekkingEnquiry::findOrFail($id);
        $data->delete();
        drakify('success');
        return redirect()->route('admin.enquiry.trekking.index');
    }
}
