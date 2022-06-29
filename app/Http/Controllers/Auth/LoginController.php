<?php

namespace App\Http\Controllers\Auth;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
  /**
     * Display login page.
     * 
     * @return Renderable
     */
	use AuthenticatesUsers;
	  
	protected $redirectTo = '/home';

	 
    public function show()
    {
				
        return view('auth.login');
    }

    /**
     * Handle account login request
     * 
     * @param LoginRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function login_api(Request $request)
    {
						
		if (Auth::attempt(array('email' => $request->email, 'password' => $request->password))){
			 
			 $request->session()->put('sessionKey',hash("sha256", rand()));
			 $sessionKey = $request->session()->get('sessionKey');			 
            return "Login success. session key=".$sessionKey ;
			
        }else{
            return "Wrong Credentials";
        }
        die;
    }

    /**
     * Handle response after user authenticated
     * 
     * @param Request $request
     * @param Auth $user
     * 
     * @return \Illuminate\Http\Response
     */
    protected function authenticated(Request $request, $user) 
    {
		
        return redirect()->intended();
    }
	
	public function __construct()
    {		
        $this->middleware('guest')->except('logout');
    }
}
