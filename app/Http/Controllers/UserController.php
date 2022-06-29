<?php

namespace App\Http\Controllers;
use App\User;
use App\Role;
use App\Department;
use Auth;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;
use Mail;

class UserController extends Controller
{
    //

    public function emailtesting(){
        $user = null;
        Mail::send('emails.reminds', ['user' => $user], function ($m) use ($user) {
            $m->from('mr.reception@gmail.com', 'Live Dealsheet');

            $m->to('tpeloewetse@gmail.com','Ultimex Dealsheet')->subject('Your Delsheet!');
        });
    }
    public function apilogin(Request $request){
				
		//$header = $request->header('Authorization');
		//$headers = $request->header();
		//$user_agent = $request->header('APP_KEY');
				
        $data = json_decode($request->getContent(), true);
        // $userinfor = User::where(['email'=>])
        // bcrypt($data['password'])
        ///return $data["password"];

        if (Auth::attempt(['email'=>$data["email"],
        'password'=>$data["password"]])) {

            authenticated();
						
            $user = Auth::user();
            return Response()->json(['error'=>'0',
            'msg'=>'Login Successfull',
                'usernames'=>$user->name,
                'id'=>$user->id]);
        }else{
            return Response()->json(['error'=>'1',
            'msg'=>'Login Unsuccessfull']);
        }

        return Response()->json(['error'=>'1',
        'msg'=>'Login Unsuccessfull']);
    }
	
    public function getallusers(){		
        $resultinfo = [];
        foreach(User::all() as $user){
            $userole = '';
            $userepartment = '';
            $role = Role::where(['id'=>$user->role])->get(['rol_name']);
            $department = Department::where(['id'=>$user->department])->get(['name']);

            if($role->count() > 0){
                $userole = $role[0]->rol_name;
            }
            if($department->count() > 0){
                $userepartment = $department[0]->name;
            }
                array_push($resultinfo,[ 
                    'id'=>$user->id,
                    'role'=>$userole,
                    'email' =>$user->email ,
                    'name'=>$user->name,
                    'lastname'=>$user->lastname,
                    'status'=>$user->status,
                    'department'=>$userepartment,
                    ]);
        }
        return $resultinfo;
    }
	
	public function getallusers_api(){		
		if (!Auth::check()) {
			return "Please log in.";					
		}
					
        $resultinfo = [];
        foreach(User::all() as $user){
            $userole = '';
            $userepartment = '';
            $role = Role::where(['id'=>$user->role])->get(['rol_name']);
            $department = Department::where(['id'=>$user->department])->get(['name']);

            if($role->count() > 0){
                $userole = $role[0]->rol_name;
            }
            if($department->count() > 0){
                $userepartment = $department[0]->name;
            }
                array_push($resultinfo,[ 
                    'id'=>$user->id,
                    'role'=>$userole,
                    'email' =>$user->email ,
                    'name'=>$user->name,
                    'lastname'=>$user->lastname,
                    'status'=>$user->status,
                    'department'=>$userepartment,
                    ]);
        }
        return $resultinfo;
    }
	
	
    public function newuser_view(){
      //  return $this->getallusers();        
        return view('usermodule.newuser',['users'=>$this->getallusers(),
        'role'=>Role::all(),
        'departments'=>Department::all(),
        'newuser'=>'']);
    }
    public function user_view(){
        //  return $this->getallusers();        
          return view('usermodule.newuser',['users'=>$this->getallusers(),
          'role'=>Role::all(),
          'departments'=>Department::all()]);
    }
	  
	public function user_view_api(){
        //  return $this->getallusers();        
        return auth('api')->user();
		//return auth()->guard('APP_KEY')->user(); 
		//return $request->user(); 
		return auth('api')->user()->user_id;
    }
	
	public function getcurrentuser_api(){
		if (!Auth::check()) {
			return "Please log in";					
		}
		
        $user = Auth::user();
		return $user;
    }
	
    public function getuserbyid_api($id){
		if (!Auth::check()) {
			return "Please log in";					
		}
        $user = User::where('id',$id)->firstOrFail();
        return $user;
    }
	
	 public function getuserbyemail_api($email){
		if (!Auth::check()) {
			return "Please log in";					
		}
        $user = User::where('email',$email)->firstOrFail();
        return $user;
    }
    
      public function updateuserinfo(Request $request){
     		  
        $user = User::find($request->id);              
        $user->name = $request->name;
        $user->lastname = $request->lastname;

        if($user->save()){
            return view('usermodule.newuser',[
                'sucess' => 'System user is successfully updated.',
                'users'=>$this->getallusers(),
                'role'=>Role::all(),
                'departments'=>Department::all()]);
        }else{
            return view('usermodule.newuser',[
                'error' => 'There was an error while updating the system user.',
                'users'=>$this->getallusers(),
                'role'=>Role::all(),
                'departments'=>Department::all()]);
        }
      
    }
	
	public function updateuserinfo_api(Request $request){
		if (!Auth::check()) {
			return "Please log in";					
		}
		
	    $resultinfo = [];	
        $user = User::find($request->id);              
        $user->name = $request->name;
        $user->lastname = $request->lastname;

        if($user->save()){
       
			array_push($resultinfo,[ 
                 'sucess' => 'System user is successfully updated.',
                'users'=>$this->getallusers(),
                'role'=>Role::all(),
                'departments'=>Department::all()]);			
        }else{
       
			array_push($resultinfo,[ 
                'error' => 'There was an error while updating the system user.',
                'users'=>$this->getallusers(),
                'role'=>Role::all(),
                'departments'=>Department::all()]);			
        }
      return $resultinfo;
    }
    public function updateuserrole(Request $request){
		
        $user = User::find($request->id);
       
        
        $user->role = $request->role;

        if($user->save()){
            return view('usermodule.newuser',[
                'sucess' => 'System user role is successfully updated.',
                'users'=>$this->getallusers(),
                'role'=>Role::all(),
                'departments'=>Department::all()]);
        }else{
            return view('usermodule.newuser',[
                'error' => 'There was an error while updating user role.',
                'users'=>$this->getallusers(),
                'role'=>Role::all(),
                'departments'=>Department::all()]);
        }
      
    }
	
	public function updateuserrole_api(Request $request){
	    if (!Auth::check()) {
			return "Please log in";					
		}
		$resultinfo = [];	
        $user = User::find($request->id);
               
        $user->role = $request->role;

        if($user->save()){         
				
		array_push($resultinfo,[ 
                 'sucess' => 'System user role is successfully updated.',
                'users'=>$this->getallusers(),
                'role'=>Role::all(),
                'departments'=>Department::all()]);
        }else{
         
				
				   array_push($resultinfo,[ 
                     'error' => 'There was an error while updating user role.',
                'users'=>$this->getallusers(),
                'role'=>Role::all(),
                'departments'=>Department::all()]);
        }
      return $resultinfo;
    }
    
    public function updateuserdepartment(Request $request){
        $user = User::find($request->id);
       
        $user->department = $request->department;

        if($user->save()){
            return view('usermodule.newuser',[
                'sucess' => 'System user role is successfully updated.',
                'users'=>$this->getallusers(),
                'role'=>Role::all(),
                'departments'=>Department::all()]);
        }else{
            return view('usermodule.newuser',[
                'error' => 'There was an error while updating user role.',
                'users'=>$this->getallusers(),
                'role'=>Role::all(),
                'departments'=>Department::all()]);
        }      
    }
	
	public function updateuserdepartment_api(Request $request){
		if (!Auth::check()) {
			return "Please log in";					
		}
		$userinfo = [];	
        $user = User::find($request->id);       
        $user->department = $request->department;
        if($user->save()){           			
			array_push($userinfo,[ 
                'sucess' => 'System user role is successfully updated.',
                'users'=>$this->getallusers(),
                'role'=>Role::all(),
                'departments'=>Department::all()]);			
        }else{          
			array_push($userinfo,[ 
                   'error' => 'There was an error while updating user role.',
                'users'=>$this->getallusers(),
                'role'=>Role::all(),
                'departments'=>Department::all()]);				
        }
        return $userinfo;
    }
	
    public function newuser(Request $request){
        if(User::where(['email'=>$request->email])->count() == 0){

            $user = new User();
            $user->role = '0';
            $user->email = $request->email;
            $user->name = $request->name;
            $user->lastname = $request->lastname;
            $user->department = '0';
            $user->remember_token = '';
            $user->password = bcrypt($request->password);

            if($user->save()){
                return view('usermodule.newuser',[
                    'sucess' => 'System user is successfully created.',
                    'users'=>$this->getallusers(),
                    'role'=>Role::all(),
                    'departments'=>Department::all()]);
            }else{
                return view('usermodule.newuser',[
                    'error' => 'There was an error while creating system user. Please try again.',
                    'users'=>$this->getallusers(),
                    'role'=>Role::all(),
                    'departments'=>Department::all(),
                    'newuser'=>'']);
            }
        }else{
            return view('usermodule.newuser',[
                'error' => 'The user email already exists. Please use another email.',
                'users'=>$this->getallusers(),
                'role'=>Role::all(),
                'departments'=>Department::all(),
                'newuser'=>'']);
        }

    }
	
	 public function registeruser_api(Request $request){  //save new user
	    if (!Auth::check()) {
			return "Please log in";					
		}
		$resultinfo = [];	
        if(User::where(['email'=>$request->email])->count() == 0){
            $user = new User();
            $user->role = '0';
            $user->email = $request->email;
            $user->name = $request->name;
            $user->lastname = $request->lastname;
            $user->department = '0';
            $user->remember_token = '';
            $user->password = bcrypt($request->password);

            if($user->save()){             		
				//$saveduser = User::where('email',$request->email)->get();				
				 
			    $resultinfo = [ 'result' => '0', 
				               'message' => 'System user is successfully created:'.$request->email ,
							   'user' => $user];
				           							
            }else{
               	$resultinfo = [ 'result' => '-1', 
					          'message' => 'There was an error while creating system user. Please try again.' ];					
                  			
            }
        }else{
			
			$resultinfo = [ 'result' => '-1', 
					      'message' => 'The user email already exists:'.$request->email ];	
        }
		return json_encode( $resultinfo ); 
    }

    public function updateuserstatus($id,$status){		
        $user = User::find($id);     
        if($status == 0){
            $status = 1;
        }elseif($status == 1){
            $status = 0;
        }
        $user->status = $status;
        if($user->save()){
            return view('usermodule.newuser',[
                'sucess' => 'System user status is successfully updated.',
                'users'=>$this->getallusers(),
                'role'=>Role::all(),
                'departments'=>Department::all()]);
        }else{
            return view('usermodule.newuser',[
                'error' => 'There was an error while updating the system user status.',
                'users'=>$this->getallusers(),
                'role'=>Role::all(),
                'departments'=>Department::all()]);
        }      
    }
	
    public function updateuserstatus_api(Request $request){
		
		if (!Auth::check()) {
			return "Please log in";					
		}
		
		$resultinfo = [];	
        $user = User::find($request->id);
        $status = $request->status;		
        if($status == 0){
            $status = 1;
        }elseif($status == 1){
            $status = 0;
        }
        $user->status = $status;
        if($user->save()){
            
				array_push($resultinfo,[ 
                 'sucess' => 'System user status is successfully updated.',
                'users'=>$this->getallusers(),
                'role'=>Role::all(),
                'departments'=>Department::all()]);
        }else{
           
				array_push($resultinfo,[ 
                'error' => 'There was an error while updating the system user status.',
                'users'=>$this->getallusers(),
                'role'=>Role::all(),
                'departments'=>Department::all()]);
        }
      return $resultinfo;
    }
	
	public function testLoginSession(Request $request){
		
		//$session = \Session::getHandler()->read(SESSION_ID);
 
		if (Auth::check()) {
			return "Logged in...SessionKey=".$request->session()->get('sessionKey');	;					
		}
		else{
			return "Session Expired. Please log in." ;
		}
			
	}
	

}
