<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\stockinhand;
use App\Stockonhand_item;
use App\Stockmovements;
use App\Customer;

class StockonhandController extends Controller
{

    public function index(){
        $Stockmovements = [];
        $allStockmovements = Stockmovements::all();

        foreach($allStockmovements as $sheetinfo){
            $userinfo = Customer::where(['id'=>$sheetinfo->custid])->first();
            if(count($userinfo)  > 0) {
                array_push($Stockmovements, [
                    'customerinfo' => $userinfo,
                    'sales_representative' => $sheetinfo->userinfo,
                    'pic' =>$sheetinfo->pic,
                    'id' => $sheetinfo->id,
                    'created_at' => $sheetinfo->created_at]);
            }
        };

        return view('stockmovement.index',[
            'Stockmovements'=>$Stockmovements
        ]);
    }
    public function getsockonhand(){
        return view('stockmovement.index',['Stockmovements'=>Stockonhand_item::all()]);
    }
    public function savestockonhand(Request $request)
    {
        $data = json_decode($request->getContent(), true);



        if(true){
                    $product = $data['products'];
                    if($product['ShelveQuantity'] != 0 || $product['StoreQuantity'] != 0){

                        $stockinhand = new stockinhand();
                        $stockinhand->userid = $data['custid'];
                        $stockinhand->customer = $data['userid0'];
                        $stockinhand->save();

                        $Stockonhand_item = new Stockonhand_item();
                        $Stockonhand_item->inhandid = $stockinhand->id;
                        $Stockonhand_item->product = $product["Productitem"];
                        $Stockonhand_item->pack = $product["Pack"];
                        $Stockonhand_item->store_quantity = $product["StoreQuantity"];
                        $Stockonhand_item->shelve_quantity = $product["ShelveQuantity"];

                        $Storepic = $product["Storepic"];
                        if(empty($Storepic)){
                        }else{
                            $image = $product["Storepic"];
                            $image = str_replace('data:image/png;base64,', '', $image);
                            $image = str_replace(' ', '+', $image);
                            $imageName =  ''.Carbon::now()->format('dmY_His').'.png';
                            \File::put(public_path(). '/stockonhandstor/' . $imageName, base64_decode($image));
                            $Stockonhand_item->store_pic = $imageName;

                        }
                        $ShelvePIc = $product["ShelvePic"];
                       if(empty($ShelvePIc)){}else{
                            $image = $product["ShelvePic"];
                            $image = str_replace('data:image/png;base64,', '', $image);
                            $image = str_replace(' ', '+', $image);
                            $imageName =  ''.Carbon::now()->format('dmY_His').'.png';
                            \File::put(public_path(). '/stockonhandshelve/' . $imageName, base64_decode($image));
                            $Stockonhand_item->shelve_pic = $imageName;

                        }

                        if($Stockonhand_item->save()){
                            return Responce()->json(["error"=>0]);
                        }
                }
            }            
    }

}
