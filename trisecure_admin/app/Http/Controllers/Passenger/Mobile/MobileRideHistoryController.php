<?php

namespace App\Http\Controllers\Passenger\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RideHistory;

class MobileRideHistoryController extends Controller
{
    public function index(){
        $histories = RideHistory::where('passenger_id', auth()->user()->id)->get();

        $response = [];

        foreach ($histories as $history) {
            $response[] = [
                'id' => $history->id,
                'passenger' => $history->passenger,
                'driver' => $history->driver,
                'status' => $history->status,
                'created_at' => $history->created_at,
                'updated_at' => $history->updated_at
            ];    
        }

        return response()->json(['histories' => $response]);
    }

    public function view($id){
        $history = RideHistory::where('passenger_id', auth()->user()->id)->where('id', $id)->first();

        $response = [
            'id' => $history->id,
            'passenger' => $history->passenger,
            'driver' => $history->driver,
            'status' => $history->status,
            'created_at' => $history->created_at,
            'updated_at' => $history->updated_at
        ];

        return response()->json(['history' => $response]);
    }

    public function status(Request $request){
        $history = RideHistory::where('passenger_id', auth()->user()->id)->where('id', $request->id)->first();
        $history->status_id = 4;
        $history->save();
        
        return response()->json(['message' => 'Status changed successfully '.$history->id.' '.$history->status_id]);
    }
}
