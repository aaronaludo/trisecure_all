<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DriverSettingController extends Controller
{
    public function index(){
        return view('driver.settings');
    }
}
