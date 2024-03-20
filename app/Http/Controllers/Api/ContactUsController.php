<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Mail\ContactMail;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends BaseController
{
    public function store(Request $request){
        $validation = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'number' => 'required|string|max:15',
            'message' =>'string',
        ]);
        if($validation->fails()){
            return $this->SendError($validation->messages(),"Please enter the requred fields",400);
        }else{
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'number' => $request->number,
                'message' => $request->message,
            ];
            DB::beginTransaction();
            try{
                $contact = ContactUs::create($data);
                $to = env('MAIL_FROM_ADDRESS') ?? "darshankc.xdezo@gmail.com";
                Mail::to($to)->send(new ContactMail($contact));
                DB::commit();
                return $this->SendResponse("Successfully send message","Mail send",200);
            }catch(\Throwable $th){
                DB::rollBack();
                return $this->SendError($th->getMessage(),"Cannot send mail",500);
            }
        }
    }
}
