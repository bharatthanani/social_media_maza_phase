<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\HelpSupport;
use App\Models\Admin\PrivacyPolicy;

class SettingsController extends Controller
{
    
    public function settings()
    {
        return view('front.settings');
    }
    public function privacypolicy()
    {
        $record = PrivacyPolicy::get()->first();
        return view('front.privacypolicy',compact('record'));
    }
    public function helpsupport()
    {
        $records = HelpSupport::get();
        return view('front.helpsupport',compact('records'));
    }
}
