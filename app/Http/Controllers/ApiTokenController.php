<?php	
namespace App\Http\Controllers;

use App\Role;
use App\Department;
use Auth;
use Illuminate\Http\Request;
use Mail;
//use DB; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\Http;  //to handle api posts from outside the laravel website. To use laravel web pages put pages in \views\ folder  saved in .php extension
use Illuminate\Support\Str;
//------------ ishmael27032022 

class ApiTokenController extends Controller
{           
    
	/*
	public function bearerToken()
	{
	   $header = $this->header('Authorization', '');
	   if (Str::startsWith($header, 'Bearer ')) {
				return Str::substr($header, 7);
	   } 		
	}
	*/
		
	public function getToken(Request $request){ 
		
		
		// add api_token to users table
		//Schema::table('users', function ($table) {
		//	$table->string('api_token', 80)->after('password')
		//						->unique()
		//						->nullable()
		//						->default(null);
		//});
		
		// Create token for existing users, code can also be added to registerController
		//$token = Str::random(60);
		//$user = User::find(1);
		//$user-&gt;api_token = hash('sha256', $token); // &lt;- This will be used in client access
		//$user-&gt;save();
		
	   // $req = new Request;
        $token = $request->bearerToken(); 
        //echo "Token: ".$token; // returns  token to browser
		//return response("Token:".$token, 200); 
		 //$token = Str::random(60);
 
       //$request->user()->forceFill(['remember_token' => hash('sha256', $token),])->save();
	   //return ['token' => $token];  //return value as json format
	   
	   
       return response("Token:".$token, 200); 
        
    }     
	
	 public function update(Request $request)
    {
        $token = Str::random(60);
 
        $request->user()->forceFill([
            'api_token' => hash('sha256', $token),
        ])->save();
 
        return ['token' => $token];
    }
}
?>