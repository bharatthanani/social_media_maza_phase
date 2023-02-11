<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Front\Event;
use App\Models\Front\EventFollower;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function events()
    {
        $user_id = Auth()->user()->id;
        $myevents = Event::with('user','followers.user','totalfollowers.user')->where('user_id',$user_id)->orderBy('id', 'desc')->get();
        $myeventsCount = count($myevents);
        $myevents =  $myevents->take(6);
        $othersevents = Event::with('user','followers.user','is_follower','totalfollowers.user')->where('user_id','!=',$user_id)->orderBy('id', 'desc')->get();
        $otherseventsCount = count($othersevents);
        $othersevents =  $othersevents->take(6);
        //dd($othersevents->toArray());
        return view('front.events',compact('myeventsCount','myevents','othersevents','otherseventsCount'));
    }
    public function createEvent(Request $request)
    {
        $data = [
            'user_id'               => Auth()->user()->id,
            'event_title'           => $request->event_title,
            'event_location'        => $request->event_location,
            'event_date'            => $request->event_date,
        ];
        if ($request->hasFile('event_cover_img')) {
            $cover_image = $request->file('event_cover_img');
            $event_cover_img = Auth()->user()->first_name."_".rand(2, 50) . time() . "." . $cover_image->extension();
            $cover_image->move(public_path('event/cover'), $event_cover_img);
            $data['event_cover_img'] = $event_cover_img;
        }
        Event::create($data);
        return redirect("events")->with(['alert' => 'success', 'message' => 'Event created successfully.']);
    }
    public function changeEventStatus(Request $request)
    {
        $data = [
            'event_id'              => $request->event_id,
            'follower_id'           => Auth()->user()->id,
        ];
        if($request->btntype=='insert'){
            EventFollower::create($data);
            $msg = "Enrolled successfully";
        }
        if($request->btntype=='delete'){
            EventFollower::where($data)->delete();
            $msg = "Leave successfully";
        }
        return response()->json($msg);
    }
    public function deleteMyEvent(Request $request)
    {
        $user_id = Auth()->user()->id;
        Event::where(['id'=>$request->event_id,'user_id'=>$user_id])->delete();
        EventFollower::where(['event_id'=>$request->event_id])->delete();
        return response()->json('Your Event deleted successfully');
    }
    public function othersevents(Request $request)
    {
        $user_id = Auth()->user()->id;
        $othersevents = Event::with('user','followers.user','is_follower','totalfollowers.user')->where('user_id','!=',$user_id)->orderBy('id', 'desc')->paginate(15);
        return view('front.othersevents',compact('othersevents'));
    }
    public function myevents(Request $request)
    {
        $user_id = Auth()->user()->id;
        $myevents = Event::with('user','followers.user','is_follower','totalfollowers.user')->where('user_id','=',$user_id)->orderBy('id', 'desc')->paginate(15);
        return view('front.myevents',compact('myevents'));
    }
}
