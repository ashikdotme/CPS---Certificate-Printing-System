<?php

namespace App\Http\Controllers;

use App\Models\RegisterModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RegisterController extends Controller
{
    // Registration page view
    function RegistrationPageView(){
        return view('Pages.Register');
    }
    // New Student Registration
    function onRegistration(Request $request){
        $name = $request->input('name');
        $father_name = $request->input('father_name');
        $mother_name = $request->input('mother_name');
        $st_id = $request->input('st_id');
        $shift = $request->input('shift');
        $session = $request->input('session');
        $batch = $request->input('batch');
        $department = $request->input('department');
        $mobile = $request->input('mobile');
        $email = $request->input('email');

        // ID Count
        $idCount = RegisterModel::where('st_id',$st_id)->count();
        // Mobile Count
        $mobileCount = RegisterModel::where('mobile',$mobile)->count();
        // Email Count
        $emailCount = RegisterModel::where('email',$email)->count();
        $step1_count = RegisterModel::where('mobile',$mobile)->where('step_1',1)->count();
        $step2_count = RegisterModel::where('mobile',$mobile)->where('step_2',1)->count();

        $code = rand(9999,999999);
        $message = "হ্যালো,   $name , ওটিপি (OTP) কোড:".$code;

        if($mobileCount == 1 AND $step1_count == 1  AND $step2_count == 0){
         
            $update = RegisterModel::where('mobile',$mobile)->update([
                'otp' => $code,
                'updated_at' => now()
            ]);

            // $response = Http::post('https://api2.onnorokomsms.com/HttpSendSms.ashx?op=NumberSms&apiKey=66902e84-9a8d-4a7d-97ea-affc3c3ddae9&type=TEXT&mobile='.$mobile.'&smsText='.$message.'&maskName=&campaignName=');
            
            $response = Http::get("http://api.greenweb.com.bd/api.php?token=85a94a9807036ee4b95d20956a818191&to=$mobile&message=$message");
            $jsonData = $response->status(); 

            return 2; 
        }
        else if($mobileCount == 1){
            return "Already used the Mobile Number!";
        }
        else if($idCount == 1){
            return "ID Already Exists!";
        } 
        else if($emailCount == 1){
            return "Already used the Email!";
        } 
        else{ 
            $insert = RegisterModel::insert([
                'name' => $name,
                'st_id' => $st_id,
                'session' => $session,
                'batch' => $batch,
                'shift' => $shift,
                'fathers_name' => $father_name,
                'mothers_name' => $mother_name,
                'mobile' => $mobile,
                'department' => $department, 
                'email' => $email,
                'step_1' => 1,
                'otp' => $code,
                'created_at' => now()
            ]);
            if($insert == true){

                $response = Http::get("http://api.greenweb.com.bd/api.php?token=85a94a9807036ee4b95d20956a818191&to=$mobile&message=$message");
                $jsonData = $response->status(); 

                
                return 1;
            }else{
                return 0;
            }
        }
    }

    function confirmRegisterOtp(Request $request){
        $m_otp = $request->input('m_otp');
        $mobile = $request->input('mobile');

        $db_code = RegisterModel::where('mobile',$mobile)->pluck('otp')->first();
        $step2_count = RegisterModel::where('mobile',$mobile)->where('step_2',1)->count();

        if(empty($m_otp)){
            return "OTP is Required!";
        }
        else if($step2_count == 1){
            return "Already you are Register!";
        }
        else if($db_code != $m_otp){
            return "OTP is Wrong!";
        }
        else{
            $update = RegisterModel::where('mobile',$mobile)->update([
                'otp_verify' => 1,
                'step_2' => 1,
                'created_at' => now()
            ]);
            if($update == true){
               $message = "Hello, your certificate request submit successfully, please wait for approved.";
                
                $response = Http::get("http://api.greenweb.com.bd/api.php?token=85a94a9807036ee4b95d20956a818191&to=$mobile&message=$message");
                return 1;
            }else{
                return 0;
            }
        }

       
    }
}
