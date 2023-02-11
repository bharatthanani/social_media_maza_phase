<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    public function users()
    {
        $records = User::where('role','!=','admin')->get();
        return view('admin.viewUsers',compact('records'));
    }
}