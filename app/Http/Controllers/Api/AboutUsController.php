<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Models\aboutus;
use Illuminate\Http\Request;

class AboutUsController extends BaseController
{
    public function index(){
        try{
            $about = aboutus::first();
            return $this->SendResponse($about,"About data fetched successfully.");
        }catch(\Throwable $th){
            return $this->SendError($th->getMessage(),"Can't fetch aboutus data.",404);
        }
    }
}
