<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\ContactUs;
use App\Models\AdminContact;

class ContactController extends Controller
{
    public function createContactUs(Request $request)
    {
        $data = ContactUs::create(['first_name'=>$request->first_name,'last_name'=>$request->last_name,'email'=>$request->email,'phone_number'=>$request->phone_number,'address'=>$request->address]);
        return response()->json(['Thanks for your contact'],200);
    }
    public function adminContact(Request $request)
    {
        $AdminContact = AdminContact::where('id',1)->get()->first();
        return response()->json($AdminContact,200);
    }
}