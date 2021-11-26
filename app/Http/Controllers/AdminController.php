<?php

namespace App\Http\Controllers;

use App\Models\AdminLoginModel;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Login Page View
    function login_page_view(){
        return view('Pages.Login');
    }

    // Dashboard Page View
    function dashboard_page_view(){
        return view('Dashboard');
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
