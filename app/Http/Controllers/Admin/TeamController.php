<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TeamController extends BaseController
{
    public function index(){
        $teams = Team::paginate(10);
        return view('pages.teams.index',compact('teams'));
    }
    public function create(){
        return view('pages.teams.create');
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required|string',
            'position' => 'required|string',
            'image' => 'required|image|max:5120',
        ]);

        $team = new Team();
        $team->name = $request->name;
        $team->position = $request->position;
        $team->image = $this->uploadImage($request->image, "uploads/teams");
        $team->status = $request->has('status') ? 1 : 0;
        $team->save();
        drakify("success");
        return redirect()->route('admin.teams.index');

    }
    public function edit($id){
        $team = Team::findOrFail($id);
        return view('pages.teams.edit',compact('team'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'position' => 'required|string',
            'image' => 'image|max:2048',
        ]);

        $team = Team::findorFail($id);
        $team->name = $request->name;
        $team->review = $request->review;
        $team->description = $request->description;
        $team->status = $request->has('status') ? $request->status : $team->status;
        if ($request->hasFile('image')) {
            // Delete the previous image if exists
            if ($team->image) {
                try {
                    $tem = explode('/', $team->image);
                    $n = count($tem);
                    $filePath = "uploads/teams/" . $tem[$n - 1];
                    // $filePath = storage_path('app/public/uploads/teamss/' . $team->image);
                    unlink($filePath);
                } catch (\Exception $e) {
                    // Handle deletion error
                    Log::error("Cannot delete image.\n Error => ".$e->getMessage());
                }
            }
            // Upload the new image
            // $team->image = $request->file('image')->store('uploads/teams');
            $team->image = $this->uploadImage($request->image, "uploads/teams");
        }

        $team->update();
        drakify('success');
        return redirect()->route('admin.teams.index');
    }

    public function destroy($id)
    {
        $team = Team::findorFail($id);
        $team->delete();
        drakify('success');
        return redirect()->route('admin.teams.index');
    }

    public function trash(){
        $teams = Team::onlyTrashed()->get();
        return view('pages.teams.trash', compact('teams'));
    }

    public function restore($id){
        $team = Team::withTrashed()->findOrFail($id);
        $team->restore();
        drakify('success');
        return redirect()->route('admin.teams.index');
    }

    public function forceDelete($id){
        $team = Team::withTrashed()->findOrFail($id);
        if ($team->image) {
            try {

                $tem = explode('/', $team->image);
                $n = count($tem);
                $filePath = "uploads/teams/" . $tem[$n - 1];
                // $filePath = storage_path('app/public/uploads/teamss/' . $team->image);
                unlink($filePath);
            } catch (\Exception $e) {
                Log::error("Cannot delete image.\n Error => ".$e->getMessage());
            }
        }
        $team->forceDelete();
        drakify('success');
        return redirect()->route("admin.teams.trash");
    }
}
