<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Subscriber;
use App\Models\Variant;

class UserDashboardController extends Controller
{
    public function userProfile(Request $request)
    {
        if($request->has("user_id")){
            $user = User::where('id',$request->user_id)->get()->first();
            return response()->json($user,200);
        }else{
            return response()->json(['Please provide user_id'],404);
        }
    }
    public function userOrders(Request $request)
    {
        if($request->has("user_id")){
            $user = Order::where('user_id',$request->user_id)->get()->toArray();
            return response()->json($user,200);
        }else{
            return response()->json(['Please provide user_id'],404);
        }
    }
    public function orderDetails(Request $request)
    {
        if($request->has("order_id")){
            $orders = OrderItem::with('productDetails')->where('order_id',$request->order_id)->get()->toArray();
            return response()->json($orders,200);
        }else{
            return response()->json(['Please provide order_id'],404);
        }
    }
    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id'       => 'required',
            'old_password'  => 'required',
            'new_password'  => 'required'
        ]);
        if (!$validator->fails()) {
            $user = User::where('id',$request->user_id)->get()->first();
            if (Hash::check($request->input('old_password'), $user['password'])) {
                User::where('id',$request->user_id)->update(['password'=>Hash::make($request->new_password)]);
                return response()->json(['Password Changed Successfully'],200);
            }else{
                return response()->json(['old password is invalid'],404);
            }
        } else {
            return response()->json($validator->errors()->all(),404);
        }
    }
    public function createSubscriber(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id'       => 'required',
            'artist_id'     => 'required',
        ]);
        if (!$validator->fails()) {
            $artistExists = Variant::where(['id'=>$request->artist_id,'attribute_id'=>4])->get()->first();
                if($artistExists){
                     $subscriberExists = Subscriber::where(['user_id'=>$request->user_id,'artist_id'=>$request->artist_id])->get()->first();
                     if(!$subscriberExists){
                         Subscriber::create([
                            'user_id'   => $request->user_id,
                            'artist_id' => $request->artist_id,
                        ]);
                        return response()->json(['Subscribe Successfully'],200);
                     }else{
                        return response()->json(['Already Subscribed'],404);
                     }
                }else{
                    return response()->json(['Provide invalid artist_id'],404);
                }
        } else {
            return response()->json($validator->errors()->all(),404);
        }
    }
    public function getSubscribers(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id'       => 'required',
        ]);
        if (!$validator->fails()) {
            $getSubscribers = Subscriber::select('artist_id')->where('user_id',$request->user_id)->get();
            if(count($getSubscribers)>0){
                $getSubscribers = $getSubscribers->toArray();
                $artist_ids = array_column($getSubscribers, 'artist_id');
                $getSubscribers = Variant::whereIn('id', $artist_ids)->get();
            }
            if(count($getSubscribers)>0){
                return response()->json($getSubscribers,200);
            }else{
                return response()->json(['Record Not Found'],404);
            }
        } else {
            return response()->json($validator->errors()->all(),404);
        }
    }
    public function unfollowSubscriber(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id'       => 'required',
            'artist_id'     => 'required',
        ]);
        if (!$validator->fails()) {
            Subscriber::where(['user_id'=>$request->user_id,'artist_id'=>$request->artist_id])->delete();
            return response()->json(['Unfollow Successfully'],200);
        } else {
            return response()->json($validator->errors()->all(),404);
        }
    }
}