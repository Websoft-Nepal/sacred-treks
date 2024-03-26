<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Throwable;

class SubscribeController extends BaseController
{
    public function store(Request $request){
        $validate = Validator::make($request->all,[
            'email' => 'required|email|max:255',
        ]);
        $subscriber = new Subscriber();
        $subscriber->email = $request->email;
        $subscriber->save();
        if($validate->fails()){
            return $this->SendError($validate->errors(),"Cannot subscribe",400);
        }else{
            $data = [
                'email' => $request->email,
            ];
            DB::beginTransaction();
            try{
                Subscriber::create($data);
                DB::commit();
                return $this->SendResponse("success","Successfully Subscribed",200);
            }catch(Throwable $th){
                DB::rollBack();
                return $this->SendError($th->getMessage(),"Cannot subscribe",500);
            }
        }
    }
}
