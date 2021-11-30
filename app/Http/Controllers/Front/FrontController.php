<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\RegisterModel;
use Illuminate\Http\Request;

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
}
