<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Mail\TourBookingMail;
use App\Models\TourBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class TourBookingController extends BaseController
{
    public function store(Request $request){
        $validat = Validator::make($request->all(),[
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'noOfAdults' => 'numeric|nullable',
            'noOfChildren' => 'numeric|nullable',
            'number' => 'required|string|max:30',
            'address' => 'nullable|string|max:255',
            'message' => 'nullable|string',
            'tour_id' => 'required|exists:tours,id',
            'cost' => 'required|numeric',
            'payment' => 'required',
        ]);
        if($validat->fails()){
            return $this->SendError($validat->messages(),"Cannot book the tour",400);
        }else{
            $data = [
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'email' => $request->email,
                'noOfAdults' => $request->noOfAdults,
                'noOfChildren' => $request->noOfChildren,
                'number' => $request->number,
                'address' => $request->address,
                'message' => $request->message,
                'tour_id' => $request->tour_id,
                'cost' => $request->cost,
                'payment' => $request->payment,
            ];
            DB::beginTransaction();
            try{
                $tourBooking = TourBooking::create($data);
                Mail::to($tourBooking->email)->send(new TourBookingMail($tourBooking));
                DB::commit();
                return $this->SendResponse("Success","Tour Booked successfully",200);
            }catch(\Throwable $th){
                DB::rollBack();
                return $this->SendError($th->getMessage(),"Cannot Book the tour",500);
            }
        }
    }

}
