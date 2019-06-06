<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Title;
use App\Country;
use App\State;
use App\Role;
use Auth;
use Validator;
use DB;

class UserController extends Controller
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
    	$titles = Title::all();
    	$states = State::orderBy('state','ASC')->get();
    	$countries = Country::all();
        return view('user.index',compact("titles","states","countries"));
    }

    public function update(Request $request)
    {
    	$company = $request->company;
    	$title_id = $request->title_id;
    	$first_name = $request->first_name;
    	$last_name=$request->last_name;
    	$address=$request->address;
    	$city=$request->city;
    	$state_id=$request->state_id;
    	$country_id=$request->country_id;
    	$postal_code=$request->postal_code;
    	$tel=$request->tel;

    	$user = User::find(Auth::user()->user_id);
    	$user->company = $company;
    	$user->title_id = $title_id;
    	$user->first_name = $first_name;
    	$user->last_name = $last_name;
    	$user->address = $address;
    	$user->city = $city;
    	$user->state_id = $state_id;
    	$user->country_id = $country_id;
    	$user->postal_code = $postal_code;
    	$user->tel = $tel;
    	$user->save();

    	return redirect()->route('setting')->withSuccess("Your account has been updated.");
    }

    public function allUsers()
    {
        $users = User::join('role_user','role_user.user_id','users.user_id')
                ->join('roles','roles.role_id','role_user.role_id')
                ->get();
        $roles = Role::orderBy('role','ASC')->get();
        return view('user_control.index',compact('users','roles'));
    }

    public function updatePassword(Request $request)
    {
        $message = [
            'new_password.min'=>'New password must has at least 6 characters'
        ];

        $validator = Validator::make($request->all(),[
            'new_password' => 'min:6'
        ],$message);


        $new_password = $request->new_password;
        $confirm_password = $request->confirm_password;

        $user_id = Auth::user()->user_id;

        if($validator->passes()){
            if($new_password == $confirm_password){
                $user = User::find($user_id);
                $user->password = Hash::make($new_password);
                $user->save();
                return back()->withSuccess('New password has been updated');
            } 
            return back()->withError('New password & Confirm password does not match')->withInput();         
        }
        return back()->withErrors($validator)->withInput();
    }  

    public function searchByLastName(Request $request)
    {
        $search_key = $request->term;
        $users = User::where('last_name','LIKE','%'.$search_key.'%')->get();
        $results = array();
        foreach ($users as $key=>$value)
        {
            $results[]=['id'=>$value->user_id,'value'=>$value->last_name,'first_name'=>$value->first_name];
        }
        return response()->json($results);
    }

    public function info(Request $request)
    {
        $user_id = $request->user_id;
        $user = User::leftJoin('role_user','role_user.user_id','users.user_id')
                ->leftJoin('roles','roles.role_id','role_user.role_id')
                ->where('users.user_id',$user_id)
                ->first();
        return response()->json($user);

    }

    public function updateRole(Request $request)
    {
        $user_id = $request->user_id;
        $role_id = $request->role_id;
        DB::table('role_user')
            ->where('user_id',$user_id)
            ->update(['role_id'=>$role_id]);
        return back()->withSuccess('User '. $user_id . ' has been updated role');    
    }
}
