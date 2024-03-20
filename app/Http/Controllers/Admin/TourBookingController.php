<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TourBooking;
use Illuminate\Http\Request;

class TourBookingController extends Controller
{
    public function index(){
        $tourBookings = TourBooking::all();
        return view('pages.tour-booking.index',compact('tourBookings'));
    }

    public function show($id){
        $tourBooking = TourBooking::findOrFail($id);
        return view('pages.tour-booking.view',compact('tourBooking'));
    }

    public function update($id){
        $tourBooking = TourBooking::findOrFail($id);
        $tourBooking->status = 'verify';
        $tourBooking->update();
        drakify('success');
        return redirect()->route('admin.tour.booking.index');
    }

    public function destroy($id){
        $tourBooking = TourBooking::findOrFail($id);
        $tourBooking->delete();
        drakify('success');
        return redirect()->route('admin.tour.booking.index');
    }
}
