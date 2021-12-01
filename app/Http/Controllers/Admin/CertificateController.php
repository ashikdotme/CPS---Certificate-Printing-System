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

    // Reject Request Page View
    function RejectListPage(){
        return view('Dashboard.RejectList');
    }
    // Approved Request Page View
    function ApprovedListPage(){
        return view('Dashboard.ApprovedList');
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
    // Approve Request
    function AdminApprove(Request $request){
        $st_id = $request->input('st_id');
        $st_cgpa = $request->input('st_cgpa');
        if($st_cgpa>4 || $st_cgpa<1){
            return "CGPA value is Wrong!";
        }
        else{
            $update = RegisterModel::where('id',$st_id)->where('status',0)->update([
                'cgpa' => $st_cgpa,
                'status' => 1, 
                'updated_at' => now()
            ]);
            if($update == true){
                return 1;
            }else{
                return 0;
            }
        }
    }


    // Reject Request
    function AdminReject(Request $request){
        $st_id = $request->input('st_id2'); 
    
        $update = RegisterModel::where('id',$st_id)->where('status',0)->update([ 
            'status' => 2, 
            'updated_at' => now()
        ]);
        if($update == true){
            return 1;
        }else{
            return 0;
        } 
    }
}
