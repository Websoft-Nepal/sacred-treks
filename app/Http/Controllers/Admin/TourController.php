<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Models\Tour;
use App\Models\TourTransportation;
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
        $transportations = TourTransportation::all();
        return view('pages.tour.create', ['transportations' => $transportations]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'in:on',
            'image' => 'required|image|max:2048',
            'map' => 'image|max:2048',
            'duration' => 'required|string|max:255',
            'place' => 'required|string|max:255',
            'cost' => 'required|numeric',
            'boundary' => 'required|in:national,international',
            'transportation_id' => 'required|exists:tour_transportations,id',
            'description' => 'nullable|string',
        ]);
        $tour = new Tour();
        $tour->title = $request->title;
        $tour->status = $request->has('status') ? true : false;
        $tour->duration = $request->duration;
        $tour->cost = $request->cost;
        $tour->place = $request->place;
        $tour->boundary = $request->boundary;
        $tour->transportation_id = $request->transportation_id;
        $tour->slug = $this->generateSlug($request->title, $tour);
        $tour->image = $this->uploadImage($request->image, "uploads/tour");
        if ($request->hasFile('map')) {
            $tour->map = $this->uploadImage($request->map, "uploads/tour");
        }
        $tour->description = $request->description;
        $tour->save();

        drakify('success');

        return redirect()->route('admin.tour.index');
    }

    public function show($id)
    {
        $tour = Tour::with('transportation')->findOrFail($id);
        return view('pages.tour.view', ['tour' => $tour]);
    }
    public function edit($id)
    {
        $transportations = TourTransportation::all();
        $tour = Tour::findOrFail($id);
        return view('pages.tour.edit', compact('tour', 'transportations'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'in:on',
            'image' => 'image|max:2048',
            'map' => 'image|max:2048',
            'duration' => 'required|string|max:255',
            'place' => 'required|string|max:255',
            'cost' => 'required|numeric',
            'boundary' => 'required|in:national,international',
            'transportation_id' => 'required|exists:tour_transportations,id',
            'slug' => $this->slugValidate("tours", $id),
            'description' => 'nullable|string',
        ]);
        $tour = Tour::findOrFail($id);
        $tour->title = $request->title;
        $tour->status = $request->has('status') ? true : false;
        $tour->duration = $request->duration;
        $tour->cost = $request->cost;
        $tour->place = $request->place;
        $tour->boundary = $request->boundary;
        $tour->transportation_id = $request->transportation_id;
        $tour->slug = str::slug($request->slug);
        $tour->description = $request->description;

        // Check if a new image is uploaded
        if ($request->hasFile('image')) {
            // Delete the previous image if exists
            if ($tour->image) {
                try {
                    $tem = explode('/', $tour->image);
                    $n = count($tem);
                    $filePath = storage_path('app/public/uploads/tour/' . $tem[$n - 1]);
                    // $filePath = storage_path('app/public/uploads/tour/' . $tour->image);
                    unlink($filePath);
                } catch (\Exception $e) {
                    // Handle deletion error
                    dd($e->getMessage());
                }
            }
            // Upload the new image
            // $tour->image = $request->file('image')->store('uploads/tour');
            $tour->image = $this->uploadImage($request->image, "uploads/tour");
        }

        // Check if a map is uploaded
        if ($request->hasFile('map')) {
            // Delete the previous image if exists
            if ($tour->map) {
                try {
                    $tem = explode('/', $tour->map);
                    $n = count($tem);
                    $filePath = storage_path('app/public/uploads/tour/' . $tem[$n - 1]);
                    // $filePath = storage_path('app/public/uploads/tour/' . $tour->map);
                    // $filePath = $tour->map;
                    unlink($filePath);
                } catch (\Exception $e) {
                    // Handle deletion error
                    dd($e->getMessage());
                }
            }
            // Upload the new image
            // $tour->image = $request->file('image')->store('uploads/tour');
            $tour->image = $this->uploadImage($request->map, "uploads/tour");
        }
        $tour->save();

        drakify('success');

        return redirect()->route('admin.tour.index');
    }

    public function destroy($id)
    {
        $tour = Tour::findOrFail($id);

        if ($tour->image) {
            try {
                // Storage::delete($tour->image);
                $tem = explode('/', $tour->image);
                $n = count($tem);
                $filePath = storage_path('app/public/uploads/tour/' . $tem[$n - 1]);
                // $filePath = storage_path('app/public/uploads/tour/' . $tour->image);
                unlink($filePath);
            } catch (\Exception $e) {
                // Handle deletion error
                dd($e->getMessage());
            }
        }
        if ($tour->map) {
            try {
                // Storage::delete($tour->image);
                $filePath = storage_path('app/public/uploads/tour/' . $tour->map);
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
