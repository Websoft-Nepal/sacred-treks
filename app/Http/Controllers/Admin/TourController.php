<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Models\Tour;
use App\Models\TourCostInclude;
use App\Models\TourTransportation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class TourController extends BaseController
{
    public function index()
    {
        $tours = Tour::latest()->get();
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
            'image' => 'required|image|max:5120',
            'map' => 'image|max:5120',
            'featureimg1' => 'image|max:5120',
            'featureimg2' => 'image|max:5120',
            'duration' => 'required|string|max:255',
            'place' => 'required|string|max:255',
            'cost' => 'required|numeric',
            'boundary' => 'required|in:national,international',
            'transportation_id' => 'required|exists:tour_transportations,id',
            'description' => 'nullable|string',
            'costDescription' => 'nullable|string',
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
        if($request->hasFile('featureimg1')){
            $tour->featureimg1 = $this->uploadImage($request->featureimg1, "uploads/tour");
        }

        if($request->hasFile("featureimg2")){
            $tour->featureimg2 = $this->uploadImage($request->featureimg2, "uploads/tour");
        }
        $tour->description = $request->description;
        $tour->save();

        $tourCost = new TourCostInclude();
        $tourCost->description = $request->costDescription;
        $tourCost->tour_id = $tour->id;
        $tourCost->save();

        drakify('success');

        return redirect()->route('admin.tour.index');
    }

    public function show($id)
    {
        $tour = Tour::with('transportation')->findOrFail($id);
        $tourCost = TourCostInclude::where('tour_id',$id)->first();
        $tourCost = optional($tourCost);
        return view('pages.tour.view', ['tour' => $tour,'tourCost' => $tourCost]);
    }
    public function edit($id)
    {
        $transportations = TourTransportation::all();
        $tour = Tour::findOrFail($id);
        $tourCost = TourCostInclude::where('tour_id',$id)->first();
        $tourCost = optional($tourCost);

        return view('pages.tour.edit', compact('tour', 'transportations','tourCost'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'in:on',
            'image' => 'image|max:5120',
            'featureimg1' => 'image|max:5120',
            'featureimg2' => 'image|max:5120',
            'map' => 'image|max:5120',
            'duration' => 'required|string|max:255',
            'place' => 'required|string|max:255',
            'cost' => 'required|numeric',
            'boundary' => 'required|in:national,international',
            'transportation_id' => 'required|exists:tour_transportations,id',
            'slug' => $this->slugValidate("tours", $id),
            'description' => 'nullable|string',
            'costDescription' => 'nullable|string',
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
                $tem = strtolower($tour->image);
                if (!($tem[0] == 'h' && $tem[1] == 't' && $tem[2] == 't' && $tem[3] == 'p')) {

                    try {
                        $tem = explode('/', $tour->image);
                        $n = count($tem);
                        $filePath = "uploads/tour/".$tem[$n-1];
                        // $filePath = storage_path('app/public/uploads/tour/' . $tem[$n - 1]);
                        // $filePath = storage_path('app/public/uploads/tour/' . $tour->image);
                        unlink($filePath);
                    } catch (\Exception $e) {
                        // Handle deletion error
                        Log::warning("Tour Image deletion failed. Error message => ".$e->getMessage());
                    }
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
                $tem = strtolower($tour->map);
                if (!($tem[0] == 'h' && $tem[1] == 't' && $tem[2] == 't' && $tem[3] == 'p')) {

                    try {
                        $tem = explode('/', $tour->map);
                        $n = count($tem);
                        $filePath = "uploads/tour/".$tem[$n-1];
                        // $filePath = storage_path('app/public/uploads/tour/' . $tem[$n - 1]);
                        // $filePath = storage_path('app/public/uploads/tour/' . $tour->map);
                        unlink($filePath);
                    } catch (\Exception $e) {
                        // Handle deletion error
                        Log::warning("Tour Image deletion failed. Error message => ".$e->getMessage());
                    }
                }
            }
            // Upload the new image
            // $tour->image = $request->file('image')->store('uploads/tour');
            $tour->image = $this->uploadImage($request->map, "uploads/tour");
        }

        if ($request->hasFile('featureimg1')) {
            if ($tour->featureimg1) {
                $tem = strtolower($tour->featureimg1);
                if (!($tem[0] == 'h' && $tem[1] == 't' && $tem[2] == 't' && $tem[3] == 'p')) {

                    try {
                        $tem = explode('/', $tour->featureimg1);
                        $n = count($tem);
                        $filePath = "uploads/tour/".$tem[$n-1];
                        // $filePath = storage_path('app/public/uploads/tour/' . $tem[$n - 1]);
                        // $filePath = storage_path('app/public/uploads/tour/' . $tour->image);
                        unlink($filePath);
                    } catch (\Exception $e) {
                        // Handle deletion error
                        Log::warning("Tour Image deletion failed. Error message => ".$e->getMessage());
                    }
                }
            }
            $tour->featureimg1 = $this->uploadImage($request->featureimg1, "uploads/tour");
        }

        if ($request->hasFile("featureimg2")) {
            if ($tour->featureimg2) {
                $tem = strtolower($tour->featureimg2);
                if (!($tem[0] == 'h' && $tem[1] == 't' && $tem[2] == 't' && $tem[3] == 'p')) {

                    try {
                        $tem = explode('/', $tour->featureimg2);
                        $n = count($tem);
                        $filePath = "uploads/tour/".$tem[$n-1];
                        // $filePath = storage_path('app/public/uploads/tour/' . $tem[$n - 1]);
                        // $filePath = storage_path('app/public/uploads/tour/' . $tour->image);
                        unlink($filePath);
                    } catch (\Exception $e) {
                        // Handle deletion error
                        Log::warning("Tour Image deletion failed. Error message => ".$e->getMessage());
                    }
                }
            }
            $tour->featureimg2 = $this->uploadImage($request->featureimg2, "uploads/tour");
        }

        $tour->save();

        $tourCost = TourCostInclude::where('tour_id',$id)->first();
        $tourCost->description = $request->costDescription;
        $tourCost->save();

        drakify('success');

        return redirect()->route('admin.tour.index');
    }

    public function destroy($id)
    {
        $tour = Tour::findOrFail($id);
        $tour->delete();

        drakify('success');

        return redirect()->route('admin.tour.index');
    }

    public function trash(){
        $tours = Tour::onlyTrashed()->get();
        return view('pages.tour.trash', compact('tours'));
    }

    public function restore($id){
        $tour = Tour::withTrashed()->findOrFail($id);
        $tour->restore();
        drakify('success');
        return redirect()->route('admin.tour.index');
    }

    public function forceDelete($id){
        $tour = Tour::withTrashed()->findOrFail($id);
        if ($tour->image) {
            $tem = strtolower($tour->image);
            if (!($tem[0] == 'h' && $tem[1] == 't' && $tem[2] == 't' && $tem[3] == 'p')) {

                try {
                    $tem = explode('/', $tour->image);
                    $n = count($tem);
                    $filePath = "uploads/tour/".$tem[$n-1];
                    // $filePath = storage_path('app/public/uploads/tour/' . $tem[$n - 1]);
                    // $filePath = storage_path('app/public/uploads/tour/' . $tour->image);
                    unlink($filePath);
                } catch (\Exception $e) {
                    // Handle deletion error
                    Log::warning("Tour Image deletion failed. Error message => ".$e->getMessage());
                }
            }
        }
        if ($tour->featureimg1) {
            $tem = strtolower($tour->featureimg1);
            if (!($tem[0] == 'h' && $tem[1] == 't' && $tem[2] == 't' && $tem[3] == 'p')) {

                try {
                    $tem = explode('/', $tour->featureimg1);
                    $n = count($tem);
                    $filePath = "uploads/tour/".$tem[$n-1];
                    // $filePath = storage_path('app/public/uploads/tour/' . $tem[$n - 1]);
                    // $filePath = storage_path('app/public/uploads/tour/' . $tour->image);
                    unlink($filePath);
                } catch (\Exception $e) {
                    // Handle deletion error
                    Log::warning("Tour Image deletion failed. Error message => ".$e->getMessage());
                }
            }
        }

        if ($tour->featureimg2) {
            $tem = strtolower($tour->featureimg2);
            if (!($tem[0] == 'h' && $tem[1] == 't' && $tem[2] == 't' && $tem[3] == 'p')) {

                try {
                    $tem = explode('/', $tour->featureimg2);
                    $n = count($tem);
                    $filePath = "uploads/tour/".$tem[$n-1];
                    // $filePath = storage_path('app/public/uploads/trekking/' . $tem[$n - 1]);
                    // $filePath = storage_path('app/public/uploads/trekking/' . $trekking->image);
                    unlink($filePath);
                } catch (\Exception $e) {
                    // Handle deletion error
                    Log::warning("Tour Image deletion failed. Error message => ".$e->getMessage());
                }
            }
        }
        if ($tour->map) {
            $tem = strtolower(($tour->map));
            if (!($tem[0] == 'h' && $tem[1] == 't' && $tem[2] == 't' && $tem[3] == 'p')) {

                try {
                    $tem = explode('/', $tour->map);
                    $n = count($tem);
                    $filePath = "uploads/tour/".$tem[$n-1];
                    // $filePath = storage_path('app/public/uploads/tour/' . $tem[$n - 1]);
                    // $filePath = storage_path('app/public/uploads/tour/' . $tour->map);
                    unlink($filePath);
                } catch (\Exception $e) {
                    // Handle deletion error
                    dd($e->getMessage(),"map image");
                }
            }
        }
        $tour->forceDelete();
        drakify('success');
        return redirect()->route("admin.tour.trash");
    }
}
