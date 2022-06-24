<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ClockingController extends Controller
{
    //

    public function clock_userIn(Request $request){
        $data = json_decode($request->getContent(), true);
        if(User::where('clock_in_pin',$data["pin"])->count() > 0)
        {
            $user = User::where('clock_in_pin',$data["pin"])->first();
            return Response()->json(['error'=>'200','email'=>$user->email]);
        }else{
            return '401';
        }
    }

    public function sendsignal(){
        $response = $this->sendMessage();
        $return["allresponses"] = $response;
        $return = json_encode( $return);
        print("\n\nJSON received:\n");
        print($return);
        print("\n");
    }

    function sendMessage(){
        $content = array(
            "en" => 'Testing Message'
        );

        $fields = array(

            'app_id' => "6dcf1195-9d33-42b7-966e-fbc2ecea86e6",
            'included_segments' => array('All'),
            'data' => array("foo" => "givemore mvumbs"),
            'large_icon' =>"ic_launcher_round.png",
            'contents' => $content
        );

        $fields = json_encode($fields);
        print("\nJSON sent:\n");
        print($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
            'Authorization: Basic ZjU0ZWUxN2ItZjVlZi00ZTFjLTg5ODktZjNiZDUzZTllNmUx'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    public function savereportinfo(Request $request){
        $data = json_decode($request->getContent(), true);
        $image = $data["pic"];
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName =  ''.Carbon::now()->format('dmY_His').'.png';
        \File::put(public_path(). '/reportform/' . $imageName, base64_decode($image));
       // $Stockonhand_item->store_pic = $imageName;
        return Response()->json(["msg"=>"Successfully Saved"]);
    }
}
