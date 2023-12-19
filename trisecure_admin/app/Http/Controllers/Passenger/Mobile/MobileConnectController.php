<?php

namespace App\Http\Controllers\Passenger\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Connect;
use App\Models\User;

class MobileConnectController extends Controller
{
    public function index(){
        $connects = Connect::where('sender_id', auth()->user()->id)->where('status_id', 4)
        ->orWhere('receiver_id', auth()->user()->id)
        ->get();

        $response = [];

        foreach ($connects as $connect) {
            $response[] = [
                "id" => $connect->id,
                "status" => $connect->status,
                "receiver" => $connect->receiver,
                "sender" => $connect->sender,
                "created_at" => $connect->created_at,
                "updated_at" => $connect->updated_at,
            ];
        }
        return response()->json(['connects' => $response]);
    }

    public function add(Request $request){
        $request->validate([
            'email' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->where('role_id', 3)->first();
        $connects = Connect::whereIn('sender_id', [auth()->user()->id, $user->id])->orWhereIn('receiver_id', [auth()->user()->id, $user->id])->first();

        if($user === null || $user->id === auth()->user()->id || $connects){
            return response()->json(['message' => 'User unknown'], 401);
        }

        $connect = new Connect();
        $connect->sender_id = auth()->user()->id;
        $connect->receiver_id = $user->id;
        $connect->status_id = 4;
        $connect->save();

        return response()->json(['message' => 'Add connect successfully '.$connect->id]);
    }

    public function delete($id){
        $connect = Connect::findOrFail($id);
        $connect->delete();

        return response()->json(['message' => 'Successfully deleted '. $connect->id]);
    }
}
