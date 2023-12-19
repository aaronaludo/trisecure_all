<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\DriverInformation;

class DriverAuthController extends Controller
{
    public function index(){
        if (Auth::guard('driver')->check()) {
            return redirect('/driver/dashboard');
        }

        return view('driver.login');
    }

    public function login(Request $request){
        $credentials = $request->only('email', 'password');
    
        if (Auth::guard('driver')->attempt($credentials)) {
            $user = Auth::guard('driver')->user();
            
            if ($user->role_id === 2 && $user->status_id === 2) {
                return redirect()->intended('/driver/dashboard');
            }
    
            Auth::guard('driver')->logout();
            return redirect()->route('driver.login')->with('error', 'Invalid credentials');
        }
        return redirect()->route('driver.login')->with('error', 'Invalid credentials');
    }

    public function logout(){
        Auth::guard('driver')->logout();
        return redirect('/driver/login');
    }

    public function register(){
        return view('driver.register');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'phone_number' => 'required',
            'email' => 'required|email|unique:users',
            'password' => ['required', 'confirmed'],
            'license' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->route('driver.register')
                ->withErrors($validator)
                ->withInput();
        }

        $users = new User;
        $users->role_id = 2;
        $users->status_id = 1;
        $users->first_name = $request->first_name;
        $users->last_name = $request->last_name;
        $users->address = $request->address;
        $users->phone_number = $request->phone_number;
        $users->email = $request->email;
        $users->password = $request->password;
        $users->save();

        $information = new DriverInformation();
        $information->driver_id = $users->id;
        $information->status_id = 1;
        $information->qr_code = $users->id."_".$users->email;

        if ($request->hasFile('license')) {
            $license = $request->file('license');
            $licenseName = time() . '.' . $license->getClientOriginalExtension();
            $path = $license->storeAs('uploads', $licenseName, 'public');
            $information->license = $path;
        }

        $information->save();
        
        return redirect()->route('driver.login')->with('success', 'Passenger created successfully');
    }
}
