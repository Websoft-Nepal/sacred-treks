<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Models\Blog;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BlogController extends BaseController
{
    public function index(){
        try {
            $blogs = Blog::where('status',1)->get();
            foreach($blogs as $blog){
                if ($blog['image'] != null) {
                    if(substr_count($blog['image'],'http')<1){
                        $blog['image'] = config('app.url') . "/" . $blog['image'];
                    }
                }
            }
            return $this->SendResponse($blogs,"Blogs fetched successfully.");
        } catch (\Throwable $th) {
            return $this->SendError(throw $th,"Cannot fetch blogs data.",500);
        }

    }
    public function show($slug){
        try{
            $blog = Blog::where('slug',$slug)->first();
            if($blog != null){
                if ($blog['image'] != null) {
                    if(substr_count($blog['image'],'http')<1){
                        $blog['image'] = config('app.url') . "/" . $blog['image'];
                    }
                }
                $lastUpdated = Carbon::parse($blog->updated_at);
                $blog['formated_date'] = $lastUpdated->diffForHumans();
                return $this->SendResponse($blog,"Blog data fetched successfully.");
            }else{
                return $this->SendResponse("Data not found","Cannot fetch blog data.",404);
            }
        }catch(\Throwable $th){
            return $this->SendError(throw $th,"Cannot fetch blogs data.",500);
        }
    }

}
