<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Models\Trekking;
use Illuminate\Http\Request;

class TrekkingController extends BaseController
{
   public function index(){
    $trekkings = Trekking::latest()->paginate(10);
    return view('pages.trekking.index',compact('trekkings'));
   }

   public function create(){
    return view('pages.trekking.create');
   }

   public function store(Request $request){
        $request->validate([
            'title'=>'required|string|max:255',
            'image'=>'required|image|max:2048',
            'description'=>'nullable|string',
        ]);

        $trekking = new Trekking();
        $trekking->title = $request->title;
   }

   public function edit(string $id){

   }

   public function update(Request $request, string $id){

   }

   public function destroy(string $id){
    $trekking = Trekking::findOrFail($id);
    $trekking->delete();
    return ;
   }
}
