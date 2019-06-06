<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Estimate;
use App\Shipping;
use App\Estimate_Detail;
use App\State;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	return view('report.index');
    }

    public function registration()
    {
    	return view('report.registration');
    }

    public function registrationInfo(Request $request)
	{
		$start_date = $request->start_date;
		$end_date = $request->end_date;

		$estimate_id_array_in_shipping = Shipping::pluck('estimate_id')->all();
		$estimates = Estimate::whereDate('estimates.created_at','>=',$start_date)
					->whereDate('estimates.created_at','<=',$end_date)
					->leftJoin('users','users.user_id','estimates.created_by')
					->get();
		return view('report.registration_report',compact('estimate_id_array_in_shipping','estimates'));
    }

    public function shipping()
    {
    	return view('report.shipping');
    }

    public function shippingInfo(Request $request)
    {
    	$paid = $request->paid;
 		$start_date = $request->start_date;
		$end_date = $request->end_date;
		$shippings = Shipping::where('shippings.paid',$paid)
					->whereDate('shippings.created_at','>=',$start_date)
					->whereDate('shippings.created_at','<=',$end_date)
					->leftJoin('estimates','estimates.estimate_id','shippings.estimate_id')
					->leftJoin('users','users.user_id','estimates.created_by')
					->select('shippings.shipping_id','shippings.created_at','shippings.shipping_id','shippings.shipping_cost','shippings.tracking_number','users.first_name','users.last_name')
					->get(); 	
		return view('report.shipping_report',compact('shippings'));
    }

    public function shippingDetail()
    {
    	return view('report.shipping_detail');
    }

    public function shippingDetailInfo(Request $request)
    {
    	$shipped = $request->shipped;
 		$start_date = $request->start_date;
		$end_date = $request->end_date;
		
		if($shipped == 1){
			$shippings = Shipping::whereNotNull('tracking_number')
					->whereDate('created_at','>=',$start_date)
					->whereDate('created_at','<=',$end_date)
					->get();

		}else{
			$shippings = Shipping::whereNull('tracking_number')
					->whereDate('created_at','>=',$start_date)
					->whereDate('created_at','<=',$end_date)
					->get();
		}
		$estimate_id_array = array();
		foreach ($shippings as $shipping){
			$estimate_id_array[]= $shipping->estimate_id;
		}
		$estimate_details = array();
		$items = array();

		foreach($estimate_id_array as $estimate_id){
			$estimate_details[] = Estimate_Detail::leftJoin('shippings','shippings.estimate_id','estimate_details.estimate_id')
								->leftJoin('estimates','estimates.estimate_id','estimate_details.estimate_id')
								->leftJoin('users','users.user_id','estimates.created_by')
								->where('estimate_details.estimate_id',$estimate_id)
								->select('shippings.created_at','shippings.shipping_id','users.first_name','users.last_name','estimates.shipping_country','estimate_details.item','estimate_details.quantity','estimate_details.price')
								->get();
		}
		
		foreach ($estimate_details as $details)
		{
			foreach($details as $item)
			{
				$items[] = $item;
			}
		}
		return view('report.shipping_detail_report',compact('items'));

    }

    public function sales()
    {
    	$states = State::orderBy('state','ASC')->get();
    	return view('report.sales',compact('states'));
    }

    public function salesInfo(Request $request)
    {
    	$user_id = $request->user_id;
    	$state_id = $request->state_id;
 		$start_date = $request->start_date;
		$end_date = $request->end_date;
		$rows = array();
		if ($state_id == "all"){
			if(empty($user_id)){
				$rows = Shipping::where('shippings.paid',1)
					->whereDate('shippings.created_at','>=',$start_date)
					->whereDate('shippings.created_at','<=',$end_date)
					->leftJoin('estimates','estimates.estimate_id','shippings.estimate_id')
					->leftJoin('users','users.user_id','estimates.created_by')
					->leftJoin('states','states.state_id','users.state_id')
					->select('shippings.created_at','shippings.shipping_id','estimates.estimate_id','users.user_id','shippings.shipping_cost','users.first_name','users.last_name','states.state')
					->get();

			}else{
				$rows = Shipping::where('shippings.paid',1)
					->whereDate('shippings.created_at','>=',$start_date)
					->whereDate('shippings.created_at','<=',$end_date)
					->leftJoin('estimates','estimates.estimate_id','shippings.estimate_id')
					->leftJoin('users','users.user_id','estimates.created_by')
					->where('estimates.created_by',$user_id)
					->leftJoin('states','states.state_id','users.state_id')
					->select('shippings.created_at','shippings.shipping_id','estimates.estimate_id','users.user_id','shippings.shipping_cost','users.first_name','users.last_name','states.state')
					->get();
			}
		}else{
			if(empty($user_id)){
				$rows = Shipping::where('shippings.paid',1)
					->whereDate('shippings.created_at','>=',$start_date)
					->whereDate('shippings.created_at','<=',$end_date)
					->leftJoin('estimates','estimates.estimate_id','shippings.estimate_id')
					->leftJoin('users','users.user_id','estimates.created_by')
					->where('users.state_id',$state_id)
					->leftJoin('states','states.state_id','users.state_id')
					->select('shippings.created_at','shippings.shipping_id','estimates.estimate_id','users.user_id','shippings.shipping_cost','users.first_name','users.last_name','states.state')
					->get();

			}else{
				$rows = Shipping::where('shippings.paid',1)
					->whereDate('shippings.created_at','>=',$start_date)
					->whereDate('shippings.created_at','<=',$end_date)
					->leftJoin('estimates','estimates.estimate_id','shippings.estimate_id')
					->leftJoin('users','users.user_id','estimates.created_by')
					->where('estimates.created_by',$user_id)
					->where('users.state_id',$state_id)
					->leftJoin('states','states.state_id','users.state_id')
					->select('shippings.created_at','shippings.shipping_id','estimates.estimate_id','users.user_id','shippings.shipping_cost','users.first_name','users.last_name','states.state')
					->get();
			}			
		} 

		return view('report.sales_report',compact('rows'));
    }
}
