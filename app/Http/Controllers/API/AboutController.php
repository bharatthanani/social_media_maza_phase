<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\About;
//use App\Models\About_item;
use App\Models\AboutContent;

class AboutController extends Controller
{
    public function aboutContent(Request $request)
    {
        $records = About::with('images','childs.images')->get();
        return response()->json($records,200);
    }
    public function aboutZastContent(Request $request)
    {
        $record = AboutContent::where('id',1)->get()->first();
        return response()->json($record,200);
    }
}