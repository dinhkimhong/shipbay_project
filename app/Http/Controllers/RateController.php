<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shipping_Country;
use App\Rate;
use App\Zone;

class RateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$zones = Zone::orderBy('zone_id','ASC')->get();
    	return view('rate.index',compact('zones'));
    }

    public function searchByZone(Request $request)
    {
    	$zone_id = $request->zone_id;

    	$rates = Rate::where('zone_id',$zone_id)
    			->get();

    	return view('rate.search_by_zone',compact('rates','zone_id'));

    }

    public function update(Request $request){
    	$rate_id = $request->id;
    	$new_rate = $request->value;

    	$rate = Rate::find($rate_id);
    	$rate->rate = $new_rate;
    	$rate->save();
    }

}
