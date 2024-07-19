<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ForgotPWController extends Controller
{
    public function index() 
    {
    return view('forgotpw');
    }
}
