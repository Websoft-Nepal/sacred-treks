<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPage;
use Illuminate\Http\Request;

class BlogPageController extends Controller
{
    public function index(){
        $blog = BlogPage::first();
        $blog = optional($blog);
        return view('display-pages.blog-page.index',compact('blog'));
    }

    public function update(Request $request,$id){
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string',
        ]);
        $blog = BlogPage::findOrFail($id);
        $blog-> title = $request-> title;
        $blog->subtitle = $request->subtitle;
        $blog->save();
        drakify('success');
        return redirect()->route('admin.page.blog.index');
    }

    public function destroy($id){
        $blog = BlogPage::findOrFail($id);
        $blog->delete();
        return redirect()->route('admin.page.blog.index');
    }
}
