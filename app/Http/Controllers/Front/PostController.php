<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Front\Post;
use App\Models\Front\Like;
use App\Models\Front\Comment;
use App\Models\Front\PostMedia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Exception;

class PostController extends Controller
{
    public function createPost(Request $request)
    {
        //dd($request->all());
        DB::beginTransaction();
        try {
            $user_id = Auth()->user()->id;
            $title = $request->input('title');
            $post_id = Post::create([
                'user_id'       => $user_id ? $user_id : NULL,
                'title'         => $title ? $title : NULL,
                'post_type'     => $request->input('post_type'),
            ])->id;
            if ($request->file()) {
                if ($request->images) {
                    foreach ($request->file('images') as $key => $media) {
                        $ext = $media->extension();
                        $fileName = "post_" . $post_id . "_" . $key . "_" . time() . "." . $ext;
                        if (false !== mb_strpos($media->getMimeType(), "image")) {
                            $media->move(public_path('post/images/'), $fileName);
                            $media_type = "image";
                        } else if (false !== mb_strpos($media->getMimeType(), "video")) {
                            $media->move(public_path('post/video/'), $fileName);
                            $media_type = "video";
                        } else if (false !== mb_strpos($media->getMimeType(), "audio")) {
                            $media->move(public_path('post/audio/'), $fileName);
                            $media_type = 'audio';
                        }
                        //dd($media_type_id);
                        DB::table('post_medias')->insert([
                            'post_id'       => $post_id,
                            'media_type' => $media_type,
                            'media'    => $fileName,
                        ]);
                    }
                }
            }
            DB::commit();
            $notification = array(
                'message' => 'Post Created Successfully!',
                'alert' => 'success'
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
    public function getLikes(Request $request)
    {
        $user_id =  Auth()->user()->id;
        $post_id = $request->input('post_id');
        $count = Like::where(['post_id' => $post_id, 'user_id' => $user_id])->count();
        if ($count > 0) {
            Like::where(['post_id' => $post_id, 'user_id' => $user_id])->delete();
        } else {
            $like_id = Like::create([
                'post_id'  => $post_id,
                'user_id'  => $user_id,
                'is_like'  => 1,
            ])->id;
        }
        $like_count = Like::where(['post_id' => $post_id])->count();
        return response()->json($like_count);
    }
    public function getComments(Request $request)
    {
        $user_id =  Auth()->user()->id;
        $post_id = $request->input('post_id');
        $comments = Comment::with(['user:id,first_name,last_name,profile_img'])->where('post_id', $post_id)->get();
        return response()->json($comments);
    }
    public function addComment(Request $request)
    {
        $user_id =  Auth()->user()->id;
        $post_id = $request->input('post_id');
        $comment = $request->input('comment');
        $comment_id = Comment::create([
            'post_id'  => $post_id,
            'user_id'  => $user_id,
            'comment'  => $comment,
        ])->id;
        $comments = Comment::with(['user:id,first_name,last_name,profile_img'])->where('id', $comment_id)->get();
        return response()->json($comments);
    }
    public function deletePost(Request $request)
    {
        $post_id = $request->input('post_id');
        Post::where(['id' => $post_id])->delete();
        PostMedia::where(['post_id' => $post_id])->delete();
        Like::where(['post_id' => $post_id])->delete();
        Comment::where(['post_id' => $post_id])->delete();
        return response()->json("Post Deleted Successfully");
    }
}
