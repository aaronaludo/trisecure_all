<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RideHistory;
use App\Models\User;

class DriverRideHistoryController extends Controller
{
    public function index(){
        $user = User::find(auth()->guard('driver')->user()->id);
        $histories = RideHistory::where('driver_id', $user->id)->get();

        return view('driver.ride-histories', compact('histories'));
    }

    public function search(Request $request){
        $user = User::find(auth()->guard('driver')->user()->id);
        $search = $request->search;
        $histories = RideHistory::where('driver_id', $user->id)
        ->whereHas('passenger', function ($query) use ($search) {
            $query->where('first_name', 'like', '%' . $search . '%');
        })
        ->get();

        return view('driver.ride-histories', compact('histories'));
    }

    public function view($id){
        $user = User::find(auth()->guard('driver')->user()->id);
        $history = RideHistory::where('driver_id', $user->id)->find($id);

        return view('driver.ride-histories-view', compact('history'));
    }
}
