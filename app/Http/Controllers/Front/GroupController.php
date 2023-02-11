<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Front\Group;
use App\Models\Front\Post;
use App\Models\Front\GroupFollower;
use App\Models\User;

class GroupController extends Controller
{
    public function groups()
    {
        $user_id = Auth()->user()->id;
        $friends = User::where('id', '!=', $user_id)
        ->whereHas('friends2', function ($query) use ($user_id) {
            return $query->where(['user_id' => $user_id, 'status' => 2]);
        })
        ->orWhereHas('friends1', function ($query) use ($user_id) {
            return $query->where(['friend_id' => $user_id, 'status' => 2]);
        })
        ->pluck('id')->toArray();
        $friendGroups = Group::with('user','follower')->whereIn('user_id',$friends)->orderBy('id', 'desc')->get();
        $friendGroupsCount = count($friendGroups);
        $friendGroups =  $friendGroups->take(6);
        $myGroups = Group::with('user','follower')->where('user_id',$user_id)->orderBy('id', 'desc')->get();
        $myGroupsCount = count($myGroups);
        $myGroups =  $myGroups->take(6);
        $allGroups = Group::with('user','follower')->whereNotIn('user_id',$friends)->where('user_id','!=',$user_id)->orderBy('id', 'desc')->get();
        $allGroupsCount = count($allGroups);
        $allGroups =  $allGroups->take(6);
        //dd($allGroups->toArray());
        return view('front.groups',compact('friendGroups','myGroups','allGroups','friendGroupsCount','myGroupsCount','allGroupsCount'));
    }
    public function createGroup(Request $request)
    {
        $data = [
            'user_id'               => Auth()->user()->id,
            'group_title'           => $request->group_title,
            'group_privacy_type'    => $request->group_privacy_type,
        ];
        if ($request->hasFile('group_profile_img')) {
            $image = $request->file('group_profile_img');
            $group_profile_img = Auth()->user()->first_name."_".rand(2, 50) . time() . "." . $image->extension();
            $image->move(public_path('group/profile'), $group_profile_img);
            $data['group_profile_img'] = $group_profile_img;
        }
        if ($request->hasFile('group_cover_img')) {
            $cover_image = $request->file('group_cover_img');
            $group_cover_img = Auth()->user()->first_name."_".rand(2, 50) . time() . "." . $cover_image->extension();
            $cover_image->move(public_path('group/cover'), $group_cover_img);
            $data['group_cover_img'] = $group_cover_img;
        }
        Group::create($data);
        return redirect("groups")->with(['alert' => 'success', 'message' => 'Group created successfully.']);
    }
    public function changeGroupStatus(Request $request)
    {
        $data = [
            'group_id'              => $request->group_id,
            'follower_id'           => Auth()->user()->id,
        ];
        if($request->btntype=='insert'){
            if($request->group_privacy_type=='private'){
                $data['is_active']    = 'deactive';
                $msg = "Please wait for approval";
            }else{
                $data['is_active']    = 'active';
                $msg = "Enrolled successfully";
            }
            GroupFollower::create($data);
        }
        if($request->btntype=='delete'){
            GroupFollower::where($data)->delete();
            $msg = "Leave successfully";
        }
        return response()->json($msg);
    }
    public function groupNewsfeed($id,Request $request)
    {
        $user_id = Auth()->user()->id;
        $group = Group::where('id',$id)->first();
        $memberExists = GroupFollower::where(['follower_id'=>$user_id,'group_id'=>$id])->first();
        if($group->user_id !=  $user_id){
            if(!$memberExists){
                return redirect("groups")->with(['alert' => 'error', 'message' => 'Removed! no longer in this group.']);
            }
        }
        $follower_ids = GroupFollower::where(['group_id'=>$id,'is_active'=>'active'])->pluck('follower_id')->toArray();
        $members = User::whereIn('id',$follower_ids)->orWhere('id',$group->user_id)->get();
        $members_count = count($members);
        $members =  $members->take(3);

        $posts = Post::with(['user:id,first_name,last_name,profile_img', 'medias'])
        ->where('post_type',$id)
        ->withCount("likes")->withCount("comments")
        ->orderBy('posts.id', 'desc')->paginate(10);

        if($group && $group->user_id ==$user_id){
            $follower_ids = GroupFollower::where(['group_id'=>$id,'is_active'=>'deactive'])->pluck('follower_id')->toArray();
            $confirmRequests = User::whereIn('id',$follower_ids)->get();
            $c_t = count($confirmRequests);
            $confirmRequests =  $confirmRequests->take(3);
        }else{
            $c_t =0;
            $confirmRequests =  new GroupController();
        }
        return view('front.groupnewsfeed',compact('posts','group','confirmRequests','c_t','members','members_count'));
    }
    public function myGroups(Request $request)
    {
        $user_id = Auth()->user()->id;
        $myGroups = Group::with('user','follower')->where('user_id',$user_id)->orderBy('id', 'desc')->paginate(15);
        return view('front.mygroups',compact('myGroups'));
    }
    public function friendGroups(Request $request)
    {
        $user_id = Auth()->user()->id;
        $friends = User::where('id', '!=', $user_id)
        ->whereHas('friends2', function ($query) use ($user_id) {
            return $query->where(['user_id' => $user_id, 'status' => 2]);
        })
        ->orWhereHas('friends1', function ($query) use ($user_id) {
            return $query->where(['friend_id' => $user_id, 'status' => 2]);
        })
        ->pluck('id')->toArray();
        $friendGroups = Group::with('user','follower')->whereIn('user_id',$friends)->orderBy('id', 'desc')->paginate(15);
        return view('front.friendsgroups',compact('friendGroups'));
    }
    public function remainingGroups(Request $request)
    {
        $user_id = Auth()->user()->id;
        $friends = User::where('id', '!=', $user_id)
        ->whereHas('friends2', function ($query) use ($user_id) {
            return $query->where(['user_id' => $user_id, 'status' => 2]);
        })
        ->orWhereHas('friends1', function ($query) use ($user_id) {
            return $query->where(['friend_id' => $user_id, 'status' => 2]);
        })
        ->pluck('id')->toArray();
        $allGroups = Group::with('user','follower')->whereNotIn('user_id',$friends)->where('user_id','!=',$user_id)->orderBy('id', 'desc')->paginate(15);
        return view('front.othersgroups',compact('allGroups'));
    }
    public function deleteMygroup(Request $request)
    {
        $user_id = Auth()->user()->id;
        Group::where(['id'=>$request->group_id,'user_id'=>$user_id])->delete();
        GroupFollower::where(['group_id'=>$request->group_id])->delete();
        return response()->json('Your group deleted successfully');
    }
    public function uploadGroupProfileImage(Request $request)
    {
        if ($request->hasFile('profile_img')) {
            $image = $request->file('profile_img');
            $imagefilename = Auth()->user()->first_name."_".rand(2, 50) . time() . "." . $image->extension();
            $image->move(public_path('group/profile/'), $imagefilename);
            Group::where('id', '=', $request->group_id)->update(['group_profile_img' => $imagefilename]);
            return response()->json('Profile Image Updated Successfully!');
        }
    }
    public function uploadGroupCoverImage(Request $request)
    {
        if ($request->hasFile('banner_img')) {
            $image = $request->file('banner_img');
            $imagefilename = Auth()->user()->first_name."_".rand(2, 50) . time() . "." . $image->extension();
            $image->move(public_path('group/cover/'), $imagefilename);
            Group::where('id', '=', $request->group_id)->update(['group_cover_img' => $imagefilename]);
            return response()->json('Cover Image Updated Successfully!');
        }
    }
    public function uploadGroupTitle(Request $request){
        Group::where(['id'=>$request->group_id])->update(['group_title'=>$request->group_title]);
        return response()->json('Title Updated Successfully!');
    }
    public function leaveGroup(Request $request){
        GroupFollower::where(['group_id'=>$request->group_id,'follower_id'=>$request->follower_id])->delete();
        $group = Group::where('id',$request->group_id)->first();
        if($group->user_id == Auth()->user()->id){
            return response()->json('admin');
        }else{
            return response()->json('member');
        }
    }
    public function confirmGroupRequest(Request $request){
        GroupFollower::where(['group_id'=>$request->group_id,'follower_id'=>$request->follower_id])->update(['is_active'=>'active']);
        return response()->json('Request confirmed successfully.');
    }
    public function allNewRequests($id,Request $request)
    {
        $user_id = Auth()->user()->id;
        $group = Group::where('id',$id)->first();
        $memberExists = GroupFollower::where(['follower_id'=>$user_id,'group_id'=>$id])->first();
        if($group->user_id !=  $user_id){
            if(!$memberExists){
                return redirect("groups")->with(['alert' => 'error', 'message' => 'Removed! no longer in this group.']);
            }
        }
        $follower_ids = GroupFollower::where(['group_id'=>$id,'is_active'=>'deactive'])->pluck('follower_id')->toArray();
        $confirmRequests = User::whereIn('id',$follower_ids)->paginate(10);
        return view('front.groupAllNewRequests',compact('confirmRequests','group'));
    }
    public function allGroupMembers($id,Request $request)
    {
        $user_id = Auth()->user()->id;
        $group = Group::where('id',$id)->first();
        $memberExists = GroupFollower::where(['follower_id'=>$user_id,'group_id'=>$id])->first();
        if($group->user_id !=  $user_id){
            if(!$memberExists){
                return redirect("groups")->with(['alert' => 'error', 'message' => 'Removed! no longer in this group.']);
            }
        }
        $follower_ids = GroupFollower::where(['group_id'=>$id,'is_active'=>'active'])->pluck('follower_id')->toArray();
        $members = User::whereIn('id',$follower_ids)->orWhere('id',$group->user_id)->paginate(10);
        return view('front.groupAllMembers',compact('members','group'));
    }
}
