<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Models\Trekking;
use App\Models\TrekkingLocation;
use Illuminate\Http\Request;

class TrekkingController extends BaseController
{
    public function index(){
        try {
            $trekkings = Trekking::with('location')->paginate(10);
            $regions = TrekkingLocation::all();
            $data = [
                'trekkings' => $trekkings,
                'regions' => $regions,
            ];
            return $this->SendResponse($data,"Trekking data fetched successfully");
        } catch (\Throwable $th) {
            return $this->SendError(throw $th,"Cannot fetch trekking data",500);
        }
    }
    public function show($slug){
        try{
            $trekking = Trekking::where('slug',$slug)->first();
            if($trekking != null){
                return $this->SendResponse($trekking,"Trekking data fetched successfully");
            }else{
                return $this->SendResponse("Data not found","Cannot fetch trekking data",404);
            }
        }catch(\Throwable $th){
            return $this->SendError(throw $th,"Cannot fetch data",500);
        }
    }

}
