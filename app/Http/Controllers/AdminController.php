<?php

namespace App\Http\Controllers;

use App\Models\AdminLoginModel;
use App\Models\NotificationModel;
use App\Models\RegisterModel;
use Illuminate\Http\Request;
use DB;

class AdminController extends Controller
{
    // Login Page View
    function login_page_view(){
        return view('Pages.Login');
    }

    // Dashboard Page View
    function dashboard_page_view(){
        $total_pending = RegisterModel::where('status',0)->count();
        $total_reject = RegisterModel::where('status',2)->count();
        $total_approve = RegisterModel::where('status',1)->count();
        return view('Dashboard',[
            'total_pending' => $total_pending,
            'total_reject' => $total_reject,
            'total_approve' => $total_approve
        ]);
    }

    function NotificationList(){ 
        $list = DB::table('notifications')
       ->join('students','notifications.mobile','=','students.mobile')
       ->select('notifications.*','students.name','students.id')
       ->where('notifications.unread',0)
       ->get();

       return $list;
    }
    function NotificationCount(){
        $notiCount  = NotificationModel::where('unread',0)->count();
        return $notiCount;
    }
    function ReadNotification(Request $request){
        $id = $request->input('nid');
        $update = NotificationModel::where('nid',$id)->update([
            'unread' => 1,
            'updated_at' => now()
        ]);
    }

    // Login Check
    function onLogin(Request $request){
        $username = $request->input('username');
        $password = $request->input('password');

        $loginCount = AdminLoginModel::where('username',$username)->where('password',SHA1($password))->count();
        if( $loginCount == 1){
            $request->session()->put('admin_loggedin',$username);
            return  1;
        }else{
            return   0;
        }
    }

    // Logout
    function logOut(Request $request){ 
        $request->session()->forget('admin_loggedin');
        return redirect('/login');
    }
}
