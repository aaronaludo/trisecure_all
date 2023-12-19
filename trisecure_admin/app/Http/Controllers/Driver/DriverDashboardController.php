<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RideHistory;
use App\Models\User;

class DriverDashboardController extends Controller
{
    public function index(){
        $user = User::find(auth()->guard('driver')->user()->id);
        $histories = RideHistory::where('driver_id', $user->id)->count();
        $latestHistories = RideHistory::where('driver_id', $user->id)->latest()->take(5)->get();

        return view('driver.dashboard', compact('histories', 'latestHistories'));
    }
}
