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

//------------ ishmael23032022 general controller for multitable queries
// convert mysql, postgres query to laravel eloquent query format:    https://sql2builder.github.io/ 


class genController extends Controller
{              
    public function __construct(){
      //$this->middleware('auth');
	  if (Auth::user()){ // Check is user logged in
         echo "Youre logged in";
         $example= "example";
         return View('novosti.create')->with('example', $example);		
        } else {
          return "You can't access here!";
        }
    }


     public function getUser($id){  //get user by id  example   
        $user = DB::table('users')
		        ->where('id', $id)
				->get(); //query builder
        return response($user, 200); // returns  json format to browser
    }        
       
    public function getLinkedDeviceObject($var){  //e.g. get a linked device info for user with a user id: $var
      
	  // Laravel Eloquent query format. Use https://sql2builder.github.io/  to convert sql to eloquent
      $data = DB::table('devices')
		->crossJoin('linkedevices')
		->crossJoin('users')
		->select('devices.d_brand', 'devices.d_serial_number')
		->where(function ($query) use ($var) {
	    $query->where('linkedevices.user_id','=', $var)
		->where('linkedevices.device_id','=',DB::raw('devices.id'));
         }) 
		->take(1)  // limit 1
        ->get();
       return response($data, 200);
     }
	 

    public function postDeviceObject(Request $request) {  // $request  comes from html as post request containing form-data: resources\views\registerdevice.php
													      // to post a new record to devices table using local laravel web  app          														        													
	  $id = $request->input('id');  // input(id) comes from html form input element
      echo 'Id: '.$id;
      echo '<br>';
        
      $d_serial_number = $request->input('d_serial_number'); 
      echo 'd_serial_number: '.$d_serial_number;
      echo '<br>';
          
      $d_brand = $request->input('d_brand'); ;
      echo 'd_brand: '.$d_brand;
	  echo '<br>';
	  
	  $created_at = date("Y-m-d H:i:s"); 
      echo 'created_at: '.$created_at;
	  echo '<br>';
	  
	  $updated_at = date("Y-m-d H:i:s");
      echo 'updated_at: '.$updated_at;
	  echo '<br>';
	  
	  $data=array('id'=>$id, "d_serial_number"=>$d_serial_number, "d_brand"=>$d_brand , "created_at"=>$created_at, "updated_at"=>$updated_at );
        $success = DB::table('devices')->insert($data);
		if ($success){
            echo "<br/>Record inserted successfully.<br/>";
            echo '<a href = "/ultimaxe/api/registerdevice">Insert another record</a> ';
		}else{
			echo "Error: Record not inserted .<br/>";
		}
    }
	
	
	public function createDevices($json){  
        
		//["id":20,"d_serial_number":"6135568090","d-brand":"HP","created_at": "2022-03-24 20:27:41", "updated_at":"2022-03-24 20:27:41"]
		$jsonarray =json_decode(json_encode($json),TRUE); // $b=your json array
		if($jsonarray){
		foreach ($jsonarray as $key => $value) 
		{
		 foreach ($value as $a => $b) 
		  {
			//$qry=DB::insert('insert into yourtable(paper_id,question_no,question,answer1,answer2,answer3,answer4,answerC,knowarea)values(?,?,?,?,?,?,?,?,?)',[$b['paper_id'],$b['question_no'],$b['question'],$b['answer1'],$b['answer2'],$b['answer3'],$b['answer4'],$b['answerC']$b['knowarea']);
		    $qry=DB::insert('insert into devices(id,d_serial_number,d_brand, created_at, updated_at)values(?,?,?,?,?)',[$b['id'],$b['d_serial_number'],$b['d_brand'],$b['created_at'],$b['d_updated_at']]); //index name will be paper_id,question_no etc
		  }
		}					
        }
        return response($jsonarray, 200); // returns  json format to browser
    }   
	
}


?>