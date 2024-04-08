<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Models\Privacy;
use Illuminate\Http\Request;

class PrivacyController extends BaseController
{
    public function index(){
        try{
            $privacy = Privacy::first();
            return $this->SendResponse($privacy,"Privacy data fetched successfully.");
        }catch(\Throwable $th){
            return $this->SendError($th->getMessage(),"Can't fetch privacy data.",404);
        }
    }
}
