<?php

namespace App\Http\Controllers\Passenger;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Connect;

class ConnectionController extends Controller
{
    public function index(){
        $connects = Connect::where('sender_id', auth()->user()->id)->where('status_id', 4)
        ->orWhere('receiver_id', auth()->user()->id)
        ->get();

        return view('passenger.connects', compact('connects'));
    }
}
