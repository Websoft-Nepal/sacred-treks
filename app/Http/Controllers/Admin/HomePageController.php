<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Models\HomePage;
use Illuminate\Http\Request;

class HomePageController extends BaseController
{
    public function index()
    {
        $home = HomePage::first();
        return view('display-pages.home-page.index', compact('home'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
            'subheading' => 'required|string',
            'headimg1' => 'image|max:5120',
            'headimg2' => 'image|max:5120',
            'bookimg' => 'image|max:5120',
            'gallery_title' => 'required|string|max:255',
            'trekking_title' => 'required|string|max:255',
            'trekking_slogan' => 'required|string',
            'feature_title' => 'required|string|max:255',
            'footer' => 'required|string',
        ]);
        $home = HomePage::findOrFail($id);
        $home->heading  = $request->heading;
        $home->subheading = $request->subheading;
        $home->gallery_title = $request->gallery_title;
        $home->trekking_slogan = $request->trekking_slogan;
        $home->trekking_title = $request->trekking_title;
        $home->trekking_slogan = $request->trekking_slogan;
        $home->feature_title = $request->feature_title;
        $home->footer = $request->footer;
        if ($request->hasFile('headimg1')) {
            // Delete the previous headimg1 if exists
            if ($home->headimg1) {
                $tem = strtolower($home->headimg1);
                if (!($tem[0] == 'h' && $tem[1] == 't' && $tem[2] == 't' && $tem[3] == 'p')) {

                    try {
                        $tem = explode('/', $home->headimg1);
                        $n = count($tem);
                        $filePath = storage_path('app/public/uploads/home/' . $tem[$n - 1]);
                        // $filePath = storage_path('app/public/uploads/home/' . $home->headimg1);
                        // unlink($filePath);
                    } catch (\Exception $e) {
                        // Handle deletion error
                        // dd($e->getMessage());
                    }
                }
            }
            // Upload the new headimg1
            // $home->headimg1 = $request->file('headimg1')->store('uploads/home');
            $home->headimg1 = $this->uploadImage($request->headimg1, "uploads/home");
        }
        if ($request->hasFile('headimg2')) {
            // Delete the previous headimg1 if exists
            if ($home->headimg2) {
                $tem = strtolower($home->headimg1);
                if (!($tem[0] == 'h' && $tem[1] == 't' && $tem[2] == 't' && $tem[3] == 'p')) {

                    try {
                        $tem = explode('/', $home->headimg2);
                        $n = count($tem);
                        $filePath = storage_path('app/public/uploads/home/' . $tem[$n - 1]);
                        // $filePath = storage_path('app/public/uploads/home/' . $home->headimg1);
                        // unlink($filePath);
                    } catch (\Exception $e) {
                        // Handle deletion error
                        // dd($e->getMessage());
                    }
                }
            }
            // Upload the new headimg1
            // $home->headimg1 = $request->file('headimg1')->store('uploads/home');
            $home->headimg2 = $this->uploadImage($request->headimg2, "uploads/home");
        }
        if ($request->hasFile('bookimg')) {
            // Delete the previous bookimg if exists
            if ($home->bookimg) {
                $tem = strtolower($home->bookimg);
                if (!($tem[0] == 'h' && $tem[1] == 't' && $tem[2] == 't' && $tem[3] == 'p')) {

                    try {
                        $tem = explode('/', $home->bookimg);
                        $n = count($tem);
                        $filePath = storage_path('app/public/uploads/home/' . $tem[$n - 1]);
                        // $filePath = storage_path('app/public/uploads/home/' . $home->bookimg);
                        // unlink($filePath);
                    } catch (\Exception $e) {
                        // Handle deletion error
                        // dd($e->getMessage());
                    }
                }
            }
            // Upload the new bookimg
            // $home->bookimg = $request->file('bookimg')->store('uploads/home');
            $home->bookimg = $this->uploadImage($request->bookimg, "uploads/home");
        }
        $home->save();
        drakify('success');
        return redirect()->route('admin.page.home.index');
    }
    public function destroy($id)
    {
        $home = HomePage::findOrFail($id);
        if ($home->headimg1) {
            $tem = strtolower($home->headimg1);
            if (!($tem[0] == 'h' && $tem[1] == 't' && $tem[2] == 't' && $tem[3] == 'p')) {

                try {
                    $tem = explode('/', $home->headimg1);
                    $n = count($tem);
                    $filePath = storage_path('app/public/uploads/home/' . $tem[$n - 1]);
                    // $filePath = storage_path('app/public/uploads/tour/' . $home->image);
                    unlink($filePath);
                } catch (\Exception $e) {
                    // Handle deletion error
                    // dd($e->getMessage());
                }
            }
        }
        if ($home->headimg2) {
            $tem = strtolower($home->headimg2);
            if (!($tem[0] == 'h' && $tem[1] == 't' && $tem[2] == 't' && $tem[3] == 'p')) {

                try {
                    $tem = explode('/', $home->headimg2);
                    $n = count($tem);
                    $filePath = storage_path('app/public/uploads/home/' . $tem[$n - 1]);
                    // $filePath = storage_path('app/public/uploads/tour/' . $home->image);
                    unlink($filePath);
                } catch (\Exception $e) {
                    // Handle deletion error
                    // dd($e->getMessage());
                }
            }
        }
        if ($home->bookimg) {
            $tem = strtolower($home->bookimg);
            if (!($tem[0] == 'h' && $tem[1] == 't' && $tem[2] == 't' && $tem[3] == 'p')) {

                try {
                    $tem = explode('/', $home->bookimg);
                    $n = count($tem);
                    $filePath = storage_path('app/public/uploads/home/' . $tem[$n - 1]);
                    // $filePath = storage_path('app/public/uploads/tour/' . $home->image);
                    unlink($filePath);
                } catch (\Exception $e) {
                    // Handle deletion error
                    // dd($e->getMessage());
                }
            }
        }
        $home->delete();
        return redirect()->route('admin.page.home.index');
    }
}
