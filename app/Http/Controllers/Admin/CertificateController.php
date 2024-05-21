<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CertificateController extends BaseController
{
    public function index()
    {
        $galleries = Certificate::all();
        return view('pages.certificate.index', compact('galleries'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:5120',
        ]);
        $gallery = new Certificate();
        $gallery->image = $this->uploadImage($request->image, "uploads/gallery");
        $gallery->save();
        drakify('success');
        return redirect()->route('admin.certificate.index');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'image|max:5120',
        ]);
        $gallery = Certificate::findOrFail($id);
        if ($request->hasFile('image')) {
            // Delete the previous image if exists
            if ($gallery->image) {

                    try {
                        unlink($gallery->image);
                    } catch (\Exception $e) {
                        Log::error("Cannot delete certificate. \nError => ".$e->getMessage());
                    }
            }
            $gallery->image = $this->uploadImage($request->image, "uploads/gallery");
        }
        $gallery->save();
        drakify('success');
        return redirect()->route('admin.certificate.index');
    }
    public function destroy($id)
    {
        $gallery = Certificate::findOrFail($id);
        if ($gallery->image) {
                try {
                    unlink($gallery->image);
                } catch (\Exception $e) {
                    Log::error("Cannot delete certificate. \nError => ".$e->getMessage());
                }
        }
        $gallery->delete();
        drakify("success");
        return redirect()->route("admin.certificate.index");
    }
}
