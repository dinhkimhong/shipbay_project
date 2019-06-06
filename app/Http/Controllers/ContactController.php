<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estimate;
use App\Contact;
use App\Shipping_Country;
use Auth;
use DB;

class ContactController extends Controller
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
    			->where('created_by',Auth::user()->user_id)
    			->get();
        return view('contact.index',compact("shipping_countries","contacts"));
    }

    public function create(Request $request)
    {
    	$new_contact = new Contact;
    	$new_contact->contact = $request->contact;
		$new_contact->company = $request->company;
		$new_contact->address = $request->address;
		$new_contact->city = $request->city;
		$new_contact->province = $request->province;
		$new_contact->shipping_country_id = $request->shipping_country_id;
		$new_contact->postal_code = $request->postal_code;
		$new_contact->tel = $request->tel;
		$new_contact->created_by = Auth::user()->user_id;
		$new_contact->save();

		return back();    	
    }

    public function findInfo(Request $request){
        $contact_id = $request->contact_id;
        $contact_info = Contact::join('shipping_countries','shipping_countries.shipping_country_id','contacts.shipping_country_id')
                ->select('contact','address','city','province','country','postal_code','tel')
                ->where('contact_id',$contact_id)
                ->first();
        return response()->json($contact_info);
    }

    public function show($contact_id)
    {
        $contact_id_array = Contact::where('created_by',Auth::user()->user_id)
                            ->pluck('contact_id')
                            ->all();
        if(!in_array($contact_id, $contact_id_array)){
            return redirect()->route('contact')->with('error','No authorization to view this contact');
        }else{
            $contact = Contact::join('shipping_countries','shipping_countries.shipping_country_id','contacts.shipping_country_id')
                ->where('contact_id',$contact_id)
                ->first();
            $shipping_countries = Shipping_Country::orderBy("zone_id","ASC")->get();
            $contacts = Contact::join('shipping_countries','shipping_countries.shipping_country_id','contacts.shipping_country_id')
                ->where('created_by',Auth::user()->user_id)
                ->get();
            return view('contact.view',compact('contact','shipping_countries','contacts'));
        }
    }

    public function update(Request $request){
        $contact_id = $request->contact_id;

        $contact = Contact::find($contact_id);
        $contact->contact = $request->contact;
        $contact->company = $request->company;
        $contact->address = $request->address;
        $contact->city = $request->city;
        $contact->province = $request->province;
        $contact->shipping_country_id = $request->shipping_country_id;
        $contact->postal_code = $request->postal_code;
        $contact->tel = $request->tel;
        $contact->save();
        return redirect()->route('contact')->with('success','Contact "'. $request->contact . '" has been updated');
    }

    public function delete(Request $request)
    {
        $contact_id_array = Contact::where('created_by',Auth::user()->user_id)
                            ->pluck('contact_id')
                            ->all();        
        if($request->ajax()){
            $contact_id = $request->contact_id;
            $contact = Contact::find($contact_id);
            $contact_name = $contact->contact;
            if($contact->delete()){
                return response()->json(['success'=>'Contact "' . $contact_name . ' " has been deleted']);
            }          
        }
        return response()->json(['error'=>'You are unable to delete this contact']);

    }



}
