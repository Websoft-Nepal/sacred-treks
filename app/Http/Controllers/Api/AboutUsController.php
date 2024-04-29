<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Models\aboutus;
use App\Models\Team;
use Illuminate\Http\Request;

class AboutUsController extends BaseController
{
    public function index(){
        try{
            $about = aboutus::first();
            $about['image'] = config('app.url') . "/" . $about['image'];
            $teams = Team::all();
            foreach($teams as $team){
                if ($team['image'] != null) {
                    $team['image'] = config('app.url') . "/" . $team['image'];
                }
            }
            $data = [
                'about' => $about,
                'teams' => $teams,
            ];
            return $this->SendResponse($data,"About data fetched successfully.");
        }catch(\Throwable $th){
            return $this->SendError($th->getMessage(),"Can't fetch aboutus data.",404);
        }
    }
}
