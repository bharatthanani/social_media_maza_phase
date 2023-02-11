<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    public function registration(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name'    => 'required',
            'email'         => 'required|email|unique:users',
            'password'      => 'required',
        ]);
        if (!$validator->fails()) {
            $result = User::create([
                'first_name'    => $request->first_name??NULL,
                'last_name'     => $request->last_name??NULL,
                'phone_number'  => $request->phone_number??NULL,
                'email'         => $request->email,
                'password'      => Hash::make($request->password),
                ]);
            if ($result){
                return response()->json(['SignUp Successfully'],200);
            }else{
                return response()->json(['Something Went Wrong'],404);
            }
        } else {
            return response()->json($validator->errors()->all(),404);
        }
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'         => 'required|email',
            'password'      => 'required',
        ]);
        if (!$validator->fails()) {
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                $user = User::where('email',$request->email)->get()->first();
                return response()->json($user,200);
            }else{
                return response()->json(['Invalid credentials.'],404);
            }
        } else {
            return response()->json($validator->errors()->all(),404);
        }
        
    }
    public function forgotPassword(Request $request)
    {
        if($request->has("email")){
            $user = User::where('email',$request->email)->get()->first();
            if($user){
                $first_name = $user->first_name??'';
                $last_name = $user->last_name??'';
                $email = $user->email;
                $fourRandomDigit = time().rand(1000,9999);
                User::where('email',$request->email)->update(['reset_password_token'=>$fourRandomDigit]);
                $data = array('otp'=>$fourRandomDigit);
               $send = Mail::send("mail", $data, function($message) use($email,$first_name,$last_name) {
                    $message->to($email, $first_name." ".$last_name)->subject('You have requested to reset your password');
                    $message->from('zuniteam1@gmail.com','ZuniTeam');
                });
                return response()->json(["A password reset link has been sent to your email"],200);
            }else{
                return response()->json(['Invalid Email.'],404);
            }
        }else
        {
            return response()->json(['Please provide email'],404);
        }
    }
    public function updatePassword(Request $request)
    {
        if($request->has("reset_password_token")){
            if($request->has("password")){
                $user = User::where('reset_password_token',$request->reset_password_token)->get()->first();
                if($user)
                {
                    User::where('reset_password_token',$request->reset_password_token)->update(['reset_password_token'=>time().rand(1000,9999),'password'=>Hash::make($request->password)]);
                    return response()->json(['Password reset Successfully'],200);
                }else
                {
                    return response()->json(['Invalid token please try again'],404);
                }
            }else{
                return response()->json(['Please provide password'],404);
            }
        }else
        {
            return response()->json(['Please provide reset_password_token'],404);
        }
    }
}