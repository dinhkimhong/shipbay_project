<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tracker;

class TrackingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('tracking.index');
    }

    public function tracking($tracking_code)
    {
            \App\EasyPost\EasyPost::setApiKey(env('EASYPOST_SECRET_KEY'));
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
                return view('tracking.result',compact('tracking_details','tracking_code'));                
            }
            return redirect()->route('tracking')->withError('There is no result for this tracking number.');

    }

}
