<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Models\contact;
use App\Models\HomePage;
use App\Models\SocialMedia;
use Illuminate\Http\Request;
use Throwable;

class CompanyInfoController extends BaseController
{
    public function index(){
        try{
            $contact = contact::first();
            $social = SocialMedia::first();
            $homepage = HomePage::first();
            $data = [
                'contact' => $contact,
                'social' => $social,
                'footer' => $homepage['footer'],
            ];
            return $this->SendResponse($data,"Company data fetched successfully",200);
        }catch(Throwable $th){
            return $this->SendError($th->getMessage(),"Cannot fetch company info",500);
        }
    }
}
