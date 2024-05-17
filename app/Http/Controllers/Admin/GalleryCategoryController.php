<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Models\GalleryCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class GalleryCategoryController extends BaseController
{
    public function index()
    {
        $galleries = GalleryCategory::all();
        return view('pages.main-gallery.category', compact('galleries'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:5096',
            'category' => 'required|string',
        ]);
        $gallery = new GalleryCategory();
        $gallery->image = $this->uploadImage($request->image, 'uploads/gallery');
        $gallery->category = $request->category;
        $gallery->slug = $this->generateSlug($request->category,$gallery);
        $gallery->save();
        drakify('success');
        return redirect()->route('admin.gallerycategory.index');
    }
    public function update(Request $request, $id)
    {
        $gallery = GalleryCategory::findOrFail($id);
        $request->validate([
            'image' => 'sometimes|image|max:5096',
            'category' => 'required|string',
            'slug' => $this->slugValidate("gallery_categories", $id),
        ]);
        $gallery->category = $request->category;
        $gallery->slug = str::slug($request->slug);
        if($request->hasFile('image')){
            if ($gallery->image) {
                try {
                    unlink($gallery->image);
                } catch (\Exception $e) {
                    Log::error("Gallery Category image deletion.\n Error => " . $e->getMessage());
                }

            }
            $gallery->image = $this->uploadImage($request->image,"uploads/gallery");
        }
        $gallery->save();
        drakify('success');
        return redirect()->route('admin.gallerycategory.index');
    }

    public function destroy($id){
        $gallery = GalleryCategory::findOrFail($id);
        if($gallery->image){
            try {
                unlink($gallery->image);
            } catch (\Exception $e) {
                Log::error("Gallery Category image deletion.\n Error => " . $e->getMessage());
            }
        }
        $gallery->delete();
        drakify('success');
        return redirect()->route('admin.gallerycategory.index');
    }
}
