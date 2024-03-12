<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(){
        $contact = contact::first();
        return view('pages.contact.index',compact('contact'));
    }
    public function update(Request $request, $id){
        $request->validate([
          'phone' => 'required',
          'email' => 'required|email',
          'fax' => 'required',
        ]);
        $contact = contact::findorFail($id);
        $contact->phone = $request->phone;
        $contact->email = $request->email;
        $contact->fax = $request->fax;
        $contact->update();
        return redirect()->route('admin.contact.index');

    }
}
