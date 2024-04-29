<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Models\aboutus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AboutUsController extends BaseController
{
    public function index(){
        $about = aboutus::first();
        return view('pages.about_us.index',compact('about'));
    }
    public function update(Request $request , $id){
      $request->validate([
        'title' => 'string|required',
        'image' => 'image|max:2048',
        'caption' => 'string',
        'description' => 'required',
      ]);

      $about = aboutus::findorFail($id);
         $about->title = $request->title;
         $about->description = $request->description;
         $about->caption = $request->caption;
         if ($request->hasFile('image')) {
            // Delete the previous image if exists
            if ($about->image) {
                try {
                    $tem = explode('/', $about->image);
                    $n = count($tem);
                    $filePath = "uploads/home/" . $tem[$n - 1];
                    // $filePath = storage_path('app/public/uploads/blog/' . $about->image);
                    unlink($filePath);
                } catch (\Exception $e) {
                    // Handle deletion error
                    Log::warning("Blog Image deletion failed. Error message => " . $e->getMessage());
                }
            }
            // Upload the new image
            // $about->image = $request->file('image')->store('uploads/blog');
            $about->image = $this->uploadImage($request->image, "uploads/home");
        }
         $about->update();
         return redirect()->route('admin.about.index');
    }
}
