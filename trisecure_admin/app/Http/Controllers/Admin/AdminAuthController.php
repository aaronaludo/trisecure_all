<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function index(){
        if (Auth::guard('admin')->check()) {
            return redirect('/admin/dashboard');
        }

        return view('admin.login');
    }

    public function login(Request $request){
        $credentials = $request->only('email', 'password');
    
        if (Auth::guard('admin')->attempt($credentials)) {
            $user = Auth::guard('admin')->user();
            
            if ($user->role_id === 1 || $user->role_id === 4) {
                return redirect()->intended('/admin/dashboard');
            }
    
            Auth::guard('admin')->logout();
            return redirect()->route('admin.login')->with('error', 'Invalid credentials');
        }
        return redirect()->route('admin.login')->with('error', 'Invalid credentials');
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }
}
