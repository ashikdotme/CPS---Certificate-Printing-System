<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    // Check Status Page View
    function PageCheckStatus(){
        return view('Pages.Status');
    }
}
