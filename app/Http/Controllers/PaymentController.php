<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shipping;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use Stripe\Error;

class PaymentController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function charge(Request $request)
    {
    	Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

    	$token = $request->stripeToken;
    	$shipping_cost = $request->shipping_cost;
    	$estimate_id = $request->estimate_id;
    	$shipping = Shipping::where('estimate_id',$estimate_id)->first();
    	$shipping_id = $shipping->shipping_id;

    	try{
        $charge = Charge::create(array(
		    'amount' => $shipping_cost * 100,
		    'currency' => 'usd',
		    'description' => 'Payment for Shipping no. ' .$shipping_id . ' - Registration no. ' . $estimate_id,
		    'source' => $token,
		    'statement_descriptor' => 'Shipbay-Ref ' . $estimate_id,
        ));  

        Shipping::where('estimate_id',$estimate_id)->update(['paid'=>1,'stripe_charge_id'=>$charge->id]);
        return back()->withSuccess('Thank you for your payment. We will dispatch your package and advise destination tracking number shortly.');


    	}catch(Error\Card $e){
		  // Since it's a decline, \Stripe\Error\Card will be caught
		  $body = $e->getJsonBody();
		  $err  = $body['error'];
		  // print('Message is:' . $err['message'] . "\n");   
		  return back()->withError('Payment fail. Reason: ' . $err); 		

    	}


    }
}
