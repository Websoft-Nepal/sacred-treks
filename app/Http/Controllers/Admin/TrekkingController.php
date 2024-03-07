<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Models\Trekking;
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
        return view('pages.trekking.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|max:2048',
            'description' => 'nullable|string',
        ]);

        $trekking = new Trekking();
        $trekking->title = $request->title;
        $trekking->slug = $this->generateSlug($request->title, $trekking);
        $trekking->image = $this->uploadImage($request->image);
        $trekking->description = $request->description;
        $trekking->save();
        return redirect()->route('admin.trekking.index');
    }

    public function edit(string $id)
    {
        $trekking = Trekking::findorFail($id);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|max:2048',
            'slug' => $this->slugValidate($request->slug,$id),
            'description' => 'nullable|string',
        ]);
        $trekking = Trekking::findOrFail($id);
        $trekking->title = $request->title;
        $trekking->slug = str::slug($request->slug);
        $trekking->image = $this->uploadImage($request->image);
        $trekking->description = $request->description;
    }

    public function destroy(string $id)
    {
        $trekking = Trekking::findOrFail($id);
        $trekking->delete();
        return redirect()->route('admin.trekking.index');
    }
}
