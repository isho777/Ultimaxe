<?php

namespace App\Http\Controllers;

use App\Dealsheetsignature;
use Illuminate\Http\Request;

class DealsheetsignatureController extends Controller
{
    //

    public function adddealinformation(Request $request){

        $data = json_decode($request->getContent(), true);
        $dealsignatures = new Dealsheetsignature();
        $dealsignatures->dealid = str_replace("CURDST10","",$data["dealid"]);
        $dealsignatures->customername = $data["customername"];
         $dealsignatures->customersignature = $data["customersignature"];
        $dealsignatures->dealnegwith = $data["dealnegwith"];
        $dealsignatures->dealaprovedby = $data["dealaprovedby"];
        $dealsignatures->dealnegby = $data["dealnegby"];
        $dealsignatures->email = $data["negotiator_mail"];
        $dealsignatures->negotiator_mail = $data["email"];
        $dealsignatures->dealnegsignatur = $data["dealnegsignatur"];
        $dealsignatures->dealaproversign = $data["dealaproversign"];

        if($dealsignatures->save()){
            return Response()->json(['msg'=>'Successfully Saved']);
        }

        //return 'olas';
    }
}
