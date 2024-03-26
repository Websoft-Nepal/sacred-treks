<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function index(){
        $subscribers = Subscriber::latest()->get();
        return view('pages.subscriber.index',compact('subscribers'));
    }
    public function destroy($id){
        $subsciber = Subscriber::findOrFail($id);
        drakify('success');
        return redirect()->route('admin.subscriber.index');
    }
}
