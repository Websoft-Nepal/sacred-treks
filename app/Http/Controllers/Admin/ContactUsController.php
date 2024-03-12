<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\contact;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function index(){
        // $message = contact::all();
        return view('pages.contact_us.index');
    }
}
