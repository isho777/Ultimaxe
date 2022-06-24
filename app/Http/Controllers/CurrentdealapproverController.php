<?php

namespace App\Http\Controllers;

use App\Currentdealapprover;
use App\dealperiod;
use App\dealperiodprice;
use App\Product;
use App\Category;
use App\Pack;

use Illuminate\Http\Request;

class CurrentdealapproverController extends Controller
{
    //

    public function approvedealperiod(Request $request){

        if(dealperiod::where('id', $request->dealid)->update(['status'=>'approved'])){
            $dealapprover = new Currentdealapprover();
            $dealapprover->deal_id = $request->dealid;
            $dealapprover->approvedby = $request->name;
            $dealapprover->surname = $request->lastname;
            $dealapprover->aproversignature = $request->signature;
            $dealapprover->email = $request->email;

            if($dealapprover->save()){
                return $this->getdealperiodbyidsucessfull($request->dealid);
            }else{
               return $this->getdealperiodbyidunsucessfull($request->dealid,"There was an error saving the approver information. Please try again");
            }
        };
       return $this->getdealperiodbyidunsucessfull($request->dealid,"There was an error approving a deal period.");
        
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
            'sucess'=>'Deal period is successfully approved.'
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
}
