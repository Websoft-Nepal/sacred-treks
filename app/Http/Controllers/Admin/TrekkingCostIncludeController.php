<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TrekkingCostInclude;
use Illuminate\Http\Request;

class TrekkingCostIncludeController extends Controller
{
    public function index($trekking_id){
        $trekkingCost = TrekkingCostInclude::where('trekking_id',$trekking_id)->first();
        // dd($trekkingCost);
        return view('pages.trekking-cost-details.index',compact('trekkingCost','trekking_id'));
    }
    public function store(Request $request){
        // dd($request);
        $request->validate([
            'trekking_id' => 'required|exists:trekkings,id',
            'description' => 'required|string',
        ]);
        $trekkingCost = new TrekkingCostInclude();
        $trekkingCost->trekking_id = $request->trekking_id;
        $trekkingCost->description = $request->description;
        $trekkingCost->save();
        drakify('success');
        return redirect()->route('admin.trekking.cost.index',$trekkingCost->trekking_id);
    }
    public function update(Request $request,$id){
        $request->validate([
            'trekking_id' => 'required|exists:trekkings,id',
            'description' => 'required|string',
        ]);
        $trekkingCost = TrekkingCostInclude::findOrFail($id);
        $trekkingCost->trekking_id = $request->trekking_id;
        $trekkingCost->description = $request->description;
        $trekkingCost->save();
        drakify('success');
        return redirect()->route('admin.trekking.cost.index',$trekkingCost->trekking_id);
    }
    public function destroy($id){
        $trekkingCost = TrekkingCostInclude::findOrFail($id);
        $trekkingCost->delete();
        return redirect()->route('admin.trekking.cost.index',$trekkingCost->trekking_id);
    }
}
