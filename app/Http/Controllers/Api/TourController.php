<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Models\Tour;
use Illuminate\Http\Request;

class TourController extends BaseController
{
    public function index(){
        try{
            $tours = Tour::all();
            return $this->SendResponse($tours, "Tours data fetched successfully");
        }
        catch (\Exception $e){
            return $this->SendError($e->getMessage(),"Can't fetch tours data",500);
        }
    }
}
