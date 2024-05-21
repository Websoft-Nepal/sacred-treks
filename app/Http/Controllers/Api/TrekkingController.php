<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Mail\TrekkingEnquiryMail;
use App\Models\Trekking;
use App\Models\TrekkingCostInclude;
use App\Models\TrekkingEnquiry;
use App\Models\TrekkingItinerary;
use App\Models\TrekkingLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

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
            $trekking = Trekking::where('slug', $slug)->with('trekkingItinerary', 'trekkingCostInclude','location')->first();
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
                if ($trekking['map'] != null) {
                    $trekking['map'] = config('app.url') . "/" . $trekking['map'];
                }

                $trekking['region'] = $trekking->location->location ?? null;

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
        if ($location_id < 0) {
            return redirect()->route('api.tour');
        }
        try {
            $trekkings = Trekking::where('location_id', $location_id)->where('status', 1)->with('trekkingItinerary', 'trekkingCostInclude', 'location')->paginate(10);
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
                    if ($trekking['map'] != null) {
                        $trekking['map'] = config('app.url') . "/" . $trekking['map'];
                    }
                }
                $regions = TrekkingLocation::all();
                foreach ($regions as $region) {
                    $region['link'] = url("api/trekking/category/{$region->id}");
                }
                $data = [
                    'trekkings' => $trekkings,
                    'regions' => $regions,
                ];
                return $this->SendResponse($data, "Trekking data fetched successfully");
            } else {
                return $this->SendResponse("Data not found", "Cannot fetch trekking data", 404);
            }
        } catch (\Throwable $th) {
            return $this->SendError(throw $th, "Cannot fetch data", 500);
        }
    }

    public function enquiry(Request $request){
        $validate = Validator::make($request->all(),[
            'tripPackage' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phoneNumber' => 'required|min:10|max:15',
            'startDate' => 'required|date',
            'endDate' => "required|date|after_or_equal:startDate",
            'travellersNo' => 'required|integer|min:1',
        ]);

        if($validate->fails()){
            return $this->SendError($validate->errors(),"Validation fails",422);
        }
        try {
            $data = new TrekkingEnquiry();
            $data->tripPackage = $request->tripPackage;
            $data->name = $request->name;
            $data->email = $request->email;
            $data->phoneNumber = $request->phoneNumber;
            $data->startDate = $request->startDate;
            $data->endDate = $request->endDate;
            $data->travellersNo = $request->travellersNo;
            $data->save();

            Mail::to(config('mail.from.address'))
                    ->send(new TrekkingEnquiryMail($data,$request->email,$request->name));

            return $this->SendResponse("Success","Trekking Enquiry has been sent successfully",200);


        } catch (\Throwable $th) {
            Log::error("Trekking Enquiry Fails. \n Error => ".$th->getMessage());
            return $this->SendError(throw $th, "Failed to send enquiry", 500);
        }
    }
}
