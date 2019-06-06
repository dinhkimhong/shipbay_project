<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Shipping;
use App\Mail\ShippingDetail;
use App\User;
use App\Estimate;
use App\Mail\Question;
use App\Mail\ContactUs;


class MailController extends Controller
{

    public function emailShipping(Request $request)
    {
    	$shipping_id = $request->shipping_id;

    	$shipping = Shipping::leftJoin('estimates','estimates.estimate_id','shippings.estimate_id')
    				->select('shippings.shipping_id','shippings.estimate_id','shippings.shipping_cost','shippings.tracking_number','estimates.sender_name','estimates.sender_address','estimates.sender_city','estimates.sender_state','estimates.sender_country','estimates.sender_postal_code','estimates.contact','estimates.shipping_address','estimates.city','estimates.province','estimates.shipping_country','estimates.postal_code','estimates.created_by')
    				->where('shippings.shipping_id',$shipping_id)
    				->first();

    	$sender = User::find($shipping->created_by)->email;

    	Mail::to($sender)
    		->send(new ShippingDetail($shipping));


    }

    public function emailQuestion(Request $request)
    {
    	Mail::send(new Question());
    	return back()->with("success","Your question has been sent to customer service. We will check and respond to you as soon as possible.");
    }


     public function emailContactUs(Request $request)
    {
        $res = $this->post_captcha($_POST['g-recaptcha-response']);

        if (!$res['success']) {
            return back()->withError('Please check the form again. Make sure you fill all boxes and tick Im not a robot')->withInput();
        } else {
            Mail::send(new ContactUs());
            return back()->withSuccess('Thank you for contacting Shipbay. We will check and reply you at the soonest.');
        }
        

    }

    public function post_captcha($user_response) {
            $fields_string = '';
            $fields = array(
                'secret' => '6Le7LZ4UAAAAAHQGUmfNfUrNFrbTTJ10N1JUYqTA',
                'response' => $user_response
            );
            foreach($fields as $key=>$value)
                $fields_string .= $key . '=' . $value . '&';
                $fields_string = rtrim($fields_string, '&');
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
            curl_setopt($ch, CURLOPT_POST, count($fields));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $result = curl_exec($ch);
            curl_close($ch);

            return json_decode($result, true);
    }
}
