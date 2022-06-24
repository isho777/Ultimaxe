<?php

namespace App\Http\Controllers;

use App\dealperiod;
use App\dealperiodprice;
use App\Product;
use App\Dealsheetsignature;
use App\Category;
use App\Pack;
use App\Customer;
use App\Currentdealapprover;
use Illuminate\Http\Request;

class DealperiodController extends Controller
{

    public function livedealsheet(){
        $livedealsheetinfo = [];
        $alldelsheets = Dealsheetsignature::all();
        // return Customer::where(['id',$sheetinfo->customername])->get();

        foreach($alldelsheets as $sheetinfo){
            $customerinfo = Customer::where(['id'=>$sheetinfo->customername])->first();
            if(count($customerinfo)  > 0) {
                array_push($livedealsheetinfo, ['customername' => $customerinfo->name,
                    'dealid' => $sheetinfo->dealid,
                    'livesheetid' => $sheetinfo->id,
                    'created_at' => $sheetinfo->created_at]);
            }

        };
        return view('dealsheetmodule.livedealsheet',[
            'livesheets'=>$livedealsheetinfo
        ]);
    }
   
    public function savedealproductprice(Request $request){

       $poductids =  explode(",",$request->pname);
       $productprices = explode(",",$request->pprice);
       
        if($poductids[0] != null && $productprices[0] != null){
            
            if(dealperiodprice::where(['deal_id'=>$request->dealid])->count() > 0){
                        dealperiodprice::where(['deal_id'=>$request->dealid])->delete();
            }

            if(true){
                        if($poductids[0] === "System #"){
                            $temparray = [];
                            for($index = 1; $index < count($poductids) ; $index++){
                                array_push($temparray,$poductids[$index]);
                            }

                            $poductids = $temparray;
                        }

                        for($index = 0; $index < count($poductids) ; $index++){
                            $dealperiod = new dealperiodprice();
                            $dealperiod->deal_id = $request->dealid;
                            $dealperiod->product_id = $poductids[$index];
                            $dealperiod->price = $productprices[$index];

                            if(!$dealperiod->save()){
                                return $this->getdealperiodbyidunsucessfull($request->dealid,'There was an error while updating deal period products.');
                            }
                        }

                     return $this->getdealperiodbyidsucessfull($request->dealid);

                    }
        }

        return $this->getdealperiodbyidunsucessfull($request->dealid,'Please atlist 1 deal products before updating deal period products.');
        
    }

    public function newdealperiod(Request $request){

        
        dealperiod::where('status','Active')
        ->update(['status'=>'Inactive']);

        $begining = date_format(date_create($request->startdate),"Y/m/d");
        $end = date_format(date_create($request->enddate),"Y/m/d");

        $dealperiod = new dealperiod();
        $dealperiod->status = 'notapproved';
        $dealperiod->begining = $begining;
        $dealperiod->end = $end;


        if($dealperiod->save()){
            return view('new_deal',[
            'sucess' => 'Successfully created new deal period.']);
        }else{
            return view('new_deal',[
                'error' => 'There was an error saving deal period.']);
        }

    }

    public function updatestatus($id){

        $dealperiod = dealperiod::where('id',$id)->first();
        if(count($dealperiod) > 0){
            $end = date_format(date_create($dealperiod->end),"Y/m/d");
            $date_now = date("Y/m/d");

            if ($date_now > $end) {
                return view('all_deals', ['dealperiods' => dealperiod::all()->sortByDesc("id"),
                'error'=>'You can not set a dealsheet that has a passed date to active.']);    
                
            }else{
                if($dealperiod->status == 'approved'){
                    dealperiod::where('active',1)->update(['active'=>0]);
                    if(dealperiod::where('id',$id)->update(['active'=>1])){
                        return view('all_deals', ['dealperiods' => dealperiod::all()->sortByDesc("id"),
                        'sucess'=>'Deal period is successfully activated and pushed to devices.']);    
                    }
                }else{
                    return view('all_deals', ['dealperiods' => dealperiod::all()->sortByDesc("id"),
                    'error'=>'Please approve deal period first and activate this deal period.']);        

                }
            }
        }{
            return view('all_deals', ['dealperiods' => dealperiod::all()->sortByDesc("id"),
            'error'=>'Sorry we did not find your dealperiod']);    
        }
    }

    public function getdealperiodbyid($dealid){
        $dealperiodproducts = [];
        $dealperiod = new dealperiod();
        $dealinfo = $dealperiod->where(['id'=>$dealid])->first();
        $dealcompleteinfo = [];
      
        $begining = date_format(date_create($dealinfo->begining),"Y/m/d");
        $end = date_format(date_create($dealinfo->end),"Y/m/d");

            $dealperiodprice = new dealperiodprice();
            $dealperiodproducts = $dealperiodprice->where(['deal_id'=>$dealinfo->id])->get();
            foreach($dealperiodproducts as $productinfo){
                $productinfoo = Product::where(['id'=>$productinfo->product_id])->first();
                array_push($dealcompleteinfo, ['product_id'=>$productinfo->product_id,
                'price'=>$productinfo->price,'product_name'=>$productinfoo->p_name,
                'pack'=>$productinfoo->p_size]);
            }

            $productinfo = [];
            $products = Product::all();
            foreach($products as $product){
                $category = category::where('id',$product->category)->get(['c_name']);
                $pack = Pack::where('id',$product->p_size)->get(['packsize','weightunit']);
                array_push($productinfo,['id'=>$product->id,
                'serialnumber'=>$product->serialnumber,
                'p_name'=>$product->p_name,
                'p_size'=>$pack[0]->packsize.''.$pack[0]->weightunit,
                'category'=>$category[0]->c_name]);
            }

            $approvername = null;
            $approversurname = null;
            $approversignature = null;
            $approveremail = null;

            if($dealinfo->status == 'approved'){

                if(Currentdealapprover::where('deal_id',$dealid)->count() > 0){
                    $approverinfo = Currentdealapprover::where('deal_id',$dealid)->first();
                    $approvername = $approverinfo->approvedby;
                    $approversurname = $approverinfo->surname;
                    $approversignature = $approverinfo->aproversignature;
                    $approveremail = $approverinfo->email;
                }
            }

            return view('dealsheet_info',['dealdata'=>$dealcompleteinfo,
            'deal_begining'=>$begining,
            'deal_ending'=>$end,
            'products'=>$productinfo,
            'dealid'=>$dealid,
            'approved'=>$dealinfo->status,
            'approvername'=>$approvername,
            'approversurname'=>$approversurname,
            'approversignature'=>$approversignature,
            'approveremail'=>$approveremail
            ]);      
            
            

            /////
           
    
            // return view('all_product', ['products' => $productinfo]);
        
    }
    public function getdealperiodbyidsucessfull($dealid){
        
        $dealperiodproducts = [];
        $dealperiod = new dealperiod();
        $dealinfo = $dealperiod->where(['id'=>$dealid])->first();
        $dealcompleteinfo = [];
      
        $begining = date_format(date_create($dealinfo->begining),"Y/m/d");
        $end = date_format(date_create($dealinfo->end),"Y/m/d");

            $dealperiodprice = new dealperiodprice();
            $dealperiodproducts = $dealperiodprice->where(['deal_id'=>$dealinfo->id])->get();
            foreach($dealperiodproducts as $productinfo){
                $productinfoo = Product::where(['id'=>$productinfo->product_id])->first();
                array_push($dealcompleteinfo, ['product_id'=>$productinfo->product_id,
                'price'=>$productinfo->price,'product_name'=>$productinfoo->p_name,
                'pack'=>$productinfoo->p_size]);
            }

            $productinfo = [];
            $products = Product::all();
            foreach($products as $product){
                $category = category::where('id',$product->category)->get(['c_name']);
                $pack = Pack::where('id',$product->p_size)->get(['packsize','weightunit']);
                array_push($productinfo,['id'=>$product->id,
                'serialnumber'=>$product->serialnumber,
                'p_name'=>$product->p_name,
                'p_size'=>$pack[0]->packsize.''.$pack[0]->weightunit,
                'category'=>$category[0]->c_name]);
            }

            $approvername = null;
            $approversurname = null;
            $approversignature = null;
            $approveremail = null;

            if($dealinfo->status == 'approved'){

                if(Currentdealapprover::where('deal_id',$dealid)->count() > 0){
                    $approverinfo = Currentdealapprover::where('deal_id',$dealid)->first();
                    $approvername = $approverinfo->approvedby;
                    $approversurname = $approverinfo->surname;
                    $approversignature = $approverinfo->aproversignature;
                    $approveremail = $approverinfo->email;
                }
            }

            return view('dealsheet_info',['dealdata'=>$dealcompleteinfo,
            'deal_begining'=>$begining,
            'deal_ending'=>$end,
            'products'=>$productinfo,
            'dealid'=>$dealid,
            'approved'=>$dealinfo->status,
            'approvername'=>$approvername,
            'approversurname'=>$approversurname,
            'approversignature'=>$approversignature,
            'approveremail'=>$approveremail,
            'sucess'=>'Deal period products are updated sucessfully.'
            ]);    
    }
    public function getdealperiodbyidunsucessfull($dealid,$message){
        
        $dealperiodproducts = [];
        $dealperiod = new dealperiod();
        $dealinfo = $dealperiod->where(['id'=>$dealid])->first();
        $dealcompleteinfo = [];
      
        $begining = date_format(date_create($dealinfo->begining),"Y/m/d");
        $end = date_format(date_create($dealinfo->end),"Y/m/d");

            $dealperiodprice = new dealperiodprice();
            $dealperiodproducts = $dealperiodprice->where(['deal_id'=>$dealinfo->id])->get();
            foreach($dealperiodproducts as $productinfo){
                $productinfoo = Product::where(['id'=>$productinfo->product_id])->first();
                array_push($dealcompleteinfo, ['product_id'=>$productinfo->product_id,
                'price'=>$productinfo->price,'product_name'=>$productinfoo->p_name,
                'pack'=>$productinfoo->p_size]);
            }

            $productinfo = [];
            $products = Product::all();
            foreach($products as $product){
                $category = category::where('id',$product->category)->get(['c_name']);
                $pack = Pack::where('id',$product->p_size)->get(['packsize','weightunit']);
                array_push($productinfo,['id'=>$product->id,
                'serialnumber'=>$product->serialnumber,
                'p_name'=>$product->p_name,
                'p_size'=>$pack[0]->packsize.''.$pack[0]->weightunit,
                'category'=>$category[0]->c_name]);
            }

            $approvername = null;
            $approversurname = null;
            $approversignature = null;
            $approveremail = null;

            if($dealinfo->status == 'approved'){

                if(Currentdealapprover::where('deal_id',$dealid)->count() > 0){
                    $approverinfo = Currentdealapprover::where('deal_id',$dealid)->first();
                    $approvername = $approverinfo->approvedby;
                    $approversurname = $approverinfo->surname;
                    $approversignature = $approverinfo->aproversignature;
                    $approveremail = $approverinfo->email;
                }
            }

            return view('dealsheet_info',['dealdata'=>$dealcompleteinfo,
            'deal_begining'=>$begining,
            'deal_ending'=>$end,
            'products'=>$productinfo,
            'dealid'=>$dealid,
            'approved'=>$dealinfo->status,
            'approvername'=>$approvername,
            'approversurname'=>$approversurname,
            'approversignature'=>$approversignature,
            'approveremail'=>$approveremail,
            'error'=>$message
            ]);   

           
            
        
    }
    public function getdealperiod(){
        
        $dealperiodproducts = [];
        $dealperiod = new dealperiod();
        $dealinfo = $dealperiod->where(['active'=>'1','status'=>'approved'])->first();
       
        $dealcompleteinfo = [];
      
        $begining = date_format(date_create($dealinfo->begining),"Y/m/d");
        $end = date_format(date_create($dealinfo->end),"Y/m/d");

        if(($begining <= date("Y/m/d") ) && ($end >= date("Y/m/d"))){

            $dealid = $dealinfo->id;
            // $dealperiodprice = new dealperiodprice();
            // $dealperiodproducts = $dealperiodprice->where(['deal_id'=>$dealinfo->id])->get();
            // foreach($dealperiodproducts as $productinfo){
            //     $productinfoo = Product::where(['id'=>$productinfo->product_id])->first();
            //     array_push($dealcompleteinfo, ['product_id'=>$productinfo->product_id,
            //     'price'=>$productinfo->price,'product_name'=>$productinfoo->p_name,
            //     'pack'=>$productinfoo->p_size]);
            // }
            // return Response()->json(['deal_id'=>$dealinfo->id,
            // 'deal_begining'=>date_format(date_create($begining),"d/m/Y"),
            // 'deal_ending'=>date_format(date_create($end),"d/m/Y"),
            // 'deal_prices'=>$dealcompleteinfo]);
            ////////////////////////////////////////
            $dealperiodproducts = [];
            $dealperiod = new dealperiod();
            $dealinfo = $dealperiod->where(['id'=>$dealid])->first();
            $dealcompleteinfo = [];
          
            $begining = date_format(date_create($dealinfo->begining),"Y/m/d");
            $end = date_format(date_create($dealinfo->end),"Y/m/d");
    
                $dealperiodprice = new dealperiodprice();
                $dealperiodproducts = $dealperiodprice->where(['deal_id'=>$dealinfo->id])->get();
                foreach($dealperiodproducts as $productinfo){
                    $productinfoo = Product::where(['id'=>$productinfo->product_id])->first();
                    array_push($dealcompleteinfo, ['product_id'=>$productinfo->product_id,
                    'price'=>$productinfo->price,'product_name'=>$productinfoo->p_name,
                    'pack'=>$productinfoo->p_size]);
                }
    
                $productinfo = [];
                $products = Product::all();
                foreach($products as $product){
                    $category = category::where('id',$product->category)->get(['c_name']);
                    $pack = Pack::where('id',$product->p_size)->get(['packsize','weightunit']);
                    array_push($productinfo,['id'=>$product->id,
                    'serialnumber'=>$product->serialnumber,
                    'p_name'=>$product->p_name,
                    'p_size'=>$pack[0]->packsize.''.$pack[0]->weightunit,
                    'category'=>$category[0]->c_name]);
                }
    
                $approvername = null;
                $approversurname = null;
                $approversignature = null;
                $approveremail = null;
    
                if($dealinfo->status == 'approved'){
    
                    if(Currentdealapprover::where('deal_id',$dealid)->count() > 0){
                        $approverinfo = Currentdealapprover::where('deal_id',$dealid)->first();
                        $approvername = $approverinfo->approvedby;
                        $approversurname = $approverinfo->surname;
                        $approversignature = $approverinfo->aproversignature;
                        $approveremail = $approverinfo->email;
                    }
                }
    
                return Response()->json(['dealdata'=>$dealcompleteinfo,
                'deal_begining'=>$begining,
                'deal_ending'=>$end,
                'products'=>$productinfo,
                'dealid'=>$dealid,
                'approved'=>$dealinfo->status,
                'approvername'=>$approvername,
                'approversurname'=>$approversurname,
                'approversignature'=>$approversignature,
                'approveremail'=>$approveremail
                ]);      
        }
        else{
            return 'nothing';
        }
        ///////////////////////////
        
        
        
    }

    public function getdeals(){
        return view('all_deals', ['dealperiods' => dealperiod::all()->sortByDesc("id")]);    
    }

    public function newdeal(){
        return view('new_deal');
    }

    public function alldatasheetinfo($deal){

        $livedealsheet = Dealsheetsignature::where(['id'=>$deal])->orderBy('id', 'desc')->first();
        $customerInfo = Customer::where('id',$livedealsheet->customername)->first();

        $dealperiodproducts = [];
        $dealperiod = new dealperiod();
        $dealinfo = $dealperiod->where(['id'=>$livedealsheet->dealid])->first();
        $dealcompleteinfo = [];
      
        $begining = date_format(date_create($dealinfo->begining),"Y/m/d");
        $end = date_format(date_create($dealinfo->end),"Y/m/d");

            $dealperiodprice = new dealperiodprice();
            $dealperiodproducts = $dealperiodprice->where(['deal_id'=>$dealinfo->id])->get();
            foreach($dealperiodproducts as $productinfo){
                $productinfoo = Product::where(['id'=>$productinfo->product_id])->first();
                array_push($dealcompleteinfo, ['product_id'=>$productinfo->product_id,
                'price'=>$productinfo->price,'product_name'=>$productinfoo->p_name,
                'pack'=>$productinfoo->p_size]);
            }

            $productinfo = [];
            $products = Product::all();
            foreach($products as $product){
                $category = category::where('id',$product->category)->get(['c_name']);
                $pack = Pack::where('id',$product->p_size)->get(['packsize','weightunit']);
                array_push($productinfo,['id'=>$product->id,
                'serialnumber'=>$product->serialnumber,
                'p_name'=>$product->p_name,
                'p_size'=>$pack[0]->packsize.''.$pack[0]->weightunit,
                'category'=>$category[0]->c_name]);
            }


        return view('dealperiod_signatures', ['deal' =>$livedealsheet,
        'approved' => 'approved',
        'products'=>$productinfo,        
        'deal_begining'=>$begining,
        'deal_ending'=>$end,
        'customerinformation' => $customerInfo,
        'customerid'=>$customerInfo->id,
        'dealdata'=>$dealcompleteinfo]); 
    }

    //Api Dealsheet
    public function searchcustomer(Request $request){

        $data = json_decode($request->getContent(), true);
        
       
        if(Customer::where('name',$data['customername'])->count() > 0){
            $customerInfo = Customer::where('name',$data['customername'])->first();
            $customername = $customerInfo->id;
            
            foreach(Dealsheetsignature::where(['customername'=>$customername])->orderBy('id', 'desc')->get() as $livedealsheet){
        
             //   $livedealsheet = ;

                $dealperiodproducts = [];
                $dealperiod = new dealperiod();
                $dealinfo = $dealperiod->where(['id'=>$livedealsheet->dealid])->first();
                $dealcompleteinfo = [];
              
                $begining = date_format(date_create($dealinfo->begining),"Y/m/d");
                $end = date_format(date_create($dealinfo->end),"Y/m/d");

                if(($begining <= date("Y/m/d") ) && ($end >= date("Y/m/d"))){                    
                    $dealperiodprice = new dealperiodprice();
                    $dealperiodproducts = $dealperiodprice->where(['deal_id'=>$dealinfo->id])->get();
                    foreach($dealperiodproducts as $productinfo){
                        $productinfoo = Product::where(['id'=>$productinfo->product_id])->first();
                        array_push($dealcompleteinfo, ['product_id'=>$productinfo->product_id,
                        'price'=>$productinfo->price,'product_name'=>$productinfoo->p_name,
                        'pack'=>$productinfoo->p_size]);
                    }
        
                    $productinfo = [];
                    $products = Product::all();
                    foreach($products as $product){
                        $category = category::where('id',$product->category)->get(['c_name']);
                        $pack = Pack::where('id',$product->p_size)->get(['packsize','weightunit']);
                        array_push($productinfo,['id'=>$product->id,
                        'serialnumber'=>$product->serialnumber,
                        'p_name'=>$product->p_name,
                        'p_size'=>$pack[0]->packsize.''.$pack[0]->weightunit,
                        'category'=>$category[0]->c_name]);
                    }
        
        
                    return Response()->json(['deal' =>$livedealsheet,
                    'error'=>'0',
                    'type' => 'live',
                    'products'=>$productinfo,        
                    'deal_begining'=>$begining,
                    'deal_ending'=>$end,
                    'customerinformation' => $customerInfo->name,
                    'customerid'=>$customerInfo->id,
                    'dealdata'=>$dealcompleteinfo]);
                }
            }
        }else{

            return Response()->json([
            'error'=>'1',
            'msg'=>'Customer is not found']);

        }


        $dealperiodproducts = [];
        $dealperiod = new dealperiod();
        $dealinfo = $dealperiod->where(['active'=>'1','status'=>'approved'])->first();
       
        $dealcompleteinfo = [];
      
        $begining = date_format(date_create($dealinfo->begining),"Y/m/d");
        $end = date_format(date_create($dealinfo->end),"Y/m/d");

        if(($begining <= date("Y/m/d") ) && ($end >= date("Y/m/d"))){
            $dealid = $dealinfo->id;
            // $dealperiodprice = new dealperiodprice();
            // $dealperiodproducts = $dealperiodprice->where(['deal_id'=>$dealinfo->id])->get();
            // foreach($dealperiodproducts as $productinfo){
            //     $productinfoo = Product::where(['id'=>$productinfo->product_id])->first();
            //     array_push($dealcompleteinfo, ['product_id'=>$productinfo->product_id,
            //     'price'=>$productinfo->price,'product_name'=>$productinfoo->p_name,
            //     'pack'=>$productinfoo->p_size]);
            // }
            // return Response()->json(['deal_id'=>$dealinfo->id,
            // 'deal_begining'=>date_format(date_create($begining),"d/m/Y"),
            // 'deal_ending'=>date_format(date_create($end),"d/m/Y"),
            // 'deal_prices'=>$dealcompleteinfo]);
            ////////////////////////////////////////
            $dealperiodproducts = [];
            $dealperiod = new dealperiod();
            $dealinfo = $dealperiod->where(['id'=>$dealid])->first();
            $dealcompleteinfo = [];
          
            $begining = date_format(date_create($dealinfo->begining),"Y/m/d");
            $end = date_format(date_create($dealinfo->end),"Y/m/d");
    
                $dealperiodprice = new dealperiodprice();
                $dealperiodproducts = $dealperiodprice->where(['deal_id'=>$dealinfo->id])->get();
                foreach($dealperiodproducts as $productinfo){
                    $productinfoo = Product::where(['id'=>$productinfo->product_id])->first();
                    array_push($dealcompleteinfo, ['product_id'=>$productinfo->product_id,
                    'price'=>$productinfo->price,'product_name'=>$productinfoo->p_name,
                    'pack'=>$productinfoo->p_size]);
                }
    
                $productinfo = [];
                $products = Product::all();
                foreach($products as $product){
                    $category = category::where('id',$product->category)->get(['c_name']);
                    $pack = Pack::where('id',$product->p_size)->get(['packsize','weightunit']);
                    array_push($productinfo,['id'=>$product->id,
                    'serialnumber'=>$product->serialnumber,
                    'p_name'=>$product->p_name,
                    'p_size'=>$pack[0]->packsize.''.$pack[0]->weightunit,
                    'category'=>$category[0]->c_name]);
                }
    
                $approvername = null;
                $approversurname = null;
                $approversignature = null;
                $approveremail = null;
    
                if($dealinfo->status == 'approved'){
    
                    if(Currentdealapprover::where('deal_id',$dealid)->count() > 0){
                        $approverinfo = Currentdealapprover::where('deal_id',$dealid)->first();
                        $approvername = $approverinfo->approvedby;
                        $approversurname = $approverinfo->surname;
                        $approversignature = $approverinfo->aproversignature;
                        $approveremail = $approverinfo->email;
                    }
                }
    
                return Response()->json(['dealdata'=>$dealcompleteinfo,
                'error'=>'0',
                'type' => 'current',                
                'deal_begining'=>$begining,
                'created_date'=>date_format(date_create($dealinfo->created_at),"Y/m/d"),
                'deal_ending'=>$end,
                'products'=>$productinfo,
                'dealid'=>$dealid,
                'approved'=>$dealinfo->status,
                'approvername'=>$approvername,
                'approversurname'=>$approversurname,
                'approversignature'=>$approversignature,
                'approveremail'=>$approveremail,
                'customerid'=>$customerInfo->id
                
                ]);      
        }
        else{
            return Response()->json([
                'error'=>'1',
                'type' => 'nothing']);
        }

            
        }
    }

