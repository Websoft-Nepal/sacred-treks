<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialMedia;
use Illuminate\Http\Request;

class SocialMediaController extends Controller
{
    public function index(){
        $socials = SocialMedia::all();
        return view('pages.social_media.index',compact('socials'));
    }

    public function update(Request $request,$id){
       
      

    }
}
