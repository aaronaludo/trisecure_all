<?php

namespace App\Http\Controllers\Passenger;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RideHistory;
use App\Models\User;

class RideHistoryController extends Controller
{
    public function index(){
        $user = User::find(auth()->guard('passenger')->user()->id);
        $histories = RideHistory::where('passenger_id', $user->id)->get();

        return view('passenger.ride-histories', compact('histories'));
    }

    public function search(Request $request){
        $user = User::find(auth()->guard('passenger')->user()->id);
        $search = $request->search;
        $histories = RideHistory::where('passenger_id', $user->id)
        ->whereHas('driver', function ($query) use ($search) {
            $query->where('first_name', 'like', '%' . $search . '%');
        })
        ->get();

        return view('passenger.ride-histories', compact('histories'));
    }

    public function view($id){
        $user = User::find(auth()->guard('passenger')->user()->id);
        $history = RideHistory::where('passenger_id', $user->id)->find($id);

        return view('passenger.ride-histories-view', compact('history'));
    }
}
