<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Models\Trekking;
use App\Models\TrekkingCostInclude;
use App\Models\TrekkingLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class TrekkingController extends BaseController
{
    public function index()
    {
        $trekkings = Trekking::latest()->get();
        return view('pages.trekking.index', compact('trekkings'));
    }

    public function create()
    {
        $locations = TrekkingLocation::all();
        return view('pages.trekking.create', ['locations' => $locations]);
    }

    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|max:5120',
            'featureimg1' => 'image|max:5120',
            'featureimg2' => 'image|max:5120',
            'map' => 'sometimes|image|max:5120',
            'status' => 'in:on',
            'duration' => 'required|string',
            'start' => 'required|string',
            'finish' => 'finish|string',
            'type' => 'required|string',
            'grade' => 'required|string',
            'group_size' => 'required|string',
            'max_altitude' => 'required|string',
            'cost' => 'required|numeric',
            'location_id' => 'required|exists:trekking_locations,id',
            'description' => 'nullable|string',
            'costDescription' => 'nullable|string',
        ]);

        $trekking = new Trekking();
        $trekking->title = $request->title;
        $trekking->status = $request->has('status') ? true : false;
        $trekking->duration = $request->duration;
        $trekking->start = $request->start;
        $trekking->finish = $request->finish;
        $trekking->type = $request->type;
        $trekking->grade = $request->grade;
        $trekking->group_size = $request->group_size;
        $trekking->max_altitude = $request->max_altitude;
        $trekking->cost = $request->cost;
        $trekking->location_id = $request->location_id;
        $trekking->slug = $this->generateSlug($request->title, $trekking);
        $trekking->image = $this->uploadImage($request->image, "uploads/trekking");
        $trekking->description = $request->description;


        if($request->hasFile('featureimg1')){
            $trekking->featureimg1 = $this->uploadImage($request->featureimg1, "uploads/trekking");
        }

        if($request->hasFile("featureimg2")){
            $trekking->featureimg2 = $this->uploadImage($request->featureimg2, "uploads/trekking");
        }

        if($request->hasFile("map")){
            $trekking->map = $this->uploadImage($request->map, "uploads/trekking");
        }

        $trekking->save();

        $trekkingCost = new TrekkingCostInclude();
        $trekkingCost->trekking_id = $trekking->id;
        $trekkingCost->description = $request->costDescription;
        $trekkingCost->save();

        drakify('success');

        return redirect()->route('admin.trekking.index');
    }

    public function show($id)
    {
        $trekking = Trekking::with('location')->findOrFail($id);
        $trekkingCost = TrekkingCostInclude::where('trekking_id',$id)->first();
        $trekkingCost = optional($trekkingCost);
        return view('pages.trekking.view', ['trekking' => $trekking, 'trekkingCost' => $trekkingCost]);
    }

    public function edit(string $id)
    {
        $trekking = Trekking::findorFail($id);
        $locations = TrekkingLocation::all();
        $trekkingCost = TrekkingCostInclude::where('trekking_id',$id)->first();
        $trekkingCost = optional($trekkingCost);
        return view('pages.trekking.edit', ['trekking' => $trekking, 'locations' => $locations,'trekkingCost' => $trekkingCost]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => $this->slugValidate('trekkings', $id),
            'image' => 'image|max:5120',
            'featureimg1' => 'image|max:5120',
            'featureimg2' => 'image|max:5120',
            'map' => 'sometimes|image|max:5120',
            'status' => 'in:on',
            'duration' => 'required|string',
            'start' => 'required|string',
            'finish' => 'finish|string',
            'type' => 'required|string',
            'grade' => 'required|string',
            'group_size' => 'required|string',
            'max_altitude' => 'required|string',
            'cost' => 'required|numeric',
            'location_id' => 'required|exists:trekking_locations,id',
            'description' => 'nullable|string',
            'costDescription' => 'nullable|string',
        ]);
        $trekking = Trekking::findOrFail($id);
        $trekking->title = $request->title;
        $trekking->status = $request->has('status') ? true : false;
        $trekking->duration = $request->duration;
        $trekking->start = $request->start;
        $trekking->finish = $request->finish;
        $trekking->type = $request->type;
        $trekking->grade = $request->grade;
        $trekking->group_size = $request->group_size;
        $trekking->max_altitude = $request->max_altitude;
        $trekking->cost = $request->cost;
        $trekking->location_id = $request->location_id;
        $trekking->slug = str::slug($request->slug);
        $trekking->description = $request->description;

        // Check if a new image is uploaded
        if ($request->hasFile('image')) {
            // Delete the previous image if exists

            if ($trekking->image) {
                $tem = strtolower($trekking->image);
                if (!($tem[0] == 'h' && $tem[1] == 't' && $tem[2] == 't' && $tem[3] == 'p')) {

                    try {
                        $tem = explode('/', $trekking->image);
                        $n = count($tem);
                        $filePath = "uploads/trekking/".$tem[$n-1];
                        // $filePath = storage_path('app/public/uploads/trekking/' . $tem[$n - 1]);
                        // $filePath = storage_path('app/public/uploads/trekking/' . $trekking->image);
                        unlink($filePath);
                    } catch (\Exception $e) {
                        // Handle deletion error
                        Log::warning("Trekking Image deletion failed. Error message => ".$e->getMessage());

                    }
                }
            }

            // Upload the new image
            // $trekking->image = $request->file('image')->store('uploads/trekking');

            $trekking->image = $this->uploadImage($request->image, "uploads/trekking");
        }

        if ($request->hasFile('featureimg1')) {
            if ($trekking->featureimg1) {
                $tem = strtolower($trekking->featureimg1);
                if (!($tem[0] == 'h' && $tem[1] == 't' && $tem[2] == 't' && $tem[3] == 'p')) {

                    try {
                        $tem = explode('/', $trekking->featureimg1);
                        $n = count($tem);
                        $filePath = "uploads/trekking/".$tem[$n-1];
                        // $filePath = storage_path('app/public/uploads/trekking/' . $tem[$n - 1]);
                        // $filePath = storage_path('app/public/uploads/trekking/' . $trekking->image);
                        unlink($filePath);
                    } catch (\Exception $e) {
                        // Handle deletion error
                        Log::warning("Trekking Image deletion failed. Error message => ".$e->getMessage());
                    }
                }
            }
            $trekking->featureimg1 = $this->uploadImage($request->featureimg1, "uploads/trekking");
        }

        if ($request->hasFile("featureimg2")) {
            if ($trekking->featureimg2) {
                $tem = strtolower($trekking->featureimg2);
                if (!($tem[0] == 'h' && $tem[1] == 't' && $tem[2] == 't' && $tem[3] == 'p')) {

                    try {
                        $tem = explode('/', $trekking->featureimg2);
                        $n = count($tem);
                        $filePath = "uploads/trekking/".$tem[$n-1];
                        // $filePath = storage_path('app/public/uploads/trekking/' . $tem[$n - 1]);
                        // $filePath = storage_path('app/public/uploads/trekking/' . $trekking->image);
                        unlink($filePath);
                    } catch (\Exception $e) {
                        // Handle deletion error
                        Log::warning("Trekking Image deletion failed. Error message => ".$e->getMessage());
                    }
                }
            }
            $trekking->featureimg2 = $this->uploadImage($request->featureimg2, "uploads/trekking");
        }

        if ($request->hasFile("map")) {
            if ($trekking->map) {
                $tem = strtolower($trekking->map);

                    try {
                        $tem = explode('/', $trekking->map);
                        $n = count($tem);
                        $filePath = "uploads/trekking/".$tem[$n-1];
                        unlink($filePath);
                    } catch (\Exception $e) {
                        // Handle deletion error
                        Log::warning("Trekking Image deletion failed. Error message => ".$e->getMessage());
                    }
            }
            $trekking->map = $this->uploadImage($request->map, "uploads/trekking");
        }

        $trekking->save();

        $trekkingCost = TrekkingCostInclude::where('trekking_id',$id)->first();
        $trekkingCost->description = $request->costDescription;
        $trekkingCost->save();

        // notify()->success('Welcome to Laravel Notify ⚡️');

        drakify('success'); // for success alert

        // drakify('error'); // for error alert

        // smilify('success', 'You are successfully reconnected');

        // emotify('success', 'You are awesome, your data was successfully created');

        return redirect()->route('admin.trekking.index');
    }

    public function destroy(string $id)
    {
        $trekking = Trekking::findOrFail($id);

        $trekking->delete();

        drakify('success');

        return redirect()->route('admin.trekking.index');
    }
    public function trash(){
        $trekkings = Trekking::onlyTrashed()->get();
        return view('pages.trekking.trash',compact('trekkings'));
    }
    public function restore($id){
        $trekking = Trekking::withTrashed()->findOrFail($id);
        $trekking->restore();
        drakify('success');
        return redirect()->route('admin.trekking.index');
    }
    public function forceDelete($id){
        $trekking = Trekking::withTrashed()->findOrFail($id);
        if ($trekking->image) {
            $tem = strtolower($trekking->image);
            if (!($tem[0] == 'h' && $tem[1] == 't' && $tem[2] == 't' && $tem[3] == 'p')) {

                try {
                    $tem = explode('/', $trekking->image);
                    $n = count($tem);
                    $filePath = "uploads/trekking/".$tem[$n-1];
                    // $filePath = storage_path('app/public/uploads/trekking/' . $tem[$n - 1]);
                    // $filePath = storage_path('app/public/uploads/trekking/' . $trekking->image);
                    unlink($filePath);
                } catch (\Exception $e) {
                    // Handle deletion error
                    Log::warning("Trekking Image deletion failed. Error message => ".$e->getMessage());
                }
            }
        }

        if ($trekking->featureimg1) {
            $tem = strtolower($trekking->featureimg1);
            if (!($tem[0] == 'h' && $tem[1] == 't' && $tem[2] == 't' && $tem[3] == 'p')) {

                try {
                    $tem = explode('/', $trekking->featureimg1);
                    $n = count($tem);
                    $filePath = "uploads/trekking/".$tem[$n-1];
                    // $filePath = storage_path('app/public/uploads/trekking/' . $tem[$n - 1]);
                    // $filePath = storage_path('app/public/uploads/trekking/' . $trekking->image);
                    unlink($filePath);
                } catch (\Exception $e) {
                    // Handle deletion error
                    Log::warning("Trekking Image deletion failed. Error message => ".$e->getMessage());
                }
            }
        }


        if ($trekking->featureimg2) {
            $tem = strtolower($trekking->featureimg2);
            if (!($tem[0] == 'h' && $tem[1] == 't' && $tem[2] == 't' && $tem[3] == 'p')) {

                try {
                    $tem = explode('/', $trekking->featureimg2);
                    $n = count($tem);
                    $filePath = "uploads/trekking/".$tem[$n-1];
                    // $filePath = storage_path('app/public/uploads/trekking/' . $tem[$n - 1]);
                    // $filePath = storage_path('app/public/uploads/trekking/' . $trekking->image);
                    unlink($filePath);
                } catch (\Exception $e) {
                    // Handle deletion error
                    Log::warning("Trekking Image deletion failed. Error message => ".$e->getMessage());
                }
            }
        }

        if ($trekking->map) {
            $tem = strtolower($trekking->map);

                try {
                    $tem = explode('/', $trekking->map);
                    $n = count($tem);
                    $filePath = "uploads/trekking/".$tem[$n-1];
                    // $filePath = storage_path('app/public/uploads/trekking/' . $tem[$n - 1]);
                    // $filePath = storage_path('app/public/uploads/trekking/' . $trekking->image);
                    unlink($filePath);
                } catch (\Exception $e) {
                    // Handle deletion error
                    Log::warning("Trekking Image deletion failed. Error message => ".$e->getMessage());
                }
        }
        $trekking->forceDelete();
        drakify('success');
        return redirect()->route('admin.trekking.trash');
    }
}
