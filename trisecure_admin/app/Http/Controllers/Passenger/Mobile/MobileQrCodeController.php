<?php

namespace App\Http\Controllers\Passenger\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RideHistory;
use App\Models\DriverInformation;

class MobileQrCodeController extends Controller
{
    public function index($qr_code){
        $information = DriverInformation::where('qr_code', $qr_code)->first();

        if ($information == null) {
            return response()->json(['message' => 'Not Foundee']);
        }

        $history = new RideHistory();
        $history->passenger_id = auth()->user()->id;
        $history->driver_id = $information->driver_id;
        $history->status_id = 1;
        $history->save();
        
        return response()->json(['user' => $information->user]);
    }
}
