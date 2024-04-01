<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use App\Models\Tour;
use App\Models\TourBooking;
use App\Models\Trekking;
use App\Models\TrekkingBooking;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $tourCount = Tour::count();
        $trekkingCount = Trekking::count();
        $tourPending = TourBooking::where('status', 'unverify')->count();
        $trekkingPending = TrekkingBooking::where('status', 'unverify')->count();
        $subscribers = Subscriber::all();
        return view('home', compact('tourCount', 'trekkingCount', 'tourPending', 'trekkingPending', 'subscribers'));
    }

    public function table()
    {
        return view('pages.test.table');
    }
    public function profile()
    {
        return view('pages.profile.index');
    }
    public function updateProfile(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
        ]);
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        drakify('success');
        return redirect()->route('admin.profile');
    }
    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|string|min:8|max:255',
            'password_confirmation' => 'required|same:password',
        ]);

        $user = User::findOrFail($id);
        $user->password = bcrypt($request->password);
        $user->save();

        drakify('success');
        return redirect()->route('admin.profile');
    }
}
