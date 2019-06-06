<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estimate;
use App\Shipping;
use DB;
use Auth;

class OrderController extends Controller
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
        $estimates = DB::table('estimates')
                    ->leftJoin('shippings','shippings.estimate_id','estimates.estimate_id')
                    ->select('estimates.created_at','estimates.estimate_id','estimates.contact','estimates.shipping_cost as estimated_shipping_cost', 'estimates.tracking_code as estimate_tracking_code','shippings.shipping_cost as actual_shipping_cost','shippings.paid','shippings.tracking_number as shipping_tracking_number','estimates.label_url')
                    ->orderBy('created_at','ASC')
                    ->where('estimates.created_by',Auth::user()->user_id)
                    ->get();
        $estimate_id_in_shippings = Shipping::pluck('estimate_id')->all();


        return view('order.index',compact('estimate_id_in_shippings','estimates'));
    }
}
