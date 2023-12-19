<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DriverAccountController extends Controller
{
    public function changePassword(){
        return view('driver.change-password');
    }

    public function editProfile(){
        return view('driver.edit-profile');
    }

    public function updateProfile(Request $request){
        $user = User::find(auth()->guard('driver')->user()->id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->address = $request->address;
        $user->phone_number = $request->phone_number;
        $user->email = $request->email;
        $user->save();

        return redirect('/driver/edit-profile')->with('success', 'Profile updated successfully');
    }

    public function updatePassword(Request $request){
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->route('driver.change-password')
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::find(auth()->guard('driver')->user()->id);

        if (!Hash::check($request->old_password, $user->password)) {
            return redirect()->route('driver.change-password')->with('error', 'Incorrect old password');
        }
        
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect('/driver/change-password')->with('success', 'Password changed successfully');
    }
}
