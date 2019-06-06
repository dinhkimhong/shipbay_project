<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use App\Category;
use App\Estimate;
use App\Estimate_Detail;
use App\Shipping_Country;
use App\Rate;
use App\Shipping;
use App\Tracker;
use Auth;
use DB;
use Validator;

class EstimateController extends Controller
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
        $shipping_countries = Shipping_Country::orderBy("zone_id","ASC")->get();
        $contacts = Contact::join('shipping_countries','shipping_countries.shipping_country_id','contacts.shipping_country_id')
                ->where('contacts.created_by',Auth::user()->user_id)
                ->get();
        $categories = Category::orderBy("category","ASC")->get();

        return view('estimate.index',compact('contacts','categories','shipping_countries'));
    }

    public function create(Request $request){
        $message=[
            'category_id.*.required' => 'Please input category',
            'item.*.required'=>'Please input item',
            'quantity.*.required'=>'Please input quantity of this item',
            'price.*.required'=>'Please input price of this item',
            'total_amount.required'=>'Required',
            'item.required'=>'Required',
        ];

        $validator = Validator::make($request->all(),[
            'item' => 'required|array|min:1',
            'category_id.*'=>'required',
            'item.*'=>'required',
            'quantity.*'=>'required',
            'price.*'=>'required'
        ],$message);
        if($validator->passes()){
            \App\EasyPost\EasyPost::setApiKey(env('EASYPOST_SECRET_KEY'));
            try{
                $shipment = \App\EasyPost\Shipment::create(array(
                  "to_address" => array(
                    'name' => 'Shipbay.us',
                    'street1' => '417 Montgomery Street',
                    'street2' => '5th Floor',
                    'city' => 'San Francisco',
                    'state' => 'CA',
                    'zip' => '94104',
                    'country' => 'US',
                    'phone' => '3331114444',
                    'email' => 'support@shipbay.us'                    
                  ),
                  "from_address" => array(
                    'name' => $request->sender_name,
                    'street1' => $request->sender_address,
                    'street2' => '',
                    'city' => $request->sender_city,
                    'state' => $request->sender_state,
                    'zip' => $request->sender_postal_code,
                    'country' => $request->sender_country,
                    'phone' => $request->sender_tel,
                    'email' => Auth::user()->email
                  ),
                  "parcel" => array(
                    "length" => $request->length,
                    "width" => $request->width,
                    "height" => $request->height,
                    "weight" => $request->weight
                    )
                ));
                $shipment->buy(array(
                'rate'      => $shipment->lowest_rate($carriers=array('USPS'), $services=array('Express'))
                )); 
// get label_url, tracking_code and tracker_id
                $label_url = $shipment->postage_label->label_url;
                $tracking_code = $shipment->tracking_code;
                $shipment_id = $shipment->id;
                $tracker_id = $shipment->tracker->id;

                if(Estimate::create([
                    'sender_name'=>$request->sender_name,
                    'sender_address' =>$request->sender_address,
                    'sender_city'=>$request->sender_city,
                    'sender_state'=>$request->sender_state,
                    'sender_country'=>$request->sender_country,
                    'sender_postal_code'=>$request->sender_postal_code,
                    'sender_tel'=>$request->sender_tel,
                    'contact'=>$request->contact,
                    'shipping_address'=>$request->shipping_address, 
                    'city'=>$request->city, 'province'=>$request->province,
                    'shipping_country'=>$request->shipping_country,
                    'postal_code'=>$request->postal_code,
                    'tel'=>$request->tel,
                    'length'=>$request->length,
                    'width'=>$request->width,
                    'height'=>$request->height,
                    'weight'=>$request->weight,
                    'total_amount'=>$request->total_amount,
                    'shipping_cost'=>$request->shipping_cost,
                    'tracking_code'=>$tracking_code, 
                    'label_url'=>$label_url,
                    'easypost_inhouse_shipment_id'=>$shipment_id,
                    'note'=>$request->note,
                    'created_by'=>Auth::user()->user_id])){
                        //create estimate_details
                        $estimate_id = Estimate::latest('estimates.estimate_id')->value('estimate_id');
                        foreach($request->item as $key=>$value){
                            Estimate_Detail::create(['estimate_id'=>$estimate_id,
                                                    'category_id'=>$request->category_id[$key],
                                                    'item'=>$value,
                                                    'quantity'=>$request->quantity[$key],
                                                    'price'=>$request->price[$key]
                                                    ]);
                        }
                        //create tracker
                        $tracker = new Tracker;
                        $tracker->tracking_code = $tracking_code;
                        $tracker->tracker_id = $tracker_id;
                        $tracker->save();

                        return back()->with("success","Registration no. " . $estimate_id ." has been created. Now you can print 2 labels in Order History to attach with your package");
                    }

            } catch (\App\EasyPost\Error $e){
                $error = json_decode($e->getHttpBody());
                $error_message = $error->error->message;
                return back()->withError($error_message)->withInput();


            }
        }
        return back()->withErrors($validator)->withInput();
    }

    public function show($estimate_id)
    {
        $shipping_countries = Shipping_Country::orderBy("zone_id","ASC")->get();

        $contacts = Contact::orderBy("contact","ASC")
                    ->where("created_by", Auth::user()->user_id)
                    ->get();
        $categories = Category::orderBy("category","ASC")->get();

        $estimates = Estimate::join("contacts","contacts.contact_id","estimates.contact_id")
                    ->where("created_by", Auth::user()->user_id)
                    ->get();
        $est = Estimate::join("contacts","contacts.contact_id","estimates.contact_id")
                ->where("estimate_id",$estimate_id)
                ->where("created_by",Auth::user()->user_id)
                ->select("estimates.*","contacts.contact")                
                ->first();
        $estimate_detail = Estimate_Detail::where("estimate_id",$estimate_id)
                        ->get();

        return view('estimate.view',compact('contacts','categories','estimates','est','estimate_detail','shipping_countries'));
    }

    public function update(Request $request){
        $estimate_id = $request->estimate_id;

        $updated_estimate = Estimate::find($estimate_id);
        $updated_estimate->contact_id= $request->contact_id;
        $updated_estimate->shipping_address= $request->shipping_address;
        $updated_estimate->city= $request->city;
        $updated_estimate->province= $request->province;
        $updated_estimate->shipping_country= $request->shipping_country;
        $updated_estimate->postal_code= $request->postal_code;
        $updated_estimate->tel= $request->tel;
        $updated_estimate->length=$request->length;
        $updated_estimate->width= $request->width;
        $updated_estimate->height=$request->height;
        $updated_estimate->weight= $request->weight;
        $updated_estimate->total_amount= $request->total_amount;
        $updated_estimate->shipping_cost= $request->shipping_cost;
        $updated_estimate->note= $request->note;

        $message=[
            'category_id.*.required' => 'Please input category',
            'item.*.required'=>'Please input item',
            'quantity.*.required'=>'Please input quantity of this item',
            'price.*.required'=>'Please input price of this item',
            'total_amount.required'=>'Required',
            'item.required'=>'Required',
        ];

        $validator = Validator::make($request->all(),[
            'item' => 'required|array|min:1',
            'category_id.*'=>'required',
            'item.*'=>'required',
            'quantity.*'=>'required',
            'price.*'=>'required'
        ],$message);
        if($validator->passes()){
            if($updated_estimate->save()){
                    $old_detail = Estimate_Detail::where('estimate_id',$estimate_id);
                    if($old_detail->delete()){
                        foreach($request->item as $key=>$value){
                            Estimate_Detail::create(['estimate_id'=>$estimate_id,
                                                    'category_id'=>$request->category_id[$key],
                                                    'item'=>$value,
                                                    'quantity'=>$request->quantity[$key],
                                                    'price'=>$request->price[$key]
                                                    ]);
                        }
                    }
                return redirect()->route('estimate')->with('success','Estimate has been updated.');
            }
        }
        return redirect()->route('showEstimate',$estimate_id)->withErrors($validator)->withInput();        
    }

    public function delete(Request $request){

        if($request->ajax()){
            $estimate_id = $request->estimate_id;
            $detail = Estimate_Detail::where("estimate_id",$estimate_id);
            if($detail->delete()){
                Estimate::destroy($estimate_id);
            }                  
        }
    }

    public function print($estimate_id)
    {
        $estimate_id_array = Estimate::where('created_by',Auth::user()->user_id)
                            ->pluck('estimate_id')
                            ->all();
        if(in_array($estimate_id,$estimate_id_array)){
            $estimate = Estimate::where("estimate_id",$estimate_id)       
                    ->first();
            $estimate_detail = Estimate_Detail::where("estimate_id",$estimate_id)
                            ->get();

        return view('estimate.print',compact('estimate','estimate_detail'));
        }
        return redirect()->route('order');
    }

    public function findMeasurement(Request $request)
    {
        $estimate_id = $request->estimate_id;
        $customer_info = Estimate::find($estimate_id);
        $shipbay_info = Shipping::leftJoin('photos','photos.shipping_id','shippings.shipping_id')
                    ->where('estimate_id',$estimate_id)->first();
        $result = array();
        $result['customer_info'] = $customer_info;
        $result['shipbay_info'] = $shipbay_info;
        return response()->json($result);
    }

    public function preview(Request $request)
    {
        $estimate_id = $request->estimate_id;
        $estimate_id_array_in_shipping = Shipping::where('created_by',Auth::user()->user_id)
                            ->pluck('estimate_id')
                            ->all();
        if(in_array($estimate_id,$estimate_id_array_in_shipping)){
            $measurement = DB::table('shippings')
                        ->select('length','width','height','weight','shipping_cost')
                        ->where('estimate_id',$estimate_id)
                        ->first();
        }else{
            $measurement = DB::table('estimates')
                        ->select('length','width','height','weight','shipping_cost')
                        ->where('estimate_id',$estimate_id)
                        ->first();
        }
        $sender = DB::table('estimates')
                        ->select('sender_name','sender_address','sender_city','sender_state','sender_country','sender_postal_code','sender_tel','note')
                        ->where('estimate_id',$estimate_id)
                        ->first();
        $receiver = DB::table('estimates')
                ->select('contact','shipping_address','city','province','shipping_country','postal_code','tel','total_amount')
                ->where('estimate_id',$estimate_id)
                ->first();
        $items = Estimate_Detail::where('estimate_id',$estimate_id)
                ->leftJoin('categories','categories.category_id','estimate_details.category_id')
                ->get();

        $result = array();
        $result['sender'] = $sender;
        $result['measurement'] = $measurement;
        $result['receiver'] = $receiver;
        $result['items'] = $items;
        return response()->json($result);
    }

    public function updateShippingAddress(Request $request)
    {
        $estimate_id = $request->estimate_id;
        $estimate = Estimate::find($estimate_id);

        $estimate->sender_name = $request->sender_name;
        $estimate->sender_address = $request->sender_address;
        $estimate->sender_city = $request->sender_city;
        $estimate->sender_state = $request->sender_state;
        $estimate->sender_country = $request->sender_country;
        $estimate->sender_postal_code = $request->sender_postal_code;
        $estimate->sender_tel = $request->sender_tel;


        $estimate->contact = $request->contact;
        $estimate->shipping_address = $request->shipping_address;
        $estimate->city = $request->city;
        $estimate->province = $request->province;
        $estimate->shipping_country = $request->shipping_country;
        $estimate->postal_code = $request->postal_code;
        $estimate->tel = $request->tel;
        $estimate->save();
        return back()->withSuccess("Address of registration no. " . $estimate_id . " has been updated.");
    }



}
