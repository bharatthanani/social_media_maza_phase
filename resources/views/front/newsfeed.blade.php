@extends('front.master')
@section('title') News & Feed @stop
@section('header-script')
<!-- lib styles -->
<link rel="stylesheet" href="{{asset('assetsfront/stories/dist/zuck.min.css')}}">

<!-- lib skins -->
<link rel="stylesheet" href="{{asset('assetsfront/stories/dist/skins/snapgram.css')}}">
<link rel="stylesheet" href="{{asset('assetsfront/stories/dist/skins/vemdezap.css')}}">
<link rel="stylesheet" href="{{asset('assetsfront/stories/dist/skins/facesnap.css')}}">
<link rel="stylesheet" href="{{asset('assetsfront/stories/dist/skins/snapssenger.css')}}">
<style>
  .storybox_sec2 li button img {
    border-radius: 50%;
    max-width: 72px;
    min-height: 71px;
    padding: 2px;
  }

  .cmt_wrap .parentbox img {
    max-width: 50px;
    height: 50px;
    border: 3px solid #023ed4;
  }

  .update_sec4_left img,
  .likebox img {
    -webkit-filter: grayscale(1);
    filter: grayscale(1);
    width: 20px;
    position: relative;
    top: -5px;
    margin-right: 10px;
  }

  .update_sec4 button {
    position: relative;
    font-size: 14px;
    font-weight: 700;
    margin-left: 10px;
    border: none;
    background-color: transparent;
  }

  ul.msgbox_bottom_box .msglist img {
    max-width: 60px;
    height: 59px;
  }

  .update_sec5 .cmt_wrap button {
    background-image: linear-gradient(#0b62a5, #021967);
    width: 120px;
    padding: 3px;
    color: #fff;
    margin: 15px;
    border-radius: 10px;
  }

  .cmt_txtarea {
    border: none;
  }
</style>
@stop
@section('stories')
    <h1 class="top-heading">Stories</h1>
    <div class="story-slider-row">
        <div class="story-col-1">
            <div class="add-story-card" id="storyfile">
                <label class="add-story"> +
                </label>
                <p class="desc">Add Story</p>
            </div>
        </div>
        <div id="stories_div">
            <div class="storybox_sec2">
                <div id="stories" class="storiesWrapper"></div>
            </div>
        </div>
    </div>
@stop
@section('main-content')
<div class="gen-content-wrap">
    <!-- <div class="row">
        <div class="col-lg-8 col-12">
            <div class="charts-wrap">
                <div class="bar-chart-wrap">
                    <h1 class="heading">Popularity</h1>
                    <p class="desc">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                    <div class="chartWrap w-100">
                        <canvas class="custome-chart" id="myChart-1" width="100%" height="42vh" style="display: block; box-sizing: border-box; height: 310px; width: 1398px;">
                        </canvas>
                    </div>
                </div>	
            </div>			
        </div>
        <div class="col-lg-4 col-12">
            <div class="pie-chart-wrap">
                <h1 class="heading">Statistics</h1>
                <p class="desc">Lorem Ipsum is simply dummy text of the printing.</p>
                <div class="pieWrap">
                    <canvas id="static" class="custome-chart-2" width="280" height="280" style="display: block; box-sizing: border-box; height: 280px; width: 280px;" class=""></canvas>
                </div>
            </div>
        </div>
    </div> -->

    <div class="chat-row row">
        <div class="col-lg-8 col-12">
            <div class="chat-box">
                <form method="POST" id="createPost" action="createPost" enctype="multipart/form-data">
                @csrf
                <textarea name="title" id="title" placeholder="Whats on your mind {{ auth()->user()->first_name.' '.auth()->user()->last_name }}"></textarea>
                <div class="img-box">
                    <?php $p_img = auth()->user()->profile_img??'profile-1.png';?>
                    <img src="{{asset('uploads/profile/'.$p_img)}}" class="img-fluid" alt="img">
                </div>
                <div class="input-images" id="input_images" style="display: none;"></div>
                <div class="action-btns">
                    <label class="action-btn"> <img src="{{asset('assetsfront/images/chat-abs-icon-1.png')}}">
                        <!-- <input type="file" size="80" name="images" accept='image/*'> -->
                    </label>
                    <label class="action-btn"> <img src="{{asset('assetsfront/images/chat-abs-icon-2.png')}}">
                        <!-- <input type="file" size="80" name="videos" accept='video/*'> -->
                    </label>											
                    <button type="submit" class="action-btn send-btn">
                        <img src="{{asset('assetsfront/images/chat-abs-icon-3.png')}}">
                    </button>
                </div>
               
                </form>
            </div>
            <!-- POST BOX -->
        <div style="display: none;" id="view-posts-div">
        @forelse($posts as $post)
        <div class="user-post-wrap">
                <div class="gen-detail-box gen-profile-box">
                    <!-- Swiper -->
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            <!-- Post Attachments Start -->
                            @forelse($post['medias'] as $media)

                            @if($media['media_type'] =='image')
                            <div class="swiper-slide">
                                <div class="img-box-{{$media['id']}}">
                                    <img src="{{asset('post/images/'.$media['media'])}}" class="img-fluid " alt="img">
                                </div>
                            </div>
                            @elseif($media['media_type'] =='video')
                            <div class="swiper-slide">
                                <div class="img-box-{{$media['id']}}">
                                    <video class="img-fluid" name="video[]" controls>
                                    <source src="{{asset('post/video/'.$media['media'])}}">
                                    </video>
                                </div>
                            </div>
                            @elseif($media['media_type'] =='audio')
                            <div class="swiper-slide">
                                <div class="img-box-{{$media['id']}}">
                                    <audio controls>
                                        <source src="{{asset('post/audio/'.$media['media'])}}">
                                        <source src="horse.mp3" type="audio/mpeg">
                                        Your browser does not support the audio element.
                                    </audio>
                                </div>
                            </div>
                            @endif
                            @empty
                            <div class="swiper-slide">
                                <div class="img-box-1">
                                    <img src="{{asset('post/images/demo.png')}}" class="img-fluid " alt="img">
                                </div>
                            </div>
                            @endforelse
                            <!-- Post Attachments End -->
                        </div>
                    </div>

                    <!-- <div class="img-box-1">
                        <img src="{{asset('assetsfront/images/profile-sec-gen-img-1.png')}}" class="img-fluid " alt="img">
                    </div> -->
                    <div class="text-box">
                        <div class="heading">
                            <div class="date-box">
                            <?= date('d', strtotime($post['created_at']))?><span><?= date('M', strtotime($post['created_at']))?></span>
                            </div>
                            <div class="date-text-box">
                                <p class="tagline"><?= strlen($post['title']) > 40 ? substr($post['title'],0,40)."..." : $post['title'] ?></p>
                                <p><span style="color:black"><time class="timeago post_c_date" datetime="{{ $post['created_at'] }}" title="{{ $post['created_at'] }}">{{ $post['created_at'] }}</time></span></p>
                            </div>
                        </div>
                        <p class="desc collapsed"><?= strlen($post['title']) > 115 ? substr($post['title'],0,115): $post['title'] ?><a href="javascript:void(0)"> SEE MORE</a></p>
                        <p class="desc expanded">{{$post['title']}}<a href="javascript:void(0)">SEE LESS</a></p>


                        <div class="person-contact-box">
                            <a href="#!">
                                <?php $p_img = $post['user']['profile_img']??'profile-1.png';?>
                                <img src="{{asset('uploads/profile/'.$p_img)}}" class="img-fluid profile-img" alt="img">
                                <p class="name">{{$post['user']['first_name']." ".$post['user']['last_name']}}</p>
                            </a>	
                            <div class="contact-action-btns">
                                <button class="detail-btn like-btn like-img likePost" post_id="{{ $post['id'] }}">
                                    <img src="{{asset('assetsfront/images/contact-action-icon-1.png')}}" class="img-fluid">

                                    <p class="counts like-count"><span id="likes_count_{{ $post['id'] }}">{{ $post['likes_count'] }}</span></p>

                                </button>
                                <button class="detail-btn getComments" post_id="{{ $post['id'] }}" type="button">
                                    <img src="{{asset('assetsfront/images/contact-action-icon-2.png')}}" class="img-fluid">
                                    <p class="counts"><span id="comments_count_{{ $post['id'] }}">{{ $post['comments_count'] }}</span></p>
                                </button>
                                <!-- <a class="detail-btn" href="#share-post-modal" class="" data-bs-toggle="modal"  role="button">
                                    <img src="{{asset('assetsfront/images/contact-action-icon-3.png')}}" class="img-fluid">
                                </a> -->
                            </div>
                        </div>
                    </div>
                    @if(auth()->user()->id==$post['user_id'])
                    <a href="javascript:void(0)" class="see-more-btn dpost"><i class="fas fa-ellipsis-v"></i>
                        <div class="other-options">
                       
                         <button type="button" class="deletePost" post_id="{{ $post['id'] }}">Delte Post</button>
                        </div>
                    </a>
                    @endif
                </div>
                <div class="comment-box" class="collapse" id="comment-body-{{$post['id']}}">
                    <div class="col-md-12" id="post-comment">
                        <!-- <div class="header_comment">
                            <div class="row">
                                <div class="col-md-6 text-left top-commnets-items">
                                    <select class="sort_by">
                                        <option>Top Comments</option>
                                        <option>Newest</option>
                                        <option>Oldest</option>
                                    </select>
                                </div>
                                <div class="col-md-6 text-end top-commnets-items">
                                    <span class="count_comment">1.5<span>k</span> Comments</span>
                                </div>
                            </div>
                        </div> -->

                        <div class="body_comment" id="comment_box_{{ $post['id'] }}" style="display: none;">	
                            <div class="row" >
                                <ul id="append_cmt_{{ $post['id'] }}" class="col-md-12">
                                </ul>
                            </div>
                            <div class="row mt-3 post-comment-row">
                                <div class="avatar_comment col-md-1">
                                    <?php $p_img = auth()->user()->profile_img??'profile-1.png';?>
                                    <img src="{{asset('uploads/profile/'.$p_img)}}" alt="avatar"/>
                                </div>
                                <div class="box_comment col-md-11">
                                    <textarea id="cmt_textarea_{{ $post['id'] }}" class="commentar" placeholder="Add a comment..."></textarea>
                                    <div class="box_post">
                                        <div class="pull-right">
                                        <button type="button" post_id="{{ $post['id'] }}" class="add_comment">Add Comment</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>	
                </div>
            </div>
        @empty
          <!-- <div> Empty</div> -->
        @endforelse
        <!-- Show Post End -->
        <br />
        <div class="pagination-design">{!! $posts->links('pagination::bootstrap-4') !!}</div>
        </div>
     <!-- END POST BOX -->
        </div>
        <div class="col-lg-4 col-12">
            <div class="request-box mb-4">
                @if($confirmRequests->count()>0)
                <p class="heading">Friend Requests <span><a href="{{route('allConfirmRequests')}}"> See All ({{$c_t}})</a></span></p>
                @else
                <p class="heading">Friend Requests<span><a href="javascript:void(0)"> See All (0)</a></span></p>
                @endif
                @forelse($confirmRequests as $confirmRequest)
                <div class="request-detail" id="confirmRequest_{{ $confirmRequest->id}}">
                    <a href="#!" class="person-detail">
                        <?php $img = $confirmRequest->profile_img??'profile-1.png';?>
                        <img src="{{asset('uploads/profile/'.$img)}}" class="img-fluid profile-img" alt="img">
                        <p class="name">{{ $confirmRequest->first_name." ".$confirmRequest->last_name??'' }}</p>
                    </a>
                    <div class="action-btn">
                        <a href="javascript:void(0)" data-friend-status="1" data-friend-id="{{ $confirmRequest->id }}" class="request-btn me-3 accept-friendrequest-btn" >Confirm</a>
                        <a href="javascript:void(0)" data-friend-status="1" data-friend-id="{{ $confirmRequest->id }}" class="request-btn delete-btn confirmRequest-delete-btn" >Delete</a>
                    </div>
                </div>
                @empty
                @endforelse
            </div>
            <div class="request-box mb-4">
                @if($allSuggestions->count()>0)
                <p class="heading">People you may know <span><a href="{{route('allSuggestions')}}"> See All ({{$s_t}})</a></span></p>
                @else
                <p class="heading">People you may know <span><a href="javascript:void(0)"> See All (0)</a></span></p>
                @endif
                @forelse($allSuggestions as $allSuggestion)
                <div class="request-detail">
                    <a href="#!" class="person-detail">
                        <?php $img = $allSuggestion->profile_img??'profile-1.png';?>
                        <img src="{{asset('uploads/profile/'.$img)}}" class="img-fluid profile-img" alt="img">
                        <p class="name">{{ $allSuggestion->first_name." ".$allSuggestion->last_name??'' }}</p>
                    </a>
                    <div class="action-btn">
                        <a href="javascript:void(0)" data-friend-status="0" data-friend-id="{{ $allSuggestion->id }}" class="request-btn me-3 add-friend-btn" >Add Friend</a>
                        <!-- <a href="#!" class="request-btn delete-btn" >Delete</a> -->
                    </div>
                </div>
                @empty
                @endforelse
            </div>
            <div class="request-box mb-4">
                @if($yourfriends->count()>0)
                <p class="heading">Your Friends <span><a href="{{route('yourfriends')}}"> See All ({{$y_f_t}})</a></span></p>
                @else
                <p class="heading">Your Friends <span><a href="javascript:void(0)"> See All (0)</a></span></p>
                @endif
                @forelse($yourfriends as $yourfriend)
                <div class="request-detail" id="un_friend_{{ $yourfriend->id}}">
                    <a href="#!" class="person-detail">
                        <?php $img = $yourfriend->profile_img??'profile-1.png';?>
                        <img src="{{asset('uploads/profile/'.$img)}}" class="img-fluid profile-img" alt="img">
                        <p class="name">{{ $yourfriend->first_name." ".$yourfriend->last_name??'' }}</p>
                    </a>
                    <div class="action-btn">
                        <a href="javascript:void(0)" data-friend-status="2" data-friend-id="{{ $yourfriend->id }}" class="request-btn me-3 un-friend-btn" >Un Friend</a>
                        <!-- <a href="#!" class="request-btn delete-btn" >Delete</a> -->
                    </div>
                </div>
                @empty
                @endforelse
            </div>
            <div class="request-box mb-4">
                @if($yourrequests->count()>0)
                <p class="heading">Your Sending Requests <span><a href="{{route('yourrequests')}}"> See All ({{$y_r_t}})</a></span></p>
                @else
                <p class="heading">Your Sending Requests <span><a href="javascript:void(0)"> See All (0)</a></span></p>
                @endif
                @forelse($yourrequests as $yourrequest)
                <div class="request-detail">
                    <a href="#!" class="person-detail">
                        <?php $img = $yourrequest->profile_img??'profile-1.png';?>
                        <img src="{{asset('uploads/profile/'.$img)}}" class="img-fluid profile-img" alt="img">
                        <p class="name">{{ $yourrequest->first_name." ".$yourrequest->last_name??'' }}</p>
                    </a>
                    <div class="action-btn">
                        <a href="javascript:void(0)" data-friend-status="1" data-friend-id="{{ $yourrequest->id }}" class="request-btn me-3 add-friend-btn" >Cancel</a>
                        <!-- <a href="#!" class="request-btn delete-btn" >Delete</a> -->
                    </div>
                </div>
                @empty
                @endforelse
            </div>
            <div class="right-chat-box">
                <div class="chat-box-header">
                        <a href="#!" class="chat-person">
                            <img src="{{asset('assetsfront/images/person-detail-img.png')}}" class="img-fluid" alt="img"> 
                            <p class="name">Adward....</p>
                        </a>
                        <div class="icon-box">
                            <a href="#!"><img src="{{asset('assetsfront/images/right-chat-icon-1.png')}}" class="img-fluid"></a>
                            <a href="#!"><img src="{{asset('assetsfront/images/right-chat-icon-2.png')}}" class="img-fluid"></a>
                            <a href="settings.php" target="_blank"><img src="{{asset('assetsfront/images/right-chat-icon-3.png')}}" class="img-fluid"></a>
                            <a href="#!" class="chat-close"><img src="{{asset('assetsfront/images/right-chat-icon-4.png')}}" class="img-fluid"></a>
                        </div>
                </div>
                <div class="chat-box-body">
                    <div class="messages-box">
                        <div class="message sender">
                            <div class="img-box">
                                <img src="{{asset('assetsfront/images/person-detail-img.png')}}" class="profile-img">
                            </div>
                            <p class="message-content">How are you Lorem ipsum, dolor sit amet consectetur adipisicing elit. Placeat!</p>
                        </div>	
                        <div class="message receiver">
                            <p class="message-content">Fine Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis.</p>
                            <div class="img-box">
                                <img src="{{asset('assetsfront/images/person-detail-img.png')}}" class="profile-img">
                            </div>
                        </div>	
                        <div class="message sender">
                            <div class="img-box">
                                <img src="{{asset('assetsfront/images/person-detail-img.png')}}" class="profile-img">
                            </div>
                            <p class="message-content">What about you! Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed.</p>
                        </div>	
                    </div>
                    <div class="sender-message-box">
                        <div class="wrtie-message">
                            <form>
                                <div class="form-group">
                                    <textarea>Message...</textarea>
                                    <a href="#!" class="send-btn">
                                        <img src="{{asset('assetsfront/images/chat-abs-icon-3.png')}}">
                                    </a>
                                </div>
                            </form>
                            <div class="attachment-box">
                                <label class="action-btn attach-icon blue" id="chat-attachments"> <i class="fas fa-paperclip"></i>
                                    <input type="file" size="80" >
                                </label>
                                <label class="action-btn attach-icon purple"> <img src="{{asset('assetsfront/images/attact-img-icon-1.png')}}">
                                    <input type="file" size="80" >
                                </label>
                                <label class="action-btn attach-icon"> <img src="{{asset('assetsfront/images/attact-img-icon-2.png')}}">
                                    <input type="file" size="80" >
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Start-Story-Model -->
<div class="modal fade story_model" id="add_story" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Story</h5>
      </div>
      <div class="modal-body" id="container">
      <form enctype="multipart/form-data" id="create_story" action="{{ url('user/createStory') }}" method="POST">
            @csrf
        <div class="form-group">
          <label for="recipient-name" class="col-form-label">Story Text:</label>
          <input type="text" name="story_title" class="form-control" id="story_title" placeholder="User Story Text">
        </div>
        <div class="form-group">
            <label for="image" class="col-form-label">Story image or video:</label>
            <input type="file" class="form-control" name="image" id="image" style="display:block;">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeStoryModal">Cancel</button>
          <button type="submit" class="btn btn-primary" id="add_story_waitme">Create Story</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  <!-- End-Model -->
@stop
@section('footer-script')
<script>
$(".add-friend-btn").click(function () {
    var friend_id = $(this).data("friend-id");
    var status = $(this).data("friend-status");
    if(status){
        $(this).text('Add Friend');
        $(this).data('friend-status',0); 
    }else{
        $(this).text('Cancel');
        $(this).data('friend-status',1); 
    }
    //alert(status);
    $.ajax({
        url: "{{route('addFriend')}}",
        type: 'POST',
        data: {
            friend_id,status
        },
        success: function(response) {
            if(status==0){
                $(this).text('Cancel');
                $(this).data('friend-status',1); 
            }else{
                $(this).text('Cancel');
                $(this).data('friend-status',0); 
            }
            toastr.success(response);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            toastr.error("Something Went Wrong");
        }
    });
});
$(".un-friend-btn").click(function () {
    var friend_id = $(this).data("friend-id");
    var status = $(this).data("friend-status");
    $.ajax({
        url: "{{route('unFriend')}}",
        type: 'POST',
        data: {
            friend_id,status
        },
        success: function(response) {
            $("#un_friend_"+friend_id).empty();
            toastr.success(response);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            toastr.error("Something Went Wrong");
        }
    });
});
$(".confirmRequest-delete-btn").click(function () {
    var friend_id = $(this).data("friend-id");
    var status = $(this).data("friend-status");
    $.ajax({
        url: "{{route('confirmRequestDelete')}}",
        type: 'POST',
        data: {
            friend_id,status
        },
        success: function(response) {
            $("#confirmRequest_"+friend_id).empty();
            toastr.success(response);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            toastr.error("Something Went Wrong");
        }
    });
});
$(".accept-friendrequest-btn").click(function () {
    var friend_id = $(this).data("friend-id");
    var status = $(this).data("friend-status");
    $.ajax({
        url: "{{route('acceptFriendrequest')}}",
        type: 'POST',
        data: {
            friend_id,status
        },
        success: function(response) {
            $("#confirmRequest_"+friend_id).empty();
            toastr.success(response);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            toastr.error("Something Went Wrong");
        }
    });
});
    $(document).on('submit', '#createPost', function(e) {
        e.preventDefault();
        if ($('#createPost input[type=file]').get(0).files.length <= 0 && $("#title").val() == "") {
            toastr.error("Title of the post is required");
            return false;
        }
        var form = $(this);
        var url = form.attr("action");
        var data = new FormData(form[0]);
        data.append('title', $("#title").val());
        data.append('post_type', 'general');
        data.append('_token', "{{ csrf_token() }}");
        MainWaitMe(current_effect);
        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            cache: false,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.alert == 'success') {
                    toastr.success(response.message);
                    location.reload();
                } else if (response.alert == 'error') {
                    toastr.error(response.message);
                }
                //console.log(response);
                $('#master-main-div-id').waitMe('hide');
            },
            error: function(error) {
                console.log(error);
                $('#master-main-div-id').waitMe('hide');
                toastr.error("Something Went Wrong");
            }
        });
	});
    // POST LIKES
    $(document).on('click', '.likePost', function() {
        var post_id = $(this).attr("post_id");
        $.ajax({
            url: "{{route('getLikes')}}",
            type: 'POST',
            data: {
                post_id
            },
            success: function(response) {
                //console.log(response);
                var like = $(this);
                if (like.hasClass("active")) {
                    like.removeClass("active");
                } else {
                    like.addClass("active");
                }
                $("#likes_count_" + post_id).text(response);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                toastr.error("Something Went Wrong");
            }
        });
    });
    // POST LIKES
    var x = false;
    $(document).on('click', '.getComments', function() {
        var post_id = $(this).attr("post_id");
        if (!x){
            x = true;
            $('#append_cmt_' + post_id).html('');
            $('#comment_box_' + post_id).hide();
            $.ajax({
                url: "{{route('getComments')}}",
                type: 'POST',
                data: {
                    post_id
                },
                success: function(response) {
                    console.log(response);
                    var APP_URL = "<?php echo url('/').'/public'; ?>";
                    var total_count = 0;
                    response.forEach(function(item) {
                        total_count++;       
                        var divsToAppend = '';
                        var image = APP_URL + '/uploads/profile' + "/" + (item.user.profile_img ? item.user.profile_img : 'profile-1.png');
                        divsToAppend += ' <li class="box_result row">';
                        divsToAppend += '<div class="avatar_comment col-md-1">';
                        divsToAppend += '<img src=' + image + ' alt="icon" class="avatar">';
                        divsToAppend += '</div>';
                        divsToAppend += '<div class="result_comment col-md-11">';
                        divsToAppend += '<h4>' + item.user.first_name + " " + item.user.last_name + '</h4>';
                        divsToAppend += '<span><time class="timeago" datetime=' + item.created_at + ' title=' + item.created_at + '>' + item.created_at + '</time></span>';
                        divsToAppend += '<p>' + item.comment + '</p>';
                        divsToAppend += '</li>';
                        //console.log(divsToAppend);
                        $('#append_cmt_' + post_id).append(divsToAppend);
                    });
                    $('#comment_box_' + post_id).show();
                    $("#comments_count_" + post_id).text(total_count);
                    jQuery("time.timeago").timeago();
                    //return false;
                   
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    toastr.error("Something Went Wrong");
                }
            });
        }
        else {
            $('#comment_box_' + post_id).hide();
            x = false;
           
        }
        //x = false;
    });
    $(document).on('click', '.add_comment', function() {
        var post_id = $(this).attr("post_id");
        var comment = $("#cmt_textarea_" + post_id).val();
        if (comment == "") {
            toastr.error("Please type something");
            //alert("Comment can not be empty");
            return false;
        }
        $.ajax({
            url: "{{route('addComment')}}",
            type: 'POST',
            data: {
                post_id,
                comment
            },
            success: function(response) {
                $("#cmt_textarea_" + post_id).val('');
                var APP_URL = "<?php echo url('/').'/public'; ?>";
                var divsToAppend = '';
                var image = APP_URL + '/uploads/profile' + "/" + (response[0].user.profile_img ? response[0].user.profile_img : 'profile-1.png');
                divsToAppend += ' <li class="box_result row">';
                divsToAppend += '<div class="avatar_comment col-md-1">';
                divsToAppend += '<img src=' + image + ' alt="icon" class="avatar">';
                divsToAppend += '</div>';
                divsToAppend += '<div class="result_comment col-md-11">';
                divsToAppend += '<h4>' + response[0].user.first_name + " " + response[0].user.last_name + '</h4>';
                divsToAppend += '<span><time class="timeago" datetime=' + response[0].created_at + ' title=' + response[0].created_at + '>' + response[0].created_at + '</time></span>';
                divsToAppend += '<p>' + response[0].comment + '</p>';
                divsToAppend += '</li>';
                $('#append_cmt_' + post_id).append(divsToAppend);
                var num = +$("#comments_count_" + post_id).text() + 1;
                //console.log($("#comments_count_"+post_id).val());
                $("#comments_count_" + post_id).text(num);
                jQuery("time.timeago").timeago();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                toastr.error("Something Went Wrong");
            }
        });
    });
    
    $('.deletePost').on('click', function(e){
        e.preventDefault();
        var result = confirm("Are you sure you want to delete this post?");
        if (result==true) {
            var post_id = $(this).attr("post_id");
            //alert(post_id)
            $.ajax({
                url: "{{route('deletePost')}}",
                type: 'POST',
                data: {
                    post_id
                },
                success: function(response) {
                    //console.log(response);
                    toastr.success(response);
                    location.reload();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    toastr.error("Something Went Wrong");
                }
            });
        } else {
        return false;
        }
    });
    $("#input_images").show();
    $("#view-posts-div").show();
</script>
<script>
    function getStories() {
      $.ajax({
        url: "{{route('getStories')}}",
        type: 'GET',
        success: function(allstories) {
          //console.log(stories);
          var APP_URL = "<?php echo url('/').'/public'; ?>";
          var stories_data = [];
          var stories_attachment = [];
          $.each(allstories, function(key, value) {
            var stories_attachment = [];
            $.each(value.stories, function(k, val) {
              if (val.media_type_id == 1) {
                var type = 'photo';
                var type_folder = 'images';
                var type_num = 3;
              } else if (val.media_type_id == 2) {
                var type = 'video';
                var type_folder = 'video';
                var type_num = 0;
              } else {
                var type = 'photo';
                var type_num = 3;
                var type_folder = 'images';
              }
              var img = APP_URL + '/story' + "/" + type_folder + "/" + (val.media_name ? val.media_name : 'demo.png');
              stories_attachment[k] = [k, type, type_num, img, img, '', false, false, timestamp()]
            });
            var image = APP_URL + '/uploads/profile' + "/" + (value.profile_img ? value.profile_img : 'profile-1.png');
            stories_data[key] = Zuck.buildTimelineItem(
              value.first_name + ' ' + value.last_name,
              image,
              value.first_name + ' ' + value.last_name,
              "https://ramon.codes",
              timestamp(),
              stories_attachment
            )

          });
          var currentSkin = getCurrentSkin();
          var stories = new Zuck('stories', {
            backNative: true,
            previousTap: true,
            skin: currentSkin['name'],
            autoFullScreen: currentSkin['params']['autoFullScreen'],
            avatars: currentSkin['params']['avatars'],
            paginationArrows: currentSkin['params']['paginationArrows'],
            list: currentSkin['params']['list'],
            cubeEffect: currentSkin['params']['cubeEffect'],
            localStorage: true,
            stories: stories_data
          });
          jQuery("time.timeago").timeago();
          //console.log(stories_attachment);
          //console.log(storiess);
          //console.log(stories_data);
        },
        error: function(jqXHR, textStatus, errorThrown) {
          toastr.error("Something Went Wrong");
        }
      });
    }
    // Create Story
    $("#create_story").submit(function(e) {
        e.preventDefault();
        if ($('#create_story input[type=file]').get(0).files.length <= 0 && $("#story_title").val() == "") {
            toastr.error("Story text is required");
            return false;
        }
        var form = $(this);
        var url = form.attr("action");
        var data = new FormData(form[0]);
        data.append('title', $("#story_title").val());
        MainWaitMe(current_effect);
        $.ajax({
            url: "{{route('createStory')}}",
            type: 'POST',
            data: data,
            cache: false,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.alert == 'success') {
                    $("#stories_div").empty();
                    $("#stories_div").html(' <div class="storybox_sec2"><div id="stories" class="storiesWrapper"></div></div>');
                    getStories();
                    $('#create_story').trigger("reset");
                    $('.story_model').modal('hide');
                    $('#master-main-div-id').waitMe('hide');
                    toastr.success(response.message);
                    //location.reload();
                } else if (response.alert == 'error') {
                    toastr.error(response.message);
                    $('#master-main-div-id').waitMe('hide');
                }
            },
            error: function(error) {
                console.log(error);
                toastr.error("Something Went Wrong");
                $('#master-main-div-id').waitMe('hide');
            }
        });
    });
    $(document).ready(function() {
      getStories();
    });
  </script>
@stop