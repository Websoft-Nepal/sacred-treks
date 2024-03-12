<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogConroller extends BaseController
{
    public function index(){
        try {
            $blogs = Blog::all();
            return $this->SendResponse($blogs,"Blogs fetched successfully.");
        } catch (\Throwable $th) {
            return $this->SendError(throw $th,"Cannot fetch blogs data.",500);
        }

    }

}
