<?php

//namespace App\Http\Controllers;
namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Session;
use Session;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LogoutController extends Controller
{
    /**
     * Log out account user.
     *
     * @return \Illuminate\Routing\Redirector
     */
    public function logout(Request $request)
    {
        Session::flush();
        
        Auth::logout();
       
	    //$sessionKey = Session::get('sessionKey');	  use this method if to log out anonymously without supplying login credentials: not safe
		$sessionKey = $request->get('sessionKey');	  
        return "Logout success. session key=".$sessionKey ;
    }
}