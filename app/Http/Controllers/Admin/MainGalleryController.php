<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Models\MainGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MainGalleryController extends BaseController
{
    public function index()
    {
        $galleries = MainGallery::all();
        return view('pages.main-gallery.index', compact('galleries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:5120',
            'title' => 'required',
        ]);
        $gallery = new MainGallery();
        $gallery->image = $this->uploadImage($request->image, "uploads/gallery");
        $gallery->title = $request->title;
        $gallery->save();
        drakify('success');
        return redirect()->route('admin.maingallery.index');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'sometimes|image|max:5120',
            'title' => 'required',
        ]);
        $gallery = MainGallery::findOrFail($id);
        if ($request->hasFile('image')) {
            // Delete the previous image if exists
            if ($gallery->image) {


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
            $gallery->image = $this->uploadImage($request->image, "uploads/gallery");
            $gallery->title = $request->title;
        }
        $gallery->save();
        drakify('success');
        return redirect()->route('admin.maingallery.index');
    }

    public function destroy($id)
    {
        $gallery = MainGallery::findOrFail($id);
        $gallery->delete();

        drakify('success');

        return redirect()->route('admin.maingallery.index');
    }
    public function trash()
    {
        $galleries = MainGallery::onlyTrashed()->get();
        return view('pages.main-gallery.trash', compact('galleries'));
    }
    public function restore($id)
    {
        $gallery = MainGallery::withTrashed()->findOrFail($id);
        $gallery->restore();
        drakify('success');
        return redirect()->route('admin.maingallery.index');
    }

    public function forceDelete($id)
    {
        $gallery = MainGallery::withTrashed()->findOrFail($id);
        if ($gallery->image) {
            try {
                $tem = explode('/', $gallery->image);
                $n = count($tem);
                $filePath = "uploads/blog/" . $tem[$n - 1];
                // $filePath = storage_path('app/public/uploads/blog/' . $gallery->image);
                unlink($filePath);
            } catch (\Exception $e) {
                Log::warning("Blog Image deletion failed. Error message => " . $e->getMessage());
            }
        }
        $gallery->forceDelete();
        drakify('success');
        return redirect()->route('admin.maingallery.trash');
    }
}
