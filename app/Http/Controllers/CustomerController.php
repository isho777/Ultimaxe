<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;

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

        if(Customer::where(['tel' => $request->tel,'name'=>$request->name,'p_adres' => $request->p_adres,'posta_adres' => $request->posta_adres,'location' => $request->location,'emai_adress' => $request->emai_adress])->count() == 0){

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

    public function getcustomer($customerid){
        $customer =  Customer::where('id',$customerid)->first();
        return view('customersmodule.updatecustomer',[
            'customers' => $customer
            ]);
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
