<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\aboutus;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function index(){
        $about = aboutus::first();
        return view('pages.about_us.index',compact('about'));
    }
    public function update(Request $request , $id){
      $request->validate([
        'title' => 'string|required',
        'description' => 'required',
      ]);

      $about = aboutus::findorFail($id);
         $about->title = $request->title;
         $about->description = $request->description;
         $about->update();
         return redirect()->route('admin.about.index');
    }
}
