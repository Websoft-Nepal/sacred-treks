<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Mail\TrekkingBookingMail;
use App\Models\Trekking;
use App\Models\TrekkingBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

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
            'cost' => 'required|numeric',
            'payment' => 'payment',
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
                'cost' => $request->cost,
                'payment' => $request->payment,
            ];
            DB::beginTransaction();
            try{
                $trekkingBooking = TrekkingBooking::create($data);
                $trekking = Trekking::where('id',$trekkingBooking->trekking_id);
                $trekking->count++;
                $trekking->save();
                Mail::to($trekkingBooking->email)->send(new TrekkingBookingMail($trekkingBooking));
                DB::commit();
                return $this->SendResponse("Success","Trekking Booked successfully",200);
            }catch(\Throwable $th){
                DB::rollBack();
                return $this->SendError($th->getMessage(),"Cannot Book the trekking",500);
            }
        }
    }

}
