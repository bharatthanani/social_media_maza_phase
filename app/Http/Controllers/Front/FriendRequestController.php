<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Front\Friend;
use Illuminate\Http\Request;
use App\Models\User;

class FriendRequestController extends Controller
{
    public function allSuggestions(Request $request)
    {
        $user_id =  Auth()->user()->id;
        $receiver =  Friend::where('friend_id',$user_id)->orWhere('user_id',$user_id)->get();
        $sender   =  Friend::where('user_id',$user_id)->get();
        $receive_id = [];
        $sender_id =  [];
        foreach($receiver as $item){
            array_push($receive_id,$item->friend_id);
            array_push($sender_id,$item->user_id);
        }
        $rec_id = [];
        foreach($sender as $item){
            array_push($rec_id,$item->friend_id);
            
        }
        if (count($receiver) > 0) {
            $allSuggestions =  User::doesnthave('friends')->where('id','!=',$user_id)->whereNotIn('id',$rec_id)->paginate(10);
        }else{
            $allSuggestions =  User::with('friends')->where('id','!=',$user_id)->whereNotIn('id',$sender_id)->paginate(10);
            
        }
        return view('front.allsuggestions',compact('allSuggestions'));
    }
    public function allConfirmRequests(Request $request)
    {
        $user_id =  Auth()->user()->id;
        $confirmRequests  =  User::with(['friends1'])
        ->whereHas('friends1', function ($query) use ($user_id) {
            return $query->where(['friend_id' => $user_id, 'status' => 1]);
        })->paginate(10);
        return view('front.allconfirmRequests',compact('confirmRequests'));
    }
    public function yourfriends(Request $request)
    {
        $user_id =  Auth()->user()->id;
        $yourfriends  =  User::select("*")
        ->where('id', '!=', $user_id)
        ->whereHas('friends2', function ($query) use ($user_id) {
            return $query->where(['user_id' => $user_id, 'status' => 2]);
        })
        ->orWhereHas('friends1', function ($query) use ($user_id) {
            return $query->where(['friend_id' => $user_id, 'status' => 2]);
        })
        ->paginate(10);
        //dd($confirmRequests);
        return view('front.allyourfriends',compact('yourfriends'));
    }
    public function yourrequests(Request $request)
    {
        $user_id =  Auth()->user()->id;
        $m_friends  =  Friend::where(['user_id'=>$user_id,'status'=>1])->pluck('friend_id')->toArray();
        $yourrequests = User::whereIn('id', $m_friends)->paginate(10);
        return view('front.allyourrequests',compact('yourrequests'));
    }
    public function addFriend(Request $request)
    {
        $user_id =  Auth()->user()->id;
        if($request->status==0){
            Friend::create(['user_id'=>$user_id,'friend_id'=>$request->friend_id,'status'=>1]);
            $msg = "Your request has been sent successfully.";
        }else{
            Friend::where(['user_id'=>$user_id,'friend_id'=>$request->friend_id,'status'=>$request->status])->delete();
            $msg = "Your request has been cancelled.";
        }
        return response()->json($msg);
    }
    public function unFriend(Request $request)
    {
        $user_id =  Auth()->user()->id;
        $friend_id = $request->friend_id;
        Friend::whereHas('mfriends1', function ($query) use ($user_id,$friend_id) {
            return $query->where(['user_id' => $user_id,'friend_id' => $friend_id, 'status' => 2]);
        })
        ->orWhereHas('mfriends2', function ($query) use ($user_id,$friend_id) {
            return $query->where(['friend_id' => $user_id,'user_id' => $friend_id, 'status' => 2]);
        })->delete();
        $msg = "UnFriend successfully.";
        return response()->json($msg);
    }
    public function confirmRequestDelete(Request $request)
    {
        $user_id =  Auth()->user()->id;
        if($request->status==1){
            Friend::where(['user_id'=>$request->friend_id,'friend_id'=>$user_id,'status'=>1])->delete();
            $msg = "Request has been deleted successfully.";
        }
        return response()->json($msg);
    }
    public function acceptFriendrequest(Request $request)
    {
        $user_id =  Auth()->user()->id;
        if($request->status==1){
            Friend::where(['user_id'=>$request->friend_id,'friend_id'=>$user_id,'status'=>1])->update(['status'=>2]);
            $msg = "Request has been confirmed successfully.";
        }
        return response()->json($msg);
    }
}
