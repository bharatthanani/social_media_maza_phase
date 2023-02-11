<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function loginForm()
    {
        return view('admin.login');
    }
    public function loginProcess(Request $request)
    {

        Validator::make($request->all(), [
            'email'     => ['required'],
            'password'  => ['required'],
        ])->validate();
        $credentials = $request->only('email', 'password');
        //dd($credentials);
        //$admin = User::where('email')->count();
        if (Auth::attempt($credentials) ) {
            //dd($credentials);
            if(Auth()->user()->role == 'admin'){
                 return redirect('admin/dashboard')->with(['alert' => 'success', 'message' => 'Login successfully']);
            }else{
                Session::flush();
                Auth::logout();
        
                return redirect('admin/login');
            }
        }
        return redirect("admin/login")->with(['alert' => 'error', 'message' => 'Invalid Credentials']);
    }
    public function dashboard()
    {
        if (Auth::check()) {
            //dd(Auth::user()->full_name);
            return view('admin.index');
        }

        return redirect("admin/login")->with(['alert' => 'error', 'message' => 'Invalid Credentials']);
    }
    public function logout()
    {
        Session::flush();
        Auth::logout();

        return Redirect('admin/login')->with(['alert' => 'success', 'message' => 'Logout Successfully']);
    }
}