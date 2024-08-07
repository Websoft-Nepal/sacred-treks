<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Models\TermsCondition;
use Illuminate\Http\Request;

class TermsConditionController extends BaseController
{
    public function index(){
        try{
            $term = TermsCondition::first();
            return $this->SendResponse($term,"Terms and Condition data fetched successfully.");
        }catch(\Throwable $th){
            return $this->SendError($th->getMessage(),"Can't fetch terms and condition data.",404);
        }
    }
}
