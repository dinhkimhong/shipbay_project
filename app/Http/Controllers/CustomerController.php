<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function all()
    {
        $customers = User::join('role_user','role_user.user_id','users.user_id')
                ->where('role_user.role_id','US')
                ->get();
        return view('customer_control.index',compact('customers'));
    }

}
