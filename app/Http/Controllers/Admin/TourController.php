<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use Illuminate\Http\Request;

class TourController extends Controller
{
    public function index(){
        $tours = Tour::latest()->paginate(10);
        return view('pages.tour.index',compact('tours'));
    }

    public function create(){
        return view('pages.tour.create');
    }

    
}
