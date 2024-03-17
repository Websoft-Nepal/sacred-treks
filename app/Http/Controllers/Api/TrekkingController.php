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
            return $this->SendError(throw $th,"Cannot fetch trekkign data",500);
        }
    }

}
