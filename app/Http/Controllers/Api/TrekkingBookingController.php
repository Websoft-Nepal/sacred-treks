<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Models\TrekkingBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class TrekkingBookingController extends BaseController
{
    public function store(Request $request){
        $validat = Validator::make($request->all(),[
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'noOfAdults' => 'numeric',
            'noOfChildren' => 'numeric',
            'number' => 'required|string|max:30',
            'address' => 'nullable|string|max:255',
            'message' => 'nullable|string',
            'trekking_id' => 'required|exists:trekkings,id',
        ]);
        if($validat->fails()){
            return $this->SendError($validat->messages(),"Cannot book the trekking",400);
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
                'trekking_id' => $request->trekking_id,
            ];
            DB::beginTransaction();
            try{
                TrekkingBooking::create($data);
                DB::commit();
                return $this->SendResponse("Success","Trekking Booked successfully",200);
            }catch(\Throwable $th){
                DB::rollBack();
                return $this->SendError($th->getMessage(),"Cannot Book the trekking",500);
            }
        }
    }

}
