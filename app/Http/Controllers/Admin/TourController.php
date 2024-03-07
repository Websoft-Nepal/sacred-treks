<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TourController extends BaseController
{
    public function index()
    {
        $tours = Tour::latest()->paginate(10);
        return view('pages.tour.index', compact('tours'));
    }

    public function create()
    {
        return view('pages.tour.create');
    }

    public function store(Request $request)
    {
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

        drakify('success');

        return redirect()->route('admin.tour.index');
    }

    public function show($id)
    {
        $tour = Tour::findOrFail($id);
        return view('pages.tour.view', compact('tour'));
    }
    public function edit($id)
    {
        $tour = Tour::findOrFail($id);
        return view('pages.tour.edit', compact('tour'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|max:2048',
            'slug' => $this->slugValidate($request->slug, $id),
            'description' => 'nullable|string',
        ]);
        $tour = Tour::findOrFail($id);
        $tour->title = $request->title;
        $tour->slug = str::slug($request->slug);
        $tour->image = $this->uploadImage($request->uploads('image'), "uploads/tour");
        $tour->description = $request->description;

        // Check if a new image is uploaded
        if ($request->hasFile('image')) {
            // Delete the previous image if exists
            if ($tour->image) {
                try {
                    $filePath = storage_path('app/public/uploads/tour/' . $tour->image);
                    unlink($filePath);
                } catch (\Exception $e) {
                    // Handle deletion error
                    dd($e->getMessage());
                }
            }
            // Upload the new image
            $tour->image = $request->file('image')->store('uploads/tour');
            $tour->save();

            drakify('success');

            return redirect()->route('admin.tour.index');
        }
    }

    public function destroy($id)
    {
        $tour = Tour::findOrFail($id);

        if ($tour->image) {
            try {
                // Storage::delete($tour->image);
                $filePath = storage_path('app/public/uploads/tour/' . $tour->image);
                unlink($filePath);
            } catch (\Exception $e) {
                // Handle deletion error
                dd($e->getMessage());
            }
        }
        $tour->delete();

        drakify('success');

        return redirect()->route('admin.tour.index');
    }
}
