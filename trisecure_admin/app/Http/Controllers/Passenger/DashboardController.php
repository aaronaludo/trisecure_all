<?php

namespace App\Http\Controllers\Passenger;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RideHistory;
use App\Models\User;

class DashboardController extends Controller
{
    public function index(){
        $user = User::find(auth()->guard('passenger')->user()->id);
        $histories = RideHistory::where('passenger_id', $user->id)->count();
        $latestHistories = RideHistory::where('passenger_id', $user->id)->latest()->take(5)->get();

        return view('passenger.dashboard', compact('histories', 'latestHistories'));
    }
}
