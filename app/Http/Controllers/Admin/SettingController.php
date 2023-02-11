<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\PrivacyPolicy;
use App\Models\Admin\HelpSupport;
class SettingController extends Controller
{
    public function privacyPolicy()
    {
        $record = PrivacyPolicy::first()->toArray();
        //dd($record);
        return view('admin.privacyPolicy',compact('record'));
    }
    public function updatePrivacyPolicy(Request $request)
    {
        //dd($request->all());
        PrivacyPolicy::where('id',1)->update($request->except(['_token']));
        return redirect()->back()->with(['alert'=>'success','message'=>"Record updated successfully"]);
    }
    public function helpSupport()
    {
        $records = HelpSupport::get();
        return view('admin.helpSupport',compact('records'));
    }
    public function addHelpSupport()
    {
        $records = HelpSupport::get();
        return view('admin.addHelpSupport',compact('records'));
    }
    public function addhelpSupportProcess(Request $request)
    {
        HelpSupport::create($request->except(['_token']));
        return redirect('admin/helpSupport')->with(['alert'=>'success','message'=>"Record Added successfully"]);
    }
    public function editHelpSupport($id)
    {
        $record = HelpSupport::where('id',$id)->first();
        //dd($record);
        return view('admin.editHelpSupport',compact('record'));
    }
    public function updatehelpSupportProcess($id,Request $request)
    {
        HelpSupport::where('id',$id)->update($request->except(['_token']));
        return redirect('admin/helpSupport')->with(['alert'=>'success','message'=>"Record Updated successfully"]);
    }
    public function deleteHelpSupport($id)
    {
        HelpSupport::where('id',$id)->delete();
        return redirect('admin/helpSupport')->with(['alert'=>'success','message'=>"Record Deleted successfully"]);
    }
}