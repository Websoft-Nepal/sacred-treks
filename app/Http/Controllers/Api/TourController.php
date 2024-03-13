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
    public function show($slug){
        try{
            $tour = Tour::where('slug',$slug)->with('transportation')->first();
            if($tour == NULL){
                return $this->SendError("Unauthorize","Data not found",400);
            }
            return $this->SendResponse($tour,"Tour data fetched successfully");
        }
        catch(\Throwable $th){
            return $this->SendError($th->getMessage(),"Can't fetch tours data",403);
        }
    }
}
