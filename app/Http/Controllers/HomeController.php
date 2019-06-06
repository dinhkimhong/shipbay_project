<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Shipping_Country;
use App\Rate;
use App\Tracker;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home()
    {
        if(Auth::user()->authorizeRole('Admin')){
             return redirect()->route('shipping');
        }
        return redirect()->route('estimate');
    }

    public function index(){
        $shipping_countries = Shipping_Country::orderBy('country','ASC')->get();
        return view('index',compact('shipping_countries'));
    }

    public function rate(){
        $shipping_countries = Shipping_Country::orderBy('country','ASC')->get();
        return view('rate',compact('shipping_countries'));
    }

    public function contact()
    {
        return view('contact');
    }

    public function track()
    {
        return view('tracking');
    }

    public function track_result($tracking_code)
    {
            \App\EasyPost\EasyPost::setApiKey("EZTK40a06ab291d4455faafc958f75415b28k0n7qOxzTV8TGovLomYNmA");
            $all_tracking_codes = Tracker::pluck('tracking_code')->all();

            if(in_array($tracking_code,$all_tracking_codes)){
                $tracker = Tracker::find($tracking_code);
                $tracker_id = $tracker->tracker_id;

                $tracking = \App\EasyPost\Tracker::retrieve($tracker_id);

                $tracking_details = $tracking->tracking_details;
                // sort tracking_details by datetime
                usort($tracking_details,function($a, $b){
                    if($a->datetime == $b->datetime){ return 0 ; }
                    return ($a->datetime < $b->date_time) ? -1 : 1;
                });
                return view('tracking_result',compact('tracking_details','tracking_code'));                
            }
            return redirect()->route('track')->withError('There is no result for this tracking number.');

    }


    public function findRate(Request $request)
    {
        $weight = ceil($request->weight);
        $volume_weight = ceil(($request->length * $request->width * $request->height)/150);

        $weight_rate = "";

        if($weight > $volume_weight || $weight == $volume_weight){
            $weight_rate = $weight;
        } else{
            $weight_rate = $volume_weight;
        }

        $shipping_country = $request->shipping_country;

        $zone_id = Shipping_Country::where('country',$shipping_country)->pluck('zone_id')->first();

        if($weight_rate < 41){
            $rate = Rate::select('rate')
                        ->where('zone_id',$zone_id)
                        ->where('weight',$weight_rate)
                        ->first();
            return response()->json($rate);
        }else{
            $over_weight_rate = Rate::where('zone_id',$zone_id)
                                ->where('weight',41)
                                ->pluck('rate')->first();
            $weight_at_40 = Rate::where('zone_id',$zone_id)
                                ->where('weight',40)
                                ->pluck('rate')->first();
            $rate = array();
            $rate['rate'] = number_format($weight_at_40 + $over_weight_rate * ($weight_rate - 40),2);
            return response()->json($rate);
        }
    }

}
