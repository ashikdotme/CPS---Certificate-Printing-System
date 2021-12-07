<?php

namespace App\Http\Controllers\Admin;

use PDF;
use Illuminate\Http\Request;
use App\Models\RegisterModel;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

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
    // Reject  Request List
    function RejectRequestList(){
        $list = RegisterModel::where('status',2)->get();
        return $list;
    }
    // Approved  Request List
    function ApproveRequestList(){
        $list = RegisterModel::where('status',1)->get();
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



    function createPDF(Request $request) { 
        $id = $request->id;
        $details = RegisterModel::where('id',$id)->get();
        $name = RegisterModel::where('id',$id)->pluck('name')->first();

        view()->share('details',$details);
        $pdf = PDF::loadView('Pages.Certificate', $details);
        return $pdf->download('certificate-of-'.$name.'.pdf'); 


        // $pdf = App::make('dompdf.wrapper');
        // $pdf->loadHTML('<h1>Test</h1>');
        // return $pdf->stream();

    }

    function createPDFview() { 
        return view('Pages.Certificate');
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
                $mobile = RegisterModel::where('id',$st_id)->pluck('mobile')->first();
                $name = RegisterModel::where('id',$st_id)->pluck('name')->first();
                $message = "Hello $name, Congratulations your request is approved, please download your certificate.";

                $response = Http::get("http://api.greenweb.com.bd/api.php?token=85a94a9807036ee4b95d20956a818191&to=$mobile&message=$message");
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
