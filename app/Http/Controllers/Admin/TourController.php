<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TourController extends BaseController
{
    public function index(){
        $tour = Tour::latest()->paginate(10);
        return view();
    }
    public function create(){

    }
    public function store(Request $request){
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $tour = new Tour();
        $tour->title = $request->title;
        $tour->image = $this->uploadImage($request->image, "uploads/tour");
    }
}
