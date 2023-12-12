<?php

namespace App\Http\Controllers\Driver\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class MobileDriverAuthController extends Controller
{
    public function test(){
        return response()->json(['message' => 'test']);
    }

    public function index(){
        $user = User::find(auth()->user()->id);

        if ($user->role_id != 2) {
            return response()->json(['message' => 'Drivers account only'], 401);
        }

        return response()->json(['message' => 'index']);
    }

    public function register(Request $request){
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'address' => 'required|string',
            'phone_number' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => ['required', 'confirmed'],
        ]);

        $user = new User();
        $user->role_id = 2;
        $user->status_id = 1;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->address = $request->address;
        $user->phone_number = $request->phone_number;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json(['message' => 'Successfully registered']);
    }

    public function login(Request $request){
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->role_id === 2 && $user->status_id === 2) {
                $token = $user->createToken('driver_trisecure_token')->plainTextToken;

                $response = [
                    'token' => $token,
                    'user' => $user
                ];

                return response()->json(['response' => $response]);
            }else if($user->status_id === 1){
                return response()->json(['message' => 'Your account is pending']);
            }

            $request->user()->tokens()->delete();
            return response()->json(['message' => 'Drivers account only'], 401);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    public function logout(Request $request){
        $user = Auth::user();

        if ($user->role_id === 2) {
            $request->user()->tokens()->delete();
            return response()->json(['message' => 'Successfully logged out']);
        }

        return response()->json(['message' => 'Drivers account only'], 401);
    }
}
