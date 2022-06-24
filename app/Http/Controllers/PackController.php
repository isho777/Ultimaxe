<?php

namespace App\Http\Controllers;
use App\Pack;
use Illuminate\Http\Request;

class PackController extends Controller
{
    //

    public function newpack(){
        return view('packmodule.newpack',[
            'packs'=> Pack::all(),
            'newpack'=>''
            ]);
    }

    public function listpack(){
        return view('packmodule.newpack',[
            'packs'=> Pack::all(),
            ]);
    }

    public function savepack(Request $request){
        if(Pack::where(['packsize'=>$request->packsize,'weightunit'=>$request->weightunit])->count() == 0){
            $pack = new Pack();
            $pack->packsize = $request->packsize;
            $pack->weightunit = $request->weightunit;

            if($pack->save()){
                return view('packmodule.newpack',[
                    'packs'=> Pack::all(),
                    'newpack'=>'',
                    'sucess' => 'Product pack is successfully created.'
                    ]);
            }else{
                return view('packmodule.newpack',[
                    'packs'=> Pack::all(),
                    'newpack'=>'',
                    'error' => 'There was a problem saving the product pack.'
                    ]);
            }            

        }else{
            return view('packmodule.newpack',[
                'packs'=> Pack::all(),
                'newpack'=>'',
                'error' => 'Product pack already exists.'
                ]);
        }
    }

    public function updatepack(Request $request){
        if(Pack::where(['packsize'=>$request->packsize,'weightunit'=>$request->weightunit])->count() == 0){
            $pack = Pack::where('id',$request->id)->first();
            $pack->packsize = $request->packsize;
            $pack->weightunit = $request->weightunit;

            if($pack->save()){
                return view('packmodule.newpack',[
                    'packs'=> Pack::all(),
                    'sucess' => 'Product pack is successfully updated.'
                    ]);
            }else{
                return view('packmodule.newpack',[
                    'packs'=> Pack::all(),
                    'error' => 'There was an error while updating the product pack.'
                    ]);
            }

        }else{
            return view('packmodule.newpack',[
                'packs'=> Pack::all(),
                'error' => 'Product pack already exists.'
                ]);
        }

    }

    public function deletepack(Request $request){
        if(Pack::where('id',$request->id)->delete()){
            return view('packmodule.newpack',[
                'packs'=> Pack::all(),
                'sucess' => 'Product pack is successfully removed.'
                ]);
            
        }else{
            return view('packmodule.newpack',[
                'packs'=> Pack::all(),
                'error' => 'There was an error deleting product pack'
                ]);
        }

    }

    
}
