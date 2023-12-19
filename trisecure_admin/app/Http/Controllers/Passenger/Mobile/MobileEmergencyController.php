<?php

namespace App\Http\Controllers\Passenger\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Emergency;

class MobileEmergencyController extends Controller
{
    public function index(){
        $emergencies = Emergency::where('user_id', auth()->user()->id)->get();

        return response()->json(['emergencies' => $emergencies]);
    }

    public function add(Request $request){
        $request->validate([
            'name' => 'required|string',
            'contact_number' => 'required|string',
        ]);

        $emergency = new Emergency();
        $emergency->user_id = auth()->user()->id;
        $emergency->name = $request->name;
        $emergency->contact_number = $request->contact_number;
        $emergency->save();

        return response()->json(['message' => 'Added successfully '. $emergency->id]);   
    }

    public function call($id){
        return response()->json(['message' => 'Call successfully '. $id]);   
    }

    public function delete($id){
        $emergency = Emergency::where('user_id', auth()->user()->id)->findOrFail($id);
        $emergency->delete();

        return response()->json(['message' => 'Successfully deleted '. $id]);
    }

}
