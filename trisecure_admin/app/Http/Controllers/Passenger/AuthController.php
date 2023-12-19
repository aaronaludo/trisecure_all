<?php

namespace App\Http\Controllers\Passenger;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    public function index(){
        if (Auth::guard('passenger')->check()) {
            return redirect('/passenger/dashboard');
        }

        return view('passenger.login');
    }

    public function login(Request $request){
        $credentials = $request->only('email', 'password');
    
        if (Auth::guard('passenger')->attempt($credentials)) {
            $user = Auth::guard('passenger')->user();
            
            if ($user->role_id === 3) {
                return redirect()->intended('/passenger/dashboard');
            }
    
            Auth::guard('passenger')->logout();
            return redirect()->route('passenger.login')->with('error', 'Invalid credentials');
        }
        return redirect()->route('passenger.login')->with('error', 'Invalid credentials');
    }

    public function logout(){
        Auth::guard('passenger')->logout();
        return redirect('/passenger/login');
    }

    public function register(){
        return view('passenger.register');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'phone_number' => 'required',
            'email' => 'required|email|unique:users',
            'password' => ['required', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('passenger.register')
                ->withErrors($validator)
                ->withInput();
        }

        $users = new User;
        $users->role_id = 3;
        $users->status_id = 2;
        $users->first_name = $request->first_name;
        $users->last_name = $request->last_name;
        $users->address = $request->address;
        $users->phone_number = $request->phone_number;
        $users->email = $request->email;
        $users->password = $request->password;
        $users->save();

        return redirect()->route('passenger.login')->with('success', 'Passenger created successfully');
    }
}
