<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Auth;

class CustomerController extends Controller
{


    public function searchcustomer(Request $request){
      
        $data = json_decode($request->getContent(), true);
        $customerinfo = Customer::where('name',$data["customername"])->get();

        if(count($customerinfo) > 0){
            return Response()->json(['error'=>'0',
                'customerinfo'=>$customerinfo]);
        }else{
            return Response()->json(['error'=>'1']);
        }
    }
	

	

	
    public function newindex(){
      	
        return view('customersmodule.newcustomer',[
            'customers' => Customer::all(),
            'newcustomer' => '']);
    }

    public function getcustomerinfo(){
        return view('customersmodule.newcustomer',[
            'customers' => Customer::all()
            ]);

    }
	
	

    public function savecustomer(Request $request){
     	
        $customerinfo = new Customer();

        if(Customer::where(['emai_adress' => $request->emai_adress])->count() == 0){

            $customerinfo->name = $request->name;
            $customerinfo->p_adres = $request->p_adres;
            $customerinfo->posta_adres = $request->posta_adres;
            $customerinfo->location = $request->location;        
            $customerinfo->emai_adress = $request->emai_adress;  
            $customerinfo->tel = $request->tel;
            
            if($customerinfo->save()){
                return view('customersmodule.newcustomer',[
                    'customers' => Customer::all(),
                    'newcustomer' => '',
                    'sucess'=>'New customer is successfully saved in the system.']);
            }else{
                return view('customersmodule.newcustomer',[
                    'customers' => Customer::all(),
                    'newcustomer' => '',
                    'error'=>'There was an error in saving the customer in the system.']);    
            }
        }else{
            return view('customersmodule.newcustomer',[
                'customers' => Customer::all(),
                'newcustomer' => '',
                'error'=>'There was an error in saving the customer in the system.']);
        }
        
    }
	
	public function registercustomer_api(Request $request){//////////////////////
     	 if (!Auth::check()) {
			return "Please log in.";					
		}  
        $customerinfo = new Customer();
        $resultinfo = [];	
        if(Customer::where(['emai_adress' => $request->email])->count() == 0){

            $customerinfo->name = $request->name;
            $customerinfo->p_adres = $request->permanentaddress;
            $customerinfo->posta_adres = $request->postaladdress;
            $customerinfo->location = $request->location;        
            $customerinfo->emai_adress = $request->email;  
            $customerinfo->tel = $request->telephone;
            
            if($customerinfo->save()){
                	$resultinfo = [ 'result' => '0', 
				               'message' => 'Customer user was successfully created:'.$request->email ,
							   'user' => $customerinfo];
                  
            }else{
               	$resultinfo = [ 'result' => '-1', 
				               'message' => 'There was an error saving the customer.'];    
            }
        }else{
             	$resultinfo = [ 'result' => '-1', 
				               'message' => 'There was an error saving the customer.'];    
        }
        return json_encode( $resultinfo ); 
    }


    public function getcustomer($customerid){
     		
        $customer =  Customer::where('id',$customerid)->first();
        return view('customersmodule.updatecustomer',[
            'customers' => $customer
            ]);
    }
	 
	public function getallcustomers_api(){   //  get all customers
        if (!Auth::check()) {
			return "Please log in.";					
		}      	   
        $customersinfo = Customer::all();

        if(count($customersinfo) > 0){
            return Response()->json(['result'=>'0',
                                     'customersinfo'=>$customersinfo]);
        }else{
            return Response()->json(['result'=>'-1', 'message'=>'No customers found.']);
        }

    }
	
	
	public function getcustomerbyid_api(Request $request){ ////////////////////
     	if (!Auth::check()) {
			return "Please log in";		
		}
        $customer =  Customer::where('id',$request->id)->first();
         return $customer;
    }
    
	
	public function getcustomerbyname_api(Request $request){ ////////////////////
     	if (!Auth::check()) {
			return "Please log in";	
		}			
        $customer =  Customer::where('name',$request->name)->first();
        return $customer;
    }
	
    public function getcustomerbyemail_api(Request $request){ ////////////////////
     	if (!Auth::check()) {
			return "Please log in";		
		}
        $customer =  Customer::where('emai_adress',$request->email)->first();
        return $customer;
    }
	
							
		
       
		
		

    public function updatecustomer(Request $request){
      
        $customerinfo = Customer::where('id',$request->id)->first();
        $customerinfo->name = $request->name;
        $customerinfo->p_adres = $request->p_adres;
        $customerinfo->posta_adres = $request->posta_adres;
        $customerinfo->location = $request->location;        
        $customerinfo->emai_adress = $request->emai_adress;  
        $customerinfo->tel = $request->tel;
        
        if($customerinfo->save()){
            return view('customersmodule.newcustomer',[
                'customers' => Customer::all(),
                'sucess'=>'Existing customer is successfully updated in the system.']);
        }else{
            return view('customersmodule.updatecustomer',[
                'customers' =>Customer::where('id',$request->id)->first(),
                'newcustomer' => '',
                'error'=>'There was an error in saving the customer in the system.']);    
        }
        
    }
}
