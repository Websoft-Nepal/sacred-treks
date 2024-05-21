<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends BaseController
{
    public function index()
    {
        $galleries = Gallery::all();
        return view('pages.gallery.index',compact('galleries'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:5120',
            'category' => 'required|string|max:200',
        ]);
        $gallery = new Gallery();
        $gallery->category = $request->category;

        $gallery->image = $this->uploadImage($request->image, "uploads/gallery");
        $gallery->save();
        drakify('success');
        return redirect()->route('admin.gallery.index');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'image|max:5120',
            'category' => 'required|string|max:200',
        ]);
        $gallery = Gallery::findOrFail($id);
        if ($request->hasFile('image')) {
            // Delete the previous image if exists
            if ($gallery->image) {
                $tem = strtolower($gallery->image);
                if (!($tem[0] == 'h' && $tem[1] == 't' && $tem[2] == 't' && $tem[3] == 'p')) {

                    try {
                        $tem = explode('/', $gallery->image);
                        $n = count($tem);
                        $filePath = storage_path('app/public/uploads/gallery/' . $tem[$n - 1]);
                        // $filePath = storage_path('app/public/uploads/tour/' . $gallery->image);
                        unlink($filePath);
                    } catch (\Exception $e) {
                        // Handle deletion error
                        // dd($e->getMessage());
                    }
                }
            }
            // Upload the new image
            // $gallery->image = $request->file('image')->store('uploads/tour');
            $gallery->image = $this->uploadImage($request->image, "uploads/gallery");
            $gallery->category = $request->category;
        }
        $gallery->save();
        drakify('success');
        return redirect()->route('admin.gallery.index');
    }
    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);
        if ($gallery->image) {
            $tem = strtolower($gallery->image);
            if (!($tem[0] == 'h' && $tem[1] == 't' && $tem[2] == 't' && $tem[3] == 'p')) {

                try {
                    $tem = explode('/', $gallery->image);
                    $n = count($tem);
                    $filePath = storage_path('app/public/uploads/gallery/' . $tem[$n - 1]);
                    // $filePath = storage_path('app/public/uploads/tour/' . $gallery->image);
                    unlink($filePath);
                } catch (\Exception $e) {
                    // Handle deletion error
                    // dd($e->getMessage());
                }
            }
        }
        $gallery->delete();
        drakify("success");
        return redirect()->route("admin.gallery.index");
    }
}
