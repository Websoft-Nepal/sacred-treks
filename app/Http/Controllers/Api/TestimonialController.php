<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index(){
        try{
            $testimonial = testimonial::first();
            return $this->SendResponse($testimonial,"Testimonial data fetched successfully.");
        }catch(\Throwable $th){
            return $this->SendError($th->getMessage(),"Can't fetch testimonial data.",404);
        }
    }
}
