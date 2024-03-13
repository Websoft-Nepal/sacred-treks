<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Models\Trekking;
use App\Models\TrekkingLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TrekkingController extends BaseController
{
    public function index()
    {
        $trekkings = Trekking::latest()->paginate(10);
        return view('pages.trekking.index', compact('trekkings'));
    }

    public function create()
    {
        $locations = TrekkingLocation::all();
        return view('pages.trekking.create',['locations' => $locations]);
    }

    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|max:2048',
            'status' => 'in:on',
            'duration' => 'required|string',
            'cost' => 'required|numeric',
            'location_id' => 'required|exists:trekking_locations,id',
            'description' => 'nullable|string',
        ]);

        $trekking = new Trekking();
        $trekking->title = $request->title;
        $trekking->status = $request->has('status') ? true : false;
        $trekking->duration = $request->duration;
        $trekking->cost = $request->cost;
        $trekking->location_id = $request->location_id;
        $trekking->slug = $this->generateSlug($request->title, $trekking);
        $trekking->image = $this->uploadImage($request->image, "uploads/trekking");
        $trekking->description = $request->description;
        $trekking->save();

        drakify('success');

        return redirect()->route('admin.trekking.index');
    }

    public function show($id)
    {
        $trekking = Trekking::with('location')->findOrFail($id);
        return view('pages.trekking.view', ['trekking' => $trekking]);
    }

    public function edit(string $id)
    {
        $trekking = Trekking::findorFail($id);
        $locations = TrekkingLocation::all();
        return view('pages.trekking.edit', ['trekking' => $trekking,'locations'=>$locations]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => $this->slugValidate('trekkings', $id),
            'image' => 'image|max:2048',
            'status' => 'in:on',
            'duration' => 'required|string',
            'cost' => 'required|numeric',
            'location_id' => 'required|exists:trekking_locations,id',
            'description' => 'nullable|string',
        ]);
        $trekking = Trekking::findOrFail($id);
        $trekking->title = $request->title;
        $trekking->status = $request->has('status') ? true : false;
        $trekking->duration = $request->duration;
        $trekking->cost = $request->cost;
        $trekking->location_id = $request->location_id;
        $trekking->slug = str::slug($request->slug);
        $trekking->description = $request->description;

        // Check if a new image is uploaded
        if ($request->hasFile('image')) {
            // Delete the previous image if exists
            if ($trekking->image) {
                try {
                    $filePath = storage_path('app/public/uploads/trekking/' . $trekking->image);
                    unlink($filePath);
                } catch (\Exception $e) {
                    // Handle deletion error
                    dd($e->getMessage());
                }
            }
            // Upload the new image
            $trekking->image = $request->file('image')->store('uploads/trekking');
        }

        $trekking->save();

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

        if ($trekking->image) {
            try {
                // Storage::delete($trekking->image);
                $filePath = storage_path('app/public/uploads/trekking/' . $trekking->image);
                unlink($filePath);
            } catch (\Exception $e) {
                // Handle deletion error
                dd($e->getMessage());
            }
        }
        $trekking->delete();

        drakify('success');

        return redirect()->route('admin.trekking.index');
    }
}
