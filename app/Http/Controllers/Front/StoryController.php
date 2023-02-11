<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Front\Story;
use App\Models\User;
use App\Models\Front\StoryMedia;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Exception;

class StoryController extends Controller
{
    public function createStory(Request $request)
    {
        DB::beginTransaction();
        try {
            $user_id =  Auth()->user()->id;
            $title = $request->input('title');
            $data = [
                'title'         => $title,
                'user_id'       => $user_id,
            ];
            if ($request->file()) {
                if ($request->image) {
                    $ext = $request->image->extension();
                    $fileName = "story_" . time() . "." . $ext;
                    if (false !== mb_strpos($request->image->getMimeType(), "image")) {
                        $request->image->move(public_path('story/images/'), $fileName);
                        $media_type_id = 1;
                    } else if (false !== mb_strpos($request->image->getMimeType(), "video")) {
                        $request->image->move(public_path('story/video/'), $fileName);
                        $media_type_id = 2;
                    }
                    $data['media_type_id'] = $media_type_id;
                    $data['media_name']    = $fileName;
                }
            }
            $story_id = Story::create($data)->id;
            DB::commit();
            $notification = array(
                'message' => 'Story Created Successfully!',
                'alert' => 'success',
            );
        } catch (Exception $e) {
            DB::rollback();
            $notification = array(
                'message' => 'Something Went Wrong',
                'alert' => 'error'
            );
        }
        return response()->json($notification);
    }
    public function getStories(Request $request)
    {
        $user_id =  Auth()->user()->id;
        $friends = User::where('id', '!=', $user_id)
            ->whereHas('friends2', function ($query) use ($user_id) {
                return $query->where(['user_id' => $user_id, 'status' => 2]);
            })
            ->orWhereHas('friends1', function ($query) use ($user_id) {
                return $query->where(['friend_id' => $user_id, 'status' => 2]);
            })
            ->pluck('id')->toArray();
        $stories = DB::table('stories')
            ->join('users', 'users.id', '=', 'stories.user_id')
            ->select('users.id as user_id', 'users.profile_img', 'users.first_name', 'users.last_name', 'stories.id as story_id', 'stories.title', 'stories.media_type_id', 'stories.media_name', DB::raw('COUNT(*) AS total'))
            ->whereIn('user_id',$friends)
            ->orWhere(['user_id' => $user_id])
            ->groupBy('users.id')
            ->orderBy('user_id', 'desc')
            ->get();
        $stories = $stories->toArray();
        $s_d = [];
        foreach ($stories as $key => $val) {
            $s_d[$key] = User::with('stories')->where('id', $val->user_id)->first()->toArray();
        }
        //dd($s_d);
        return response()->json($s_d);
    }
}
