<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\testimonial;
use Illuminate\Http\Request;

class TestimonialController extends BaseController
{
    public function index()
    {
        $testimonials = testimonial::latest()->paginate(20);
        return view('pages.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('pages.testimonials.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'review' => 'required|numeric|max:5|min:0',
            'description' => 'required|string',
            'image' => 'required|image|max:5120',
        ]);

        $testimonial = new testimonial();
        $testimonial->name = $request->name;
        $testimonial->review = $request->review;
        $testimonial->description = $request->description;
        $testimonial->image = $this->uploadImage($request->image, "uploads/testimonials");
        $testimonial->save();
        return redirect()->route('admin.testimonial.index');
    }

    public function show($id)
    {
        $testimonial = testimonial::findorFail($id);
        return view('pages.testimonials.show', compact('testimonial'));
    }

    public function edit($id)
    {
        $testimonial = testimonial::findorFail($id);
        return view('pages.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'review' => 'required|numeric|max:5|min:0',
            'description' => 'required|string',
            'image' => 'image|max:2048',
        ]);

        $testimonial = testimonial::findorFail($id);
        $testimonial->name = $request->name;
        $testimonial->review = $request->review;
        $testimonial->description = $request->description;
        $testimonial->status = $request->has('status') ? $request->status : $testimonial->status;
        if ($request->hasFile('image')) {
            // Delete the previous image if exists
            if ($testimonial->image) {
                try {
                    $tem = explode('/', $testimonial->image);
                    $n = count($tem);
                    $filePath = "uploads/testimonial/" . $tem[$n - 1];
                    // $filePath = storage_path('app/public/uploads/testimonials/' . $testimonial->image);
                    unlink($filePath);
                } catch (\Exception $e) {
                    // Handle deletion error
                    dd($e->getMessage());
                }
            }
            // Upload the new image
            $testimonial->image = $request->file('image')->store('uploads/testimonials');
        }

        $testimonial->update();
        return redirect()->route('admin.testimonial.index');
    }

    public function destroy($id)
    {
        $testimonial = testimonial::findorFail($id);
        if ($testimonial->image) {
            try {

                $tem = explode('/', $testimonial->image);
                $n = count($tem);
                $filePath = "uploads/testimonial/" . $tem[$n - 1];
                // $filePath = storage_path('app/public/uploads/testimonials/' . $testimonial->image);
                unlink($filePath);
            } catch (\Exception $e) {
                // dd($e->getMessage());
            }
        }
        $testimonial->delete();
        return redirect()->route('admin.testimonial.index');
    }
}
