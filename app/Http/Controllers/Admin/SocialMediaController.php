<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialMedia;
use Illuminate\Http\Request;

class SocialMediaController extends Controller
{
    public function index(){
        $socials = SocialMedia::first();
        return view('pages.social_media.index',compact('socials'));
    }

    public function update(Request $request,$id){

        $request-> validate([
       'youtube' => 'required',
       'instagram' => 'required',
       'twitter' => 'required',
       'facebook' => 'required',
        ]);

        $social = SocialMedia::findorFail($id);
        $social->youtube = $request->youtube;
        $social->facebook = $request->facebook;
        $social->twitter = $request->twitter;
        $social->instagram = $request->instagram;
        $social->update();
        return redirect()->route('admin.social.index');
    }

}
