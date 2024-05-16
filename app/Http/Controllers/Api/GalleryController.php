<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GalleryCategory;
use App\Models\MainGallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        try {
            $galleries = MainGallery::with('category')->get();
            foreach ($galleries as $gallery) {
                $gallery['image'] = $this->HttpImage('image', $gallery);
            }
            return $this->SendResponse($galleries, "gallerys fetched successfully.");
        } catch (\Throwable $th) {
            return $this->SendError(throw $th, "Cannot fetch gallerys data.", 500);
        }
    }
    public function category(){
        try{
            $categories = GalleryCategory::all();
            return $this->SendResponse($categories, "Categories fetched successfully.");
        }catch(\Throwable $th) {
            return $this->SendError(throw $th, "Cannot fetch category data.", 500);
        }
    }
    public function galleryCategory($slug)
    {
        try {
            $category = GalleryCategory::where('slug', $slug)->get();
            $galleries = MainGallery::where('category_id', $category->id)->with('category')->get();
            return $this->SendResponse($galleries, "Gallaries fetched successfully.");
        } catch (\Throwable $th) {
            return $this->SendError(throw $th, "Cannot fetch gallery data.", 500);
        }
    }

    public function show($slug)
    {
        try {
            $gallery = MainGallery::where('slug', $slug)->first();
            return $this->SendResponse($gallery, "Gallaries fetched successfully.");
        } catch (\Throwable $th) {
            return $this->SendError(throw $th, "Cannot fetch gallery data.", 500);
        }
    }
}
