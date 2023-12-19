<?php

namespace App\Http\Controllers\Driver\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DriverInformation;

class MobileDriverQrCodeController extends Controller
{
    public function index($id){
        $information = DriverInformation::where('driver_id', $id)->first();

    }
}
