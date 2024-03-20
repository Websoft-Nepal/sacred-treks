<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TrekkingBooking;
use Illuminate\Http\Request;

class TrekkingBookingController extends Controller
{
    public function index(){
        $trekkingBookings = TrekkingBooking::all();
        return view('pages.trekking-booking.index',compact('trekkingBookings'));
    }

    public function show($id){
        $trekkingBooking = TrekkingBooking::findOrFail($id);
        return view('pages.trekking-booking.view',compact('trekkingBooking'));
    }

    public function update($id){
        $trekkingBooking = TrekkingBooking::findOrFail($id);
        $trekkingBooking->status = 'verify';
        $trekkingBooking->update();
        drakify('success');
        return redirect()->route('admin.trekking.booking.index');
    }

    public function destroy($id){
        $trekkingBooking = TrekkingBooking::findOrFail($id);
        $trekkingBooking->delete();
        drakify('success');
        return redirect()->route('admin.trekking.booking.index');
    }
}
