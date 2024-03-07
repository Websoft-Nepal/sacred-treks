<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends BaseController
{
    public function index(){
        $blogs = Blog::latest()->paginate(10);
        return view('pages.blog.index',compact('blogs'));
    }

    public function create(){
        return view('pages.blog.create');
    }

    public function show($id){
        $blog = Blog::where('id',$id)->first();
        return view('pages.blog.view',compact('blog'));
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|max:2048',
            'description' => 'nullable|string',
        ]);

        $blog = new Blog();
        $blog->title = $request->title;
        $blog->slug = $this->generateSlug($request->title, $blog);
        $blog->image = $this->uploadImage($request->image);
        $blog->description = $request->description;
        $blog->save();
        return redirect()->route('admin.blog.index');
    }

    public function edit($id){
        $blog = Blog::where('id',$id)->first();
        return view('pages.blog.edit',compact('blog'));
    }

    public function update(Request $request,string $id){
        $request->validate([
            'title' => 'required|string|max:255',
            // 'slug' => $this->slugValidate($request->slug,$id),
            'image' => 'required|image|max:2048',
            'description' => 'nullable|string',
        ]);
        $blog = Blog::findorFail($id);
        $blog->title = $request->title;
        $blog->slug = str::slug($request->slug);
        $blog->image = $this->uploadImage($request->image);
        $blog->update();
        return redirect()->route('admin.blog.index');
    }
}
