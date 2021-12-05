<?php

namespace App\Http\Controllers\Front;
use PDF;
use App\Http\Controllers\Controller;
use App\Models\RegisterModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FrontController extends Controller
{
    // Check Status Page View
    function PageCheckStatus(){
        return view('Pages.Status');
    }

    // Download Page View
    function PageDownload(){
        return view('Pages.Download');
    }

    // Home  Page View
    function PageHome(){
        return view('Pages.Home');
    }



    // check status
    function checkStatusFromID(Request $request){
        $st_id = $request->input('st_id');
        
        $count = RegisterModel::where('st_id',$st_id)->count();
        if($count == 1){
            $status = RegisterModel::where('st_id',$st_id)->select('status','st_id','name')->get();
            return $status;
        }else{
            return 0;
        }
       
    }



    // Certificate page view
    function CertificatePageView(){
        return view('Pages.Certificate');
    }

    function CertificateDownloadFromFront(Request $request){
        $st_id = $request->input('st_id');
        $mobile_number = $request->input('mobile_number');
        $count  = RegisterModel::where('st_id',$st_id)->where('mobile',$mobile_number)->count();
         
        if($count == 1){
            $status  = RegisterModel::where('st_id',$st_id)->where('mobile',$mobile_number)->where('status',1)->count();
            if($status == 1){
                $code = rand(9999,999999);
                $message = "হ্যালো, আপনার ওটিপি (OTP) কোড:".$code; 
                $update = RegisterModel::where('st_id',$st_id)->where('mobile',$mobile_number)->update([
                    'otp' => $code,
                    'updated_at' => now()
                ]); 
                $response = Http::get("http://api.greenweb.com.bd/api.php?token=85a94a9807036ee4b95d20956a818191&to=$mobile_number&message=$message");

                return 2; 
            }else{
                return "Your Request Not Approved!";
            }
        }else{
            return "Student ID or Mobile Number is Wrong!";
        }
    }



    function confirmDownloadOtp(Request $request){
        $m_otp = $request->input('m_otp');
        $mobile = $request->input('mobile_number');
        $st_id = $request->input('st_id');

        $db_code = RegisterModel::where('mobile',$mobile)->pluck('otp')->first();
        // $step2_count = RegisterModel::where('mobile',$mobile)->where('step_2',1)->count();

        if(empty($m_otp)){
            return "OTP is Required!";
        }
        else if($db_code != $m_otp){
            return "OTP code is Wrong!";
        }
        else{
            // $count  = RegisterModel::where('st_id',$st_id)->where('mobile',$mobile)->count();
            $status  = RegisterModel::where('st_id',$st_id)->where('mobile',$mobile)->where('status',1)->count();
            if($status == 1){
                $id  = RegisterModel::where('st_id',$st_id)->where('mobile',$mobile)->pluck('id')->first();
                $data = ["id"=>$id,"status"=>1];
                return $data;
            }  
        }

       
    }



}
