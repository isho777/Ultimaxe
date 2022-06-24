<?php

namespace App\Http\Controllers;

use App\Device;
use App\Deviceroute;
use App\User;
use App\Linkedevice;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    //

    public function newdevice(){
        $linkeduserinfo = [];
        $linkeduser = Linkedevice::all();

        foreach($linkeduser as $user){
            $userinfo = User::where('id',$user->user_id)->first();
            array_push($linkeduserinfo,['deviceid'=>$user->device_id,
            'username'=>$userinfo->name.' '.$userinfo->lastname]);
        }

        return view('devicemodule.newdevice',[
            'devices'=> Device::all(),
            'newdevice'=>'',
            'users'=>User::all(),
            'linkeduser'=>$linkeduserinfo]);
    }

    public function devicelisting(){
        $linkeduserinfo = [];
        $linkeduser = Linkedevice::all();

        foreach($linkeduser as $user){
            $userinfo = User::where('id',$user->user_id)->first();
            array_push($linkeduserinfo,['deviceid'=>$user->device_id,
            'username'=>$userinfo->name.' '.$userinfo->lastname]);
        }

        return view('devicemodule.newdevice',[
            'devices'=> Device::all(),
            'users'=>User::all(),
            'linkeduser'=>$linkeduserinfo]);
    }

    public function linksave_device(Request $request){

        Linkedevice::where(['device_id'=>$request->id])->delete();
        Linkedevice::where(['user_id'=>$request->user])->delete();
        
        $linkeddevice  = new Linkedevice();
        $linkeddevice->device_id = $request->id;
        $linkeddevice->user_id = $request->user;

        

        if($linkeddevice->save()){
            $linkeduserinfo = [];
            $linkeduser = Linkedevice::all();
    
            foreach($linkeduser as $user){
                $userinfo = User::where('id',$user->user_id)->first();
                array_push($linkeduserinfo,['deviceid'=>$user->device_id,
                'username'=>$userinfo->name.' '.$userinfo->lastname]);
            }

            return view('devicemodule.newdevice',[
                'sucess' => 'Device is successfully linked to a user.',
                'devices'=> Device::all(),
                
                'users'=>User::all(),
                'linkeduser'=>$linkeduserinfo]);
        }else{
            $linkeduserinfo = [];
            $linkeduser = Linkedevice::all();
    
            foreach($linkeduser as $user){
                $userinfo = User::where('id',$user->user_id)->first();
                array_push($linkeduserinfo,['deviceid'=>$user->device_id,
                'username'=>$userinfo->name.' '.$userinfo->lastname]);
            }

            return view('devicemodule.newdevice',[
                'error' => 'There was an error linking a device to a user.',
                'devices'=> Device::all(),
                'newdevice'=>'',
                'users'=>User::all(),
                'linkeduser'=>$linkeduserinfo]);
        }
    }

    public function savedevice(Request $request){

        if(Device::where(['d_serial_number'=>$request->serialnumber])->count() == 0){
            $device = new Device();

            $device->d_serial_number = $request->serialnumber;
            $device->d_brand = $request->brand;

            if($device->save()){
                $linkeduserinfo = [];
                $linkeduser = Linkedevice::all();
        
                foreach($linkeduser as $user){
                    $userinfo = User::where('id',$user->user_id)->first();
                    array_push($linkeduserinfo,['deviceid'=>$user->device_id,
                    'username'=>$userinfo->name.' '.$userinfo->lastname]);
                }
                return view('devicemodule.newdevice',[
                    'sucess' => 'Device is successfully created.',
                    'devices'=> Device::all(),
                    'newdevice'=>'',
                    'users'=>User::all(),
                    'linkeduser'=>$linkeduserinfo]);
            }else{
                $linkeduserinfo = [];
                $linkeduser = Linkedevice::all();
        
                foreach($linkeduser as $user){
                    $userinfo = User::where('id',$user->user_id)->first();
                    array_push($linkeduserinfo,['deviceid'=>$user->device_id,
                    'username'=>$userinfo->name.' '.$userinfo->lastname]);
                }
                return view('devicemodule.newdevice',[
                    'error' => 'There was a problem saving your device',
                    'devices'=> Device::all(),
                    'newdevice'=>'',
                    'users'=>User::all(),
                    'linkeduser'=>$linkeduserinfo]);
            }

        }else{
            $linkeduserinfo = [];
            $linkeduser = Linkedevice::all();
    
            foreach($linkeduser as $user){
                $userinfo = User::where('id',$user->user_id)->first();
                array_push($linkeduserinfo,['deviceid'=>$user->device_id,
                'username'=>$userinfo->name.' '.$userinfo->lastname]);
            }

            return view('devicemodule.newdevice',[
                'error' => 'There is a device of the same serial number. Please make sure that you are not adding the same device twice.',
                'devices'=> Device::all(),
                'newdevice'=>'',
                'users'=>User::all(),
                'linkeduser'=>$linkeduserinfo]);
        }
    }

    public function removedevice(Request $request){
        Linkedevice::where(['device_id'=>$request->id])->delete();
        Device::where(['id'=>$request->id])->delete();

        $linkeduserinfo = [];
        $linkeduser = Linkedevice::all();

        foreach($linkeduser as $user){
            $userinfo = User::where('id',$user->user_id)->first();
            array_push($linkeduserinfo,['deviceid'=>$user->device_id,
            'username'=>$userinfo->name.' '.$userinfo->lastname]);
        }

        return view('devicemodule.newdevice',[
            'devices'=> Device::all(),
            'sucess' => 'Device is successfully removed from the system.',
            'users'=>User::all(),
            'linkeduser'=>$linkeduserinfo]);
        
    }

    public function updatedevice(Request $request){


                if(Device::where(['d_serial_number'=>$request->serialnumber])->count() == 0 || Device::where(['d_serial_number'=>$request->serialnumber,'id'=>$request->id])->count() == 1){

                    $device = Device::where(['id'=>$request->id])->first();
                    $device->d_serial_number = $request->serialnumber;
                    $device->d_brand = $request->brand;
        
                    if($device->save()){
                        $linkeduserinfo = [];
                        $linkeduser = Linkedevice::all();
                
                        foreach($linkeduser as $user){
                            $userinfo = User::where('id',$user->user_id)->first();
                            array_push($linkeduserinfo,['deviceid'=>$user->device_id,
                            'username'=>$userinfo->name.' '.$userinfo->lastname]);
                        }

                        return view('devicemodule.newdevice',[
                            'sucess' => 'Device is successfully updated.',
                            'devices'=> Device::all(),
                            
                            'users'=>User::all(),
                            'linkeduser'=>$linkeduserinfo]);
                    }else{
                        $linkeduserinfo = [];
                        $linkeduser = Linkedevice::all();
                
                        foreach($linkeduser as $user){
                            $userinfo = User::where('id',$user->user_id)->first();
                            array_push($linkeduserinfo,['deviceid'=>$user->device_id,
                            'username'=>$userinfo->name.' '.$userinfo->lastname]);
                        }

                        return view('devicemodule.newdevice',[
                            'error' => 'There was a problem saving your device',
                            'devices'=> Device::all(),
                            
                            'users'=>User::all(),
                            'linkeduser'=>$linkeduserinfo]);
                    }
        
                }else{
                    $linkeduserinfo = [];
                    $linkeduser = Linkedevice::all();
            
                    foreach($linkeduser as $user){
                        $userinfo = User::where('id',$user->user_id)->first();
                        array_push($linkeduserinfo,['deviceid'=>$user->device_id,
                        'username'=>$userinfo->name.' '.$userinfo->lastname]);
                    }

                    return view('devicemodule.newdevice',[
                        'error' => 'There is a device of the same serial number. Please make sure that you are not adding the same device twice.',
                        'devices'=> Device::all(),
                        
                        'users'=>User::all(),
                        'linkeduser'=>$linkeduserinfo]);
                }
            }

    public function getCoordinates(){
        $devices = new Device();
        return $devices->all();

    }

    public function devicecoordinates(Request $request){

        $data = json_decode($request->getContent(), true);
        $route = new Deviceroute();
        $route->serialnumber = $data['snumber'];
        $route->lon  = $data['lon'];
        $route->lat  = $data['lat'];

        if($route->save()){

        }
    }

    public function getdevicecoordinates($id){

        $device = Device::where('d_serial_number',$id)->get(['id'])->first();
        $userid = Linkedevice::where('device_id',$device->id)->get(['user_id'])->first();
        $userinfor = User::where('id',$userid->user_id)->get(['name','lastname'])->first();

        $coodinates = Deviceroute::where('serialnumber',$id)->get();
        $processedcoodinates = [];

        foreach ($coodinates as $coordinate){
            array_push($processedcoodinates,[$coordinate->lat,$coordinate->lon]);
        }

        return view('devicemodule.deviceroute',['coordinates'=>$processedcoodinates,
            'username'=>$userinfor->name.' '.$userinfor->lastname]);
    }
}
