<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\State;
use App\Country;
use App\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

            $user = User::create([
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'first_name'=>$data['first_name'],
                'last_name'=>$data['last_name'],
                'address'=>$data['address'],
                'city'=>$data['city'],
                'state_id'=>$data['state_id'],
                'country_id'=>$data['country_id'],
                'postal_code'=>$data['postal_code']
            ]);
            $user->roles()->attach(Role::where('role','User')->first());
            return $user;
    }

    //change display of Register
    public function showRegistrationForm() {
            $states = State::all();
            $countries = Country::all();
            return view('auth.register',compact("states","countries"));
    }    
}
