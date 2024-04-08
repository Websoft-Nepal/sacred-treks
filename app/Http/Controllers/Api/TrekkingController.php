<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Models\Trekking;
use App\Models\TrekkingCostInclude;
use App\Models\TrekkingItinerary;
use App\Models\TrekkingLocation;
use Illuminate\Http\Request;

class TrekkingController extends BaseController
{
    public function index()
    {
        try {
            $trekkings = Trekking::with('location')->where('status', 1)->paginate(10);
            // $itineraries = TrekkingItinerary::all();
            // $costInclude = TrekkingCostInclude::where('trekking_id',)
            $regions = TrekkingLocation::all();
            if ($trekkings != null) {
                foreach ($trekkings as $trekking) {
                    if ($trekking['image'] != null) {
                        if (substr_count($trekking['image'], 'http') < 1) {
                            $trekking['image'] = config('app.url') . "/" . $trekking['image'];
                        }
                    }
                    if ($trekking['featureimg1'] != null) {
                        if (substr_count($trekking['featureimg1'], 'http') < 1) {
                            $trekking['featureimg1'] = config('app.url') . "/" . $trekking['featureimg1'];
                        }
                    }
                    if ($trekking['featureimg2'] != null) {
                        if (substr_count($trekking['featureimg2'], 'http') < 1) {
                            $trekking['featureimg2'] = config('app.url') . "/" . $trekking['featureimg2'];
                        }
                    }
                }
            }
            foreach ($regions as $region) {
                $region['link'] = url("api/trekking/category/{$region->id}");
            }
            $data = [
                'trekkings' => $trekkings,
                'regions' => $regions,
            ];
            return $this->SendResponse($data, "Trekking data fetched successfully");
        } catch (\Throwable $th) {
            return $this->SendError(throw $th, "Cannot fetch trekking data", 500);
        }
    }
    public function show($slug)
    {
        try {
            $trekking = Trekking::where('slug', $slug)->with('trekkingItinerary', 'trekkingCostInclude')->first();
            if ($trekking != null) {
                if ($trekking['image'] != null) {
                    if (substr_count($trekking['image'], 'http') < 1) {
                        $trekking['image'] = config('app.url') . "/" . $trekking['image'];
                    }
                }
                if ($trekking['featureimg1'] != null) {
                    if (substr_count($trekking['featureimg1'], 'http') < 1) {
                        $trekking['featureimg1'] = config('app.url') . "/" . $trekking['featureimg1'];
                    }
                }
                if ($trekking['featureimg2'] != null) {
                    if (substr_count($trekking['featureimg2'], 'http') < 1) {
                        $trekking['featureimg2'] = config('app.url') . "/" . $trekking['featureimg2'];
                    }
                }

                // For parsing the html content in the description and change into text

                // $html_list = $trekking->trekkingCostInclude->description;
                // $html_list = trim($html_list);
                // if ((str_contains($html_list, "<ul><li>")) || (str_contains($html_list, "<ol><li>"))) {
                //     $html_list = explode("</li>", $html_list);
                //     // dd($lists);
                //     $list = [];
                //     $tem = "";
                //     $i = 0;
                //     foreach ($html_list as $l) {
                //         $tem = strip_tags($l);
                //         $list[$i++] = $tem;
                //     }
                //     unset($list[--$i]);
                // }else{
                //     dd("Doesn't contain list");
                // }
                // $trekking->trekkingCostInclude->description = $list;
                return $this->SendResponse($trekking, "Trekking data fetched successfully");
            } else {
                return $this->SendResponse("Data not found", "Cannot fetch trekking data", 404);
            }
        } catch (\Throwable $th) {
            return $this->SendError(throw $th, "Cannot fetch data", 500);
        }
    }

    public function category($location_id)
    {
        if($location_id<0){
            return redirect()->route('api.tour');
        }
        try {
            $trekkings = Trekking::where('location_id', $location_id)->where('status', 1)->with('trekkingItinerary', 'trekkingCostInclude')->paginate(10);
            if ($trekkings != null) {
                $data = [
                    'trekkings' => $trekkings,
                ];
                return $this->SendResponse($data, "Trekking data fetched successfully");
            } else {
                return $this->SendResponse("Data not found", "Cannot fetch trekking data", 404);
            }
        } catch (\Throwable $th) {
            return $this->SendError(throw $th, "Cannot fetch data", 500);
        }
    }
}
