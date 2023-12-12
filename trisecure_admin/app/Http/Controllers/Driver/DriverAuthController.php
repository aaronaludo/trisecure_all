<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DriverAuthController extends Controller
{
    public function login(){
        return view('driver.login');
    }
}
