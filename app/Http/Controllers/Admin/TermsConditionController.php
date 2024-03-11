<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TermsCondition;
use Illuminate\Http\Request;

class TermsConditionController extends Controller
{
    public function index(){
        $terms = TermsCondition::first();
        return view('pages.terms.index',compact('terms'));
    }

    public function update(Request $request,$id){
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required'
        ]);
        $term = TermsCondition::findorFail($id);
        $term->title = $request->title;
        $term->description = $request->description;
        $term->update();
        return redirect()->route('admin.terms.index');

    }
}
