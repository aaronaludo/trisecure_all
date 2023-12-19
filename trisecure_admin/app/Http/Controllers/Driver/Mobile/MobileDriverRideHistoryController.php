<?php

namespace App\Http\Controllers\Driver\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RideHistory;

class MobileDriverRideHistoryController extends Controller
{
    public function index(){
        $histories = RideHistory::where('driver_id', auth()->user()->id)->get();

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
        $history = RideHistory::where('driver_id', auth()->user()->id)->where('id', $id)->first();

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
}
