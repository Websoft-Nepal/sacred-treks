<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Privacy;
use Illuminate\Http\Request;

class PrivacyController extends Controller
{
    public function index(){
        $privacy = Privacy::first();
        return view('pages.privacy.index',compact('privacy'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'title' => 'string|required|max:255',
            'description' => 'required|string|min:2000',
        ]);
        $privacy =Privacy::findorFail($id);
        $privacy->title = $request->title;
        $privacy->description = $request->description;
        $privacy->update();
        drakify('success');
        return redirect()->route('admin.privacy.index');

    }
}
