<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class BlogController extends BaseController
{
    public function index()
    {
        $blogs = Blog::latest()->paginate(10);
        return view('pages.blog.index', compact('blogs'));
    }

    public function create()
    {
        return view('pages.blog.create');
    }

    public function show($id)
    {
        $blog = Blog::where('id', $id)->first();
        return view('pages.blog.view', compact('blog'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|max:5120',
            'conclusion' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $blog = new Blog();
        $blog->title = $request->title;
        $blog->status = $request->has('status') ? true : false;
        $blog->slug = $this->generateSlug($request->title, $blog);
        $blog->conclusion = $request->conclusion;
        $blog->image = $this->uploadImage($request->image, "uploads/blog");
        $blog->description = $request->description;
        $blog->save();
        return redirect()->route('admin.blog.index');
    }

    public function edit($id)
    {
        $blog = Blog::where('id', $id)->first();
        return view('pages.blog.edit', compact('blog'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            // 'slug' => $this->slugValidate($request->slug,$id),
            'image' => 'image|max:2048',
            'description' => 'nullable|string',
        ]);
        $blog = Blog::findorFail($id);
        $blog->title = $request->title;
        $blog->conclusion = $request->conclusion;
        $blog->description = $request->description;
        $blog->status = $request->has('status') ? true : false;
        $blog->slug = str::slug($request->slug);
        if ($request->hasFile('image')) {
            // Delete the previous image if exists
            if ($blog->image) {
                try {
                    $tem = explode('/', $blog->image);
                    $n = count($tem);
                    $filePath = "uploads/blog/" . $tem[$n - 1];
                    // $filePath = storage_path('app/public/uploads/blog/' . $blog->image);
                    unlink($filePath);
                } catch (\Exception $e) {
                    // Handle deletion error
                    Log::warning("Blog Image deletion failed. Error message => " . $e->getMessage());
                }
            }
            // Upload the new image
            // $blog->image = $request->file('image')->store('uploads/blog');
            $blog->image = $this->uploadImage($request->image, "uploads/blog");
        }

        $blog->save();
        return redirect()->route('admin.blog.index');
    }
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();
        return redirect()->route('admin.blog.index');
    }

    public function trash()
    {
        $blogs = Blog::onlyTrashed()->get();
        return view('pages.blog.trash', compact('blogs'));
    }
    public function restore($id)
    {
        $blog = Blog::withTrashed()->findOrFail($id);
        $blog->restore();
        drakify('success');
        return redirect()->route('admin.blog.index');
    }

    public function forceDelete($id)
    {
        $blog = Blog::withTrashed()->findOrFail($id);
        if ($blog->image) {
            try {
                $tem = explode('/', $blog->image);
                $n = count($tem);
                $filePath = "uploads/blog/" . $tem[$n - 1];
                // $filePath = storage_path('app/public/uploads/blog/' . $blog->image);
                unlink($filePath);
            } catch (\Exception $e) {
                Log::warning("Blog Image deletion failed. Error message => " . $e->getMessage());
            }
        }
        $blog->forceDelete();
        drakify('success');
        return redirect()->route('admin.blog.trash');
    }
}
