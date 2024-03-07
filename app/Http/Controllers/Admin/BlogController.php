<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(){
        return view('pages.blog.index');
    }

    public function create(){
        return view('pages.blog.create');
    }
}
