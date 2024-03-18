<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Models\contact;
use Illuminate\Http\Request;

class ContactController extends BaseController
{
    public function index(){
        try{
            $contact = contact::first();
            return $this->SendResponse($contact,"Contact data fetched successfully.");
        }catch(\Throwable $th){
            return $this->SendError($th->getMessage(),"Can't fetch contact data.",404);
        }
    }
}
