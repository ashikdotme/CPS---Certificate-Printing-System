<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RegisterModel;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    // Pending Request Page View
    function PendingRequestPage(){
        return view('Dashboard.PendingRequest');
    }
    // Pending Request List
    function PendingRequestList(){
        $list = RegisterModel::where('status',0)->get();
        return $list;
    }

    // Request Details
    function RequestDetails(Request $request){
        $id = $request->id;
        $count = RegisterModel::where('id',$id)->count();
        if($count == 1){
            $details = RegisterModel::where('id',$id)->get();
            return view('Dashboard.RequestDetails',[
                'details' => $details
            ]);
        }
        else{
           return redirect('pending-certificate-request');
        }
    }
}
