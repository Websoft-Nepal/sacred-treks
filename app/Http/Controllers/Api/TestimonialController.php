<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Models\testimonial;
use Illuminate\Http\Request;

class TestimonialController extends BaseController
{
    public function index(){
        try{
            $testimonial = testimonial::all();
            foreach($testimonial as $test){
                if ($test['image'] != null) {
                    if(substr_count($test['image'],'http')<1){
                        $test['image'] = config('app.url') . "/" . $test['image'];
                    }
                }
            }
            return $this->SendResponse($testimonial,"Testimonial data fetched successfully.");
        }catch(\Throwable $th){
            return $this->SendError($th->getMessage(),"Can't fetch testimonial data.",404);
        }
    }
}
