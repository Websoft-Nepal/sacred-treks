<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Models\Trekking;
use Illuminate\Http\Request;

class TrekkingController extends BaseController
{
    public function index(){
        try {
            $trekkings = Trekking::all();
            return $this->SendResponse($trekkings,"Trekking data fetched successfully");
        } catch (\Throwable $th) {
            return $this->SendError(throw $th,"Cannot fetch trekkign data",500);
        }
    }

}
