<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\contact;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function index(){
        $message = contact::all();
        return view('contact.index',compact('message'));
    }
}
