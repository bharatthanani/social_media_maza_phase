<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Front\Message;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MessageController extends Controller
{
    public function messages()
    {
        $user_id =  Auth()->user()->id;
        $friends = User::where('id', '!=', $user_id)
        ->whereHas('friends2', function ($query) use ($user_id) {
            return $query->where(['user_id' => $user_id, 'status' => 2]);
        })
        ->orWhereHas('friends1', function ($query) use ($user_id) {
            return $query->where(['friend_id' => $user_id, 'status' => 2]);
        })
        ->get();
        
        return view('front.messages',compact('friends'));
    }

    public function messenger()
    {
        $user_id = session('user_id');
        $friends = User::select("*")
            ->where('id', '!=', $user_id)
            ->whereHas('friends2', function ($query) use ($user_id) {
                return $query->where(['user_id' => $user_id, 'status' => 2]);
            })
            ->orWhereHas('friends1', function ($query) use ($user_id) {
                return $query->where(['friend_id' => $user_id, 'status' => 2]);
            })
            ->get()->toArray();
        return view("user.messenger", compact('friends'));
    }
    public function ViewMessages(Request $request)
    {
        $sender_id = Auth()->user()->id;
        $receiver_id = $request->input('receiver_id');
        $receiver = User::where('id', $receiver_id)->get()->first();
        $view_chats =
            DB::table('messages')
            ->join('users', function ($join) use ($sender_id, $receiver_id) {
                $join->on('users.id', '=', 'messages.sender_id')
                    ->orwhere('users.id', '=', 'messages.receiver_id');
            })
            ->where(function ($query) use ($sender_id, $receiver_id) {
                $query->where(['messages.sender_id' => $sender_id, 'messages.receiver_id' => $receiver_id]);
            })
            ->orWhere(function ($query) use ($sender_id, $receiver_id) {
                $query->where(['messages.receiver_id' => $sender_id, 'messages.sender_id' => $receiver_id]);
            })
            ->select("messages.*", 'users.first_name', 'users.last_name', 'users.profile_img')
            // ->orderBy('messages.created_at','DESC')
            ->get()->sortBy('created_at')->values();

            // dd($view_chats);

        $notification = array(
            'message'       => 'Messages',
            'alert-type'    => 'success',
            'view_chats'    => $view_chats,
            'count_msg'     => count($view_chats),
            'sender_id'     => $sender_id,
            'receiver'      => $receiver,
        );
        return response()->json($notification);
    }
    public function SendMessage(Request $request)
    {
        $sender_id = Auth()->user()->id;
        $receiver_id = $request->input('receiver_id');
        $message = $request->input('message');
        if ($sender_id && $receiver_id && $message) {
            $message_id = Message::create([
                'sender_id'   => $sender_id,
                'receiver_id' => $receiver_id,
                'message'     => $message,
                'time_at'  => Carbon::now(),
            ])->id;
            $msg = DB::table('messages')
                ->join('users', 'users.id', '=', 'messages.sender_id')
                ->where(['messages.id' => $message_id])
                ->select("messages.*", 'users.first_name', 'users.last_name', 'users.profile_img')
                ->get()->first();
            //$msg = Message::with('user')->where('id',$message_id)->get()->toArray();
        }
        return response()->json($msg);
    }
}
