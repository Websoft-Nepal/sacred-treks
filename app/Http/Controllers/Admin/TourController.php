<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TourController extends BaseController
{
    public function index(){
        $tours = Tour::latest()->paginate(10);
        return view('pages.tour.index',compact('tours'));
    }

    public function create(){
        return view('pages.tour.create');
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|max:255',
            'description' => 'nullable|string',
        ]);
        $tour = new Tour();
        $tour->title = $request->title;
        $tour->slug = $this->generateSlug($request->title, $tour);
        $tour->image = $this->uploadImage($request->image, "uploads/tour");
        $tour->description = $request->description;
        $tour->save();
        return redirect()->route('admin.tour.index');
    }

    public function show($id){

    }
    public function edit($id){
        $tour = Tour::findOrFail($id);
        return redirect();
    }

    public function update(Request $request,$id){

    }

    public function destroy($id){

    }
}
