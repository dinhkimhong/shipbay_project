<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estimate;
use App\Estimate_Detail;
use App\User;
use App\Shipping;
use App\Photo;
use App\Tracker;
use App\Carrier;
use Auth;
use Image;
use Validator;


class ShippingController extends Controller
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
        return view('shipping.index');
    }

    public function create(Request $request)
    {
        $estimate_id = $request->estimate_id;

        $estimate = Estimate::find($estimate_id);

        $estimate_id_array_in_estimates = Estimate::pluck('estimate_id')->all();
        $estimate_id_array_in_shipping = Shipping::pluck('estimate_id')->all();
        if(in_array($estimate_id,$estimate_id_array_in_estimates) && !in_array($estimate_id,$estimate_id_array_in_shipping))
        {
            $created_by = $estimate->created_by;
            $estimate_detail = Estimate_Detail::leftJoin('categories','categories.category_id','estimate_details.category_id')
                            ->where("estimate_details.estimate_id",$estimate_id)
                            ->get();
            return view('shipping.create',compact('estimate_id','estimate','estimate_detail'));
        }
        return back()->withError("Invalid registration number.");
    }


    public function save(Request $request)
    {

        $message=[
            'length_photo.image' => 'The photo must be a file of type: jpeg, png, bmp, gif, or svg',
            'width_photo.image' => 'The photo must be a file of type: jpeg, png, bmp, gif, or svg',
            'height_photo.image' => 'The photo must be a file of type: jpeg, png, bmp, gif, or svg',
            'weight_photo.image' => 'The photo must be a file of type: jpeg, png, bmp, gif, or svg',

            'length_photo.max' => 'Maximum file size to upload is 2.5MB. If you are uploading a photo of length, try to reduce its resolution to make it under 2.5MB.',
            'width_photo.max'=>'Maximum file size to upload is 2.5MB. If you are uploading a photo of width, try to reduce its resolution to make it under 2.5MB.',
            'height_photo.max'=>'Maximum file size to upload is 2.5MB. If you are uploading a photo of height, try to reduce its resolution to make it under 2.5MB.',
            'weight_photo.max'=>'Maximum file size to upload is 2.5MB. If you are uploading a photo of weight, try to reduce its resolution to make it under 2.5MB.',
        ];

        $validator = Validator::make($request->all(),[
            'length_photo' => 'image|max:2560',
            'width_photo' => 'image|max:2560',
            'height_photo' => 'image|max:2560',
            'weight_photo' => 'image|max:2560',
        ],$message);


        $estimate_id = $request->estimate_id;

        if($validator->passes()){
            $shipping = new Shipping;
            $shipping->estimate_id = $estimate_id;
            $shipping->length = $request->length;
            $shipping->width = $request->width;
            $shipping->height = $request->height;
            $shipping->weight = $request->weight;
            $shipping->shipping_cost = $request->shipping_cost;
            $shipping->created_by= Auth::user()->user_id;
            if($shipping->save()){

                $shipping_id = Shipping::latest('shippings.shipping_id')->value('shipping_id');

                $length_photo = $request->file('length_photo');
                $width_photo = $request->file('width_photo');
                $height_photo = $request->file('height_photo');
                $weight_photo = $request->file('weight_photo');


                $length_photo_name = "";
                $width_photo_name = "";
                $height_photo_name = "";
                $weight_photo_name = "";

                $photo = new Photo;
                $photo->shipping_id = $shipping_id;        

                if(!empty($length_photo)){
                    $length_photo_name = rand(11111,99999). ".".date('Y-m-d').".".time().".".$length_photo->getClientOriginalName();            
                    // $length_photo->storeAs('public',$length_photo_name);
                    $location = storage_path('app/public/' . $length_photo_name);
                    Image::make($length_photo)->resize(1000, 750)->save($location);
                    $photo->length_photo = $length_photo_name;            
                }
                if(!empty($width_photo)){
                    $width_photo_name = rand(11111,99999). ".".date('Y-m-d').".".time().".".$width_photo->getClientOriginalName(); 
                    // $width_photo->storeAs('public',$width_photo_name);
                    $location = storage_path('app/public/' . $width_photo_name);
                    Image::make($width_photo)->resize(1000, 750)->save($location);
                    $photo->width_photo = $width_photo_name;
                }        
                if(!empty($height_photo)){
                    $height_photo_name = rand(11111,99999). ".".date('Y-m-d').".".time().".".$height_photo->getClientOriginalName();
                   // $height_photo->storeAs('public',$height_photo_name);
                    $location = storage_path('app/public/' . $height_photo_name);
                    Image::make($height_photo)->resize(1000, 750)->save($location);
                    $photo->height_photo = $height_photo_name;
                }
                if(!empty($weight_photo)){
                    $weight_photo_name = rand(11111,99999). ".".date('Y-m-d').".".time().".".$weight_photo->getClientOriginalName();
                   // $weight_photo->storeAs('public',$weight_photo_name);
                    $location = storage_path('app/public/' . $weight_photo_name);
                    Image::make($weight_photo)->resize(1000, 750)->save($location);
                    $photo->weight_photo = $weight_photo_name;
                }
                $photo->save();
            }
            return redirect("/shipping")->withSuccess('Shipping no. ' . $shipping_id . ' has been created');
        } 
        return back()->withErrors($validator)->withInput();
    }
    public function list()
    {
        $shippings = Shipping::leftJoin('estimates','estimates.estimate_id','shippings.estimate_id')
                                ->leftJoin('users','users.user_id','estimates.created_by')
                                ->select('shippings.created_at','shippings.shipping_id','shippings.estimate_id','shippings.shipping_cost','shippings.paid','shippings.tracking_number','users.first_name','users.last_name')
                                ->orderBy('shippings.paid','ASC')
                                ->orderBy('shippings.tracking_number','ASC')
                                ->orderBy('shippings.shipping_id','ASC')
                                ->get();
        $carriers = Carrier::orderBy('carrier_name','ASC')->get();
        return view('shipping.list',compact('shippings','carriers'));
    }

    public function updatePayment(Request $request)
    {
        $shipping_id = $request->shipping_id;
        $paid = $request->paid? 1: 0;
        $shipping = Shipping::find($shipping_id);
        $shipping->paid = $paid;
        $shipping->save();
        return back();
    }

    public function updateTrackingNumber(Request $request)
    {
        $shipping_id = $request->shipping_id;
        $tracking_number = "EZ2000000002";
        $carrier = "USPS";

        $shipping = Shipping::find($shipping_id);
        $shipping->tracking_number = $tracking_number;
        $shipping->carrier = $carrier;      
        if($shipping->save()){
            \App\EasyPost\EasyPost::setApiKey("EZTK40a06ab291d4455faafc958f75415b28k0n7qOxzTV8TGovLomYNmA");
            $tracker = \App\EasyPost\Tracker::create(array(
              "tracking_code" => $tracking_number,
              "carrier" => $carrier
            ));

            $new_tracker = new Tracker;
            $new_tracker->tracking_code = $tracking_number;
            $new_tracker->tracker_id = $tracker->id;
            $new_tracker->save();
        }
        return back()->withSuccess('Updated tracking number in shipping no.' . $shipping_id . " successfully.");

    }    

    public function preview(Request $request)
    {
        $shipping_id = $request->shipping_id;
        $shipping = Shipping::find($shipping_id);
        $estimate = Estimate::find($shipping->estimate_id);
        $items = Estimate_Detail::where('estimate_id',$shipping->estimate_id)
                ->leftJoin('categories','categories.category_id','estimate_details.category_id')
                ->get();
        $photo = Photo::where('shipping_id',$shipping_id)->first();
        $result = array();
        $result['shipping'] = $shipping;
        $result['estimate'] = $estimate;
        $result['photo'] = $photo;
        $result['items'] = $items;
        return response()->json($result);
    }


    public function deletePage(){
        return view('shipping.delete');
    }

    public function delete(Request $request)
    {
        $shipping_id = $request->shipping_id;
        Shipping::destroy($shipping_id);
        return back()->withSuccess('Shipping no. ' . $shipping_id . ' has been deleted.');
    }
}
