<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Front\State;
use App\Models\Front\About;
use App\Models\Front\Post;
use App\Models\Front\Education;
use App\Models\Front\Friend;
use App\Models\Front\HobbiesInterest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class SignupController extends Controller
{
    public function signupForm()
    {
        return view('front.signup');
    }
    public function account()
    {
        return view('front.account');
    }
    public function editprofile()
    {
        $states = State::get();
        $user_id =  Auth()->user()->id;
        $hobbiesInterest = HobbiesInterest::where('user_id',$user_id)->get()->first();
        $education = Education::where('user_id',$user_id)->get()->first();
        $about = About::where('user_id',$user_id)->get()->first();
        return view('front.editprofile',compact('states','hobbiesInterest','about','education'));
    }
    public function signupProcess(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'email'      =>'unique:users|email|required',
            'password'   => 'required|confirmed',
        ]);
        if ($validator->fails()) {
            //dd($validator);
            return redirect()->back()->with(['alert'=>'error','message'=>"Enter Confirm Password Same as Password"]);
        }
        $result =  User::create([
            'first_name'    => $request->input('first_name'),
            'last_name'     => $request->input('last_name')??NULL,
            'email'         => $request->input('email'),
            'password'      => Hash::make($request->input('password')),
        ]);
        if($result){
            return redirect()->back()->with(['alert'=>'success','message'=>"Record created successfully"]);
        }else{
            return redirect()->back()->with(['alert'=>'error','message'=>"Something went wrong"]);
        }
    }
    public function signinProcess(Request $request)
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
            if(Auth()->user()->role == 'user'){
                 return redirect('news-feed')->with(['alert' => 'success', 'message' => 'Signin successfully']);
            }else{
                Session::flush();
                Auth::logout();
        
                return redirect('/');
            }
        }
        return redirect("/")->with(['alert' => 'error', 'message' => 'Invalid Credentials']);
    }
    public function newsfeed()
    {
        if (Auth::check()) {
           $user_id =  Auth()->user()->id;
           // POSTS
        //    $posts = Post::with(['user:id,first_name,last_name,profile_img', 'medias'])
        //     ->where(['user_id' => $user_id])
        //     ->withCount("likes")->withCount("comments")
        //     ->orderBy('posts.id', 'desc')->paginate(10);
            // People you may know
            $receiver =  Friend::where('friend_id',$user_id)->Orwhere('user_id',$user_id)->get();
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
                $allSuggestions =  User::doesnthave('friends')->where('id','!=',$user_id)->whereNotIn('id',$rec_id)->get();
            }else{
                $allSuggestions =  User::with('friends')->where('id','!=',$user_id)->whereNotIn('id',$sender_id)->get();
                
            }
            $s_t = count($allSuggestions);
            $allSuggestions = $allSuggestions->take(3);
           // Friend Requests
            $confirmRequests =  User::with(['friends1'])
            ->whereHas('friends1', function ($query) use ($user_id) {
                return $query->where(['friend_id' => $user_id, 'status' => 1]);
            })
            ->get();
            $c_t = count($confirmRequests);
            $confirmRequests =  $confirmRequests->take(3);
            // Your Friends
            $yourfriends = User::select("*")
            ->where('id', '!=', $user_id)
            ->whereHas('friends2', function ($query) use ($user_id) {
                return $query->where(['user_id' => $user_id, 'status' => 2]);
            })
            ->orWhereHas('friends1', function ($query) use ($user_id) {
                return $query->where(['friend_id' => $user_id, 'status' => 2]);
            })
            ->get();
            $y_f_t = count($yourfriends);
            $yourfriends =  $yourfriends->take(3);
           // dd($yourfriends->toArray());
            // Your Sending Requests
            $m_friends =Friend::where(['user_id'=>$user_id,'status'=>1])->pluck('friend_id')->toArray();
            $yourrequests = User::whereIn('id', $m_friends)->get();
            $y_r_t = count($yourrequests);
            $yourrequests =  $yourrequests->take(3);

            $friends = User::where('id', '!=', $user_id)
            ->whereHas('friends2', function ($query) use ($user_id) {
                return $query->where(['user_id' => $user_id, 'status' => 2]);
            })
            ->orWhereHas('friends1', function ($query) use ($user_id) {
                return $query->where(['friend_id' => $user_id, 'status' => 2]);
            })
            ->pluck('id')->toArray();
            //dd($friends);
            $posts = Post::with(['user:id,first_name,last_name,profile_img', 'medias'])
            ->whereIn('user_id',$friends)
            ->orWhere(['user_id' => $user_id])
            ->where('post_type','general')
            ->withCount("likes")->withCount("comments")
            ->orderBy('posts.id', 'desc')->paginate(10);
            //dd( $posts);
            return view('front.newsfeed',compact('posts','allSuggestions','confirmRequests','yourfriends','yourrequests','s_t','c_t','y_f_t','y_r_t'));
        }

        return redirect("/")->with(['alert' => 'error', 'message' => 'Invalid Credentials']);
    }
    public function uploadProfileImage(Request $request)
    {
        if ($request->hasFile('profile_img')) {
            // if(Auth()->user()->profile_img != NULL){
            //     unlink("uploads/profile/".Auth()->user()->profile_img);
            // }
            $image = $request->file('profile_img');
            $imagefilename = Auth()->user()->first_name."_".rand(2, 50) . time() . "." . $image->extension();
            $image->move(public_path('uploads/profile/'), $imagefilename);
            User::where('id', '=', Auth()->user()->id)->update(['profile_img' => $imagefilename]);
            return response()->json('Profile Image Updated Successfully!');
        }
    }
    public function uploadBannerImage(Request $request)
    {
        if ($request->hasFile('banner_img')) {
            // if(Auth()->user()->banner_img != NULL){
            //     unlink("uploads/banner/".Auth()->user()->banner_img);
            // }
            $image = $request->file('banner_img');
            $imagefilename = Auth()->user()->first_name."_".rand(2, 50) . time() . "." . $image->extension();
            $image->move(public_path('uploads/banner/'), $imagefilename);
            User::where('id', '=', Auth()->user()->id)->update(['banner_img' => $imagefilename]);
            return response()->json('Cover Image Updated Successfully!');
        }
    }
    public function uploadUserData(Request $request)
    {
        User::where('id',Auth()->user()->id)->update($request->except(['_token']));
        return response()->json('About Updated Successfully!');
    }
    public function uploadAboutData(Request $request)
    {
        $record = HobbiesInterest::where("user_id",Auth()->user()->id)->first();
       if($record){
            HobbiesInterest::where('user_id',Auth()->user()->id)->update([$request->column_name => $request->hobbies_interests]);
       }else{
            HobbiesInterest::create(["user_id"=>Auth()->user()->id,$request->column_name => $request->hobbies_interests]);
       }
        return response()->json($request->column_name." data updated Successfully!");
    }
    public function uploadUserAboutSection(Request $request)
    {
       //return response()->json($request->all());
       $record = About::where("user_id",Auth()->user()->id)->first();
       if($record){
            About::where('user_id',Auth()->user()->id)->update($request->except(['_token']));
       }else{
            About::create($request->except(['_token']));
       }
        return response()->json("About section updated Successfully!");
    }
    public function uploadUserEducationSection(Request $request)
    {
       //return response()->json($request->all());
       $record = Education::where("user_id",Auth()->user()->id)->first();
       if($record){
            Education::where('user_id',Auth()->user()->id)->update($request->except(['_token']));
       }else{
            Education::create($request->except(['_token']));
       }
        return response()->json("Education section updated Successfully!");
    }
    public function logout()
    {
        Session::flush(); 
        Auth::logout();
        return Redirect('/')->with(['alert' => 'success', 'message' => 'Logout Successfully']);
    }
}