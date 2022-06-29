<?php

namespace App\Http\Controllers;

use App\movement;
use Illuminate\Http\Request;
use App\Order;
use App\OrderItem;
use App\Stockmovements;
use Auth;
use DateTime;


class OrderController extends Controller
{
    
    public function getallorders(){
        return view("quotes.index",["quotes"=>Order::all()]);
    }
	
	public function getallorders_api(){
        if (!Auth::check()) {
			return "Please log in.";					
		}      	   
		
        $orders = Order::all();
        if(count($orders) > 0){
            return Response()->json(['result'=>'0',
                                     'orders'=>$orders]);
        }else{
            return Response()->json(['result'=>'-1', 'message'=>'No orders found.']);
        }
    }
	
	public function getorderbyid(Request $request){
     if (!Auth::check()) {
			return "Please log in";		
		}
        	
		$result =  Order::where('id',$request->id)->first();
        return $result;
    }
	
	public function getorderbymultiple (Request $request){
     if (!Auth::check()) {
			return "Please log in";
		}
        
		$creationstartdate="";
		$creationenddate="";
		if ( empty($request->creationstartdate) or is_null($request->creationstartdate)) {
			$creationstartdate= "1970-01-01 00:00:00";
			}else{
				 $creationstartdate= $request->creationstartdate;
			}
		if ( empty($request->creationenddate) or is_null($request->creationenddate)) {
			$creationenddate= "2099-12-31 00:00:00";
		}else{
			$creationenddate= $request->creationenddate;
		}			
		
		$result1 = Order::where([
		                       ['id', 'LIKE' , '%'.$request->id.'%'], 
		                       ['cust_order_number', 'LIKE' , '%'.$request->cust_order_number.'%'],							   
							   ['customer_name',  'LIKE' , '%'.$request->customer_name.'%'], 
							   ['sales_person',  'LIKE' , '%'.$request->sales_person.'%'], 
							   ['livesheetnumber',  'LIKE' , '%'.$request->livesheetnumber.'%'], 
							   ['email',  'LIKE' , '%'.$request->email.'%'],
							   ['phone',  'LIKE' , '%'.$request->phone.'%'] ])							 
							   ->get();   					 
							   
		$result2 = Order::whereBetween('created_at', [date($creationstartdate), date($creationenddate)])->get();
			
		return $result1->intersect($result2)->all();
			
    }
	

    public function getspecificorders($id){
        $order = Order::where('id',$id)->first();
        $price = null;
        
        foreach(OrderItem::where('orderid',$id)->get() as $orderinfo){
                $price = $price + $orderinfo->total_inc;
        };

        return view("quotes.quote",["orderinfo"=>OrderItem::where('orderid',$id)->get(),
        'ordernumber'=>"LVDSTQN10".$id,
        'totalprice'=>$price,
        'custname'=>$order->customer_name,
        'email'=>$order->email,
        'phone'=>$order->phone,
        'custsignature'=>$order->customer_signature,
        'sales_person'=>$order->sales_person,
        'sales_signatur'=>$order->sales_signatur,
        'cust_order_number'=>$order->cust_order_number,
        'created_at'=>$order->created_at,
        'livesheetnumber'=>$order->livesheetnumber,
        'pic'=>$order->pic]);
    }

    public function savequote(Request $request){



               
        $data = json_decode($request->getContent(), true);
        $products = $data['products'];


        $order = new Order();
        $order->livesheetnumber = str_replace("LVDST10","",$data["livesheetnumber"]);
        $order->cust_order_number = $data["cust_order_number"];
        $order->customer_name = $data["customer_name"];
        $order->customer_signature = $data["customer_signature"];
        $order->sales_person = $data["sales_person"];
        $order->sales_signatur = $data["sales_signatur"];
        $order->email = $data["email"];
        $order->phone = $data["phone"];

        if($order->save()){

            foreach($products as $product){

                $orderItem = new OrderItem();
                $orderItem->orderid = $order->id;
                $orderItem->serialnumber = $product['SerialNumber'];
                $orderItem->quantity = $product['Quantity'];
                $orderItem->price = $product['DealPrice'];
                $orderItem->total_inc = $product['totalincl'];
                $orderItem->total_excl = $product['totalexcl'];
                $orderItem->description = $product['Productitem'];
                $orderItem->packsize = $product['Pack'];     
                
                if(!$orderItem->save()){
                    return Response()->json(['error'=>'1',
                    'msg'=>'There was an error encountered.']); 
                }
            }
        }else{
                return Response()->json(['error'=>'1',
                'msg'=>'There was an errOrderControlleror encountered.']);
            }

        $image = $data["pic"];
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = $order->id.'.png';
        \File::put(public_path(). '/' . $imageName, base64_decode($image));
        $order->pic = $imageName;

        if($order->save()){

        }

         return Response()->json(['error'=>'0',
    'msg'=>'Successfully Saved']); 
    }

    public function savestockmovement(Request $request)
    {

        $data = json_decode($request->getContent(), true);

        $stockmovment = new Stockmovements();
        $stockmovment->userinfo =  $data['userid'];
        $stockmovment->custid =  $data['custid'];
        $image = $data["pic"];
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName =  rand(5, 15).'pic'. rand(5, 15).'.png';
        \File::put(public_path(). '/stockmovement/' . $imageName, base64_decode($image));
        $stockmovment->pic = $imageName;

        $movementid = null;

        if( $stockmovment->save()){
                    $movementid = $stockmovment->id;
                    $products = $data['products'];
            
                    foreach ($products as $product){
                        $stockorderItem = new movement();
                        $stockorderItem->serialnumber = $product['SerialNumber'];
                        $stockorderItem->quantity = $product['Quantity'];
                        $stockorderItem->stockmovement_id = $movementid;
                        if(!$stockorderItem->save()){
                            return Response()->json(['error'=>'1',
                            'msg'=>'There ws an error']);            
                        }
                    }
                    return Response()->json(['error'=>'0',
                        'msg'=>'Successfully Saved']);
        }
        
      
    }
}
