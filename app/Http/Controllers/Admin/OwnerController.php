<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Models\Owner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OwnerController extends BaseController
{
    public function index(){
        $owner = Owner::first();
        $owner = optional($owner);
        return view('pages.owner.index',compact('owner'));
    }
    public function store(Request $request){

    }
    public function update(Request $request,$id){
        $request->validate([
            'name' => 'required|string',
            'position' => 'required|string',
            'image' => 'image|max:5120',
        ]);

        $owner = Owner::findOrFail($id);
        $owner->name = $request->name;
        $owner->position = $request->position;
        $owner->description = $request->description;
        if ($request->hasFile('image')) {
            // Delete the previous image if exists
            if ($owner->image) {
                try {
                    $tem = explode('/', $owner->image);
                    $n = count($tem);
                    $filePath = "uploads/owner/" . $tem[$n - 1];
                    // $filePath = storage_path('app/public/uploads/teamss/' . $owner->image);
                    unlink($filePath);
                } catch (\Exception $e) {
                    // Handle deletion error
                    Log::error("Cannot delete image.\n Error => ".$e->getMessage());
                }
            }
            // Upload the new image
            $owner->image = $this->uploadImage($request->image, "uploads/owner");
            $owner->update();

        }
        drakify('success');
        return redirect()->route('admin.owner.index');
    }

    public function destroy($id)
    {
        $owner = Owner::findorFail($id);
        if ($owner->image) {
            try {

                $tem = explode('/', $owner->image);
                $n = count($tem);
                $filePath = "uploads/owner/" . $tem[$n - 1];
                // $filePath = storage_path('app/public/uploads/owners/' . $owner->image);
                unlink($filePath);
            } catch (\Exception $e) {
                dd($e->getMessage());
            }
        }
        $owner->delete();
        return redirect()->route('admin.owner.index');
    }
}
