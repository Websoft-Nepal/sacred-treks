<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Mail\TourEnquiryMail;
use App\Models\Tour;
use App\Models\TourEnquiry;
use App\Models\TourTransportation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class TourController extends BaseController
{
    public function index()
    {
        try {
            $tours = Tour::with('transportation')->where('status', 1)->paginate(10);
            $category = TourTransportation::all();
            foreach ($category as $catg) {
                $catg['link'] = url("api/tour/category/{$catg->id}");
            }
            foreach ($tours as $tour) {
                if ($tour['image'] != null) {
                    if (substr_count($tour['image'], 'http') < 1) {
                        $tour['image'] = config('app.url') . "/" . $tour['image'];
                    }
                }
                if ($tour['featureimg1'] != null) {
                    if (substr_count($tour['featureimg1'], 'http') < 1) {
                        $tour['featureimg1'] = config('app.url') . "/" . $tour['featureimg1'];
                    }
                }
                if ($tour['featureimg2'] != null) {
                    if (substr_count($tour['featureimg2'], 'http') < 1) {
                        $tour['featureimg2'] = config('app.url') . "/" . $tour['featureimg2'];
                    }
                }
                if ($tour['map'] != null) {
                    if (substr_count($tour['map'], 'http') < 1) {
                        $tour['map'] = config('app.url') . "/" . $tour['map'];
                    }
                }
            }
            $data = [
                'tours' => $tours,
                'category' => $category,
            ];
            return $this->SendResponse($data, "Tours data fetched successfully");
        } catch (\Exception $e) {
            return $this->SendError($e->getMessage(), "Can't fetch tours data", 500);
        }
    }
    public function show($slug)
    {
        try {
            $tour = Tour::where('slug', $slug)->with('transportation', 'tourItinerary', 'tourCostInclude')->first();
            if ($tour == NULL) {
                return $this->SendError("Unauthorize", "Data not found", 400);
            }
            if ($tour['image'] != null) {
                if (substr_count($tour['image'], 'http') < 1) {
                    $tour['image'] = config('app.url') . "/" . $tour['image'];
                }
            }
            if ($tour['featureimg1'] != null) {
                if (substr_count($tour['featureimg1'], 'http') < 1) {
                    $tour['featureimg1'] = config('app.url') . "/" . $tour['featureimg1'];
                }
            }
            if ($tour['featureimg2'] != null) {
                if (substr_count($tour['featureimg2'], 'http') < 1) {
                    $tour['featureimg2'] = config('app.url') . "/" . $tour['featureimg2'];
                }
            }
            if ($tour['map'] != null) {
                if (substr_count($tour['map'], 'http') < 1) {
                    $tour['map'] = config('app.url') . "/" . $tour['map'];
                }
            }

            // For parsing the html content in the description and change into text

            // $html_list = $tour->tourCostInclude->description;
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
            // $tour->tourCostInclude->description = $list;
            return $this->SendResponse($tour, "Tour data fetched successfully");
        } catch (\Throwable $th) {
            return $this->SendError($th->getMessage(), "Can't fetch tours data", 403);
        }
    }
    public function category($transportation_id)
    {
        try {
            if ($transportation_id < 0) {
                return redirect()->route('api.tour');
            }
            $tours = Tour::where('transportation_id', $transportation_id)->where('status', 1)->with('transportation', 'tourItinerary', 'tourCostInclude')
                ->paginate(10);
            if ($tours == NULL) {
                return $this->SendError("Unauthorize", "Data not found", 400);
            }
            foreach ($tours as $tour) {
                if ($tour['image'] != null) {
                    if (substr_count($tour['image'], 'http') < 1) {
                        $tour['image'] = config('app.url') . "/" . $tour['image'];
                    }
                }
                if ($tour['featureimg1'] != null) {
                    if (substr_count($tour['featureimg1'], 'http') < 1) {
                        $tour['featureimg1'] = config('app.url') . "/" . $tour['featureimg1'];
                    }
                }
                if ($tour['featureimg2'] != null) {
                    if (substr_count($tour['featureimg2'], 'http') < 1) {
                        $tour['featureimg2'] = config('app.url') . "/" . $tour['featureimg2'];
                    }
                }
                if ($tour['map'] != null) {
                    if (substr_count($tour['map'], 'http') < 1) {
                        $tour['map'] = config('app.url') . "/" . $tour['map'];
                    }
                }
            }

            $category = TourTransportation::all();
            foreach ($category as $catg) {
                $catg['link'] = url("api/tour/category/{$catg->id}");
            }
            $data = [
                'tours' => $tours,
                'category' => $category,
            ];
            return $this->SendResponse($data, "Tour data fetched successfully");
        } catch (\Throwable $th) {
            return $this->SendError($th->getMessage(), "Can't fetch tours data", 403);
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
            $data = new TourEnquiry();
            $data->tripPackage = $request->tripPackage;
            $data->name = $request->name;
            $data->email = $request->email;
            $data->phoneNumber = $request->phoneNumber;
            $data->startDate = $request->startDate;
            $data->endDate = $request->endDate;
            $data->travellersNo = $request->travellersNo;
            $data->save();

            Mail::to(config('mail.from.address'))
                    ->send(new TourEnquiryMail($data,$request->email,$request->name));

            return $this->SendResponse("Success","Tour Enquiry has been sent successfully",200);


        } catch (\Throwable $th) {
            Log::error("Trekking Enquiry Fails. \n Error => ".$th->getMessage());
            return $this->SendError(throw $th, "Failed to send enquiry", 500);
        }
    }
}
