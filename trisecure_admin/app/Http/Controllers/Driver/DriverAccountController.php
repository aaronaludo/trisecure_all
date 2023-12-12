<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DriverAccountController extends Controller
{
    public function changePassword(){
        return view('driver.change-password');
    }

    public function editProfile(){
        return view('driver.edit-profile');
    }
}
