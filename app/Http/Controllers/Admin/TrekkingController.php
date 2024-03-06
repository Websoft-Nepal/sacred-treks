<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TrekkingController extends Controller
{
   public function index(){
    return view('pages.trekking.index');
   }

   public function create(){
    return view('pages.trekking.create');
   }
}
