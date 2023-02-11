@extends('front.master')
@section('title') News & Feed @stop
@section('main-content')
<style>
    .newGroupTitle{
        font-size: 42px;
        font-weight: 600;
        line-height: 1;
        color: #282828;
        padding-bottom: 32px;
        max-width: 510px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        margin: 20px auto 0;
    }
</style>
<div class="gen-content-wrap groupCoverWrap">
    <div class="row m-0">
        <div class="profile-banner edit-profile-banner">
            <?php $p_b_img = $group->group_cover_img??'group_cover_img.png';?>
            <?php $p_img_2 = $group->group_profile_img??'group_profile_img.png';?>
            <img id="banner_img" src="{{asset('group/cover/'.$p_b_img)}}" alt="banner" class="banner img-fluid">
            <div class="profile-img-box">
                <a href="javascript:void(0)"><img id="pr_img" src="{{asset('group/profile/'.$p_img_2)}}"></a>
                @if($group->user_id == auth()->user()->id) 
                <label class="abs-icon"> <i class="fas fa-camera"></i>
                    <form method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" id="profile_img_2" class="groupProfile" data-profile2="profile2" name="groupProfile" size="80" onchange="document.getElementById('pr_img').src = window.URL.createObjectURL(this.files[0])">
                    </form>
                </label>
                @endif
            </div>
            @if($group->user_id == auth()->user()->id) 
            <label class="edit-btn"> Edit Cover
                <form method="POST" enctype="multipart/form-data">
                    @csrf
                <input type="file" id="groupCover" name="" size="80" onchange="document.getElementById('banner_img').src = window.URL.createObjectURL(this.files[0])">
                </form>
            </label>
            <!-- for responsive screen  -->
            <!-- <label class="edit-btn-2"> <i class="fas fa-camera"></i>
                <input type="file" size="80" >
            </label> -->
            <!-- for responsive screen  -->
            @endif
        </div>
    </div>
    <h1 class="top-heading newGroupTitle" id="group_title_text">{{$group->group_title??''}}</h1>
    @if($group->user_id == auth()->user()->id) 
    <i class="far fa-edit" id="update-grouptitle-btn"></i>
    <input type="hidden" id="hidden_group_title_text" value="{{$group->group_title??''}}" />
    @endif
    
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
                        <input type="hidden" name="group_id" id="group_id" value="{{$group->id??0}}"/>
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
                    <a href="javascript:void(0)" class="see-more-btn dpost"><i class="fas fa-ellipsis-v"></i>
                        <div class="other-options">
                         <button type="button" class="deletePost" post_id="{{ $post['id'] }}">Delte Post</button>
                        </div>
                    </a>
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
            @if($group->group_privacy_type =='private')
            <div class="request-box mb-4">
                @if($c_t)
                <p class="heading">New Requests <span><a id="c_t_access" href="{{route('allNewRequests',['id'=>$group->id])}}" id="c_t"> See All (<span id="c_t">{{$c_t}}</span>)</a></span></p>
                @else
                <p class="heading">New Requests<span><a href="javascript:void(0)"> See All (0)</a></span></p>
                @endif
                @forelse($confirmRequests as $confirmRequest)
                <div class="request-detail" id="leave_group_{{ $confirmRequest->id}}">
                    <a href="#!" class="person-detail">
                        <?php $img = $confirmRequest->profile_img??'profile-1.png';?>
                        <img src="{{asset('uploads/profile/'.$img)}}" class="img-fluid profile-img" alt="img">
                        <p class="name">{{ $confirmRequest->first_name." ".$confirmRequest->last_name??'' }}</p>
                    </a>
                    <div class="action-btn">
                        <a href="javascript:void(0)" data-follower-id="{{ $confirmRequest->id }}" class="request-btn me-3 confirm-group-request" >Confirm</a>
                        <a href="javascript:void(0)" data-follower-id="{{ $confirmRequest->id }}" data-leave-type="new" class="request-btn delete-btn leave-group" >Delete</a>
                    </div>
                </div>
                @empty
                @endforelse
            </div>
            @endif
            <div class="request-box mb-4">
                @if($members)
                <p class="heading">Members <span><a id="m_t_access" href="{{route('allGroupMembers',['id'=>$group->id])}}"> See All (<span id="m_t">{{$members_count}}</span>)</a></span></p>
                @else
                <p class="heading">Members <span><a href="javascript:void(0)"> See All (0)</a></span></p>
                @endif
                @forelse($members as $member)
                <div class="request-detail" id="leave_group_{{ $member->id}}">
                    <a href="#!" class="person-detail">
                        <?php $img = $member->profile_img??'profile-1.png';?>
                        <img src="{{asset('uploads/profile/'.$img)}}" class="img-fluid profile-img" alt="img">
                        @if($member->id == $group->user_id)
                            @if(auth()->user()->id == $group->user_id)
                                <p class="name">{{ $member->first_name." ".$member->last_name??'' }}<b style="color:brown">Admin(<b style="color:#ff9d1c">You</b>)</b></p>
                                @else
                                <p class="name">{{ $member->first_name." ".$member->last_name??'' }}<b style="color:brown">Admin</b></p>
                            @endif
                        @else
                            @if($member->id == auth()->user()->id)
                            <p class="name">{{ $member->first_name." ".$member->last_name??'' }}<b style="color:#ff9d1c">You</b></p>
                            @else
                            <p class="name">{{ $member->first_name." ".$member->last_name??'' }}</p>
                            @endif
                        @endif
                    </a>
                    <div class="action-btn">
                        @if(auth()->user()->id == $group->user_id)
                            @if($member->id != $group->user_id)
                            <a href="javascript:void(0)" data-follower-id="{{ $member->id }}" data-leave-type="member" class="request-btn me-3 leave-group" >Remove</a>
                            @endif
                        @else
                            @if($member->id == auth()->user()->id)
                                <a href="javascript:void(0)" data-follower-id="{{ $member->id }}" data-leave-type="member" class="request-btn me-3 leave-group" >Leave</a>
                            @endif
                        @endif
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
<!-- Group-Model -->
<div class="modal fade gen-modal group-modal" id="update-grouptitle-modal" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
                    <h1 class="top-heading">Update Group Title</h1>
                </div>
                <div class="modal-body p-0">
                    <form id="groupForm" class="chat-row" method="POST">
                      @csrf
                      <div class="form-group">
                        <label>Group Title</label>
                        <input type="text" name="group_title" id="group_title">
                      </div>
                      <div class="form-group">
                        <button type="button" class="create-btn" id="update-grouptitle-data">Update</button>
                      </div>
                   </form>
               </div>
           </div>
       </div>
   </div>
@stop
@section('footer-script')
<script>
$(".confirm-group-request").click(function () {
    var group_id = $("#group_id").val();
    var follower_id = $(this).data("follower-id");
    $.ajax({
        url: "{{route('confirmGroupRequest')}}",
        type: 'POST',
        data: {
            group_id,follower_id
        },
        success: function(response) {
            var c_t = $("#c_t").text();
            if(c_t==1){
                $("#c_t_access").attr("href", "javascript:void(0)");
            }
            $("#c_t").text(--c_t);
            $("#leave_group_"+follower_id).empty();
            toastr.success(response);
            return false;
        },
        error: function(jqXHR, textStatus, errorThrown) {
            toastr.error("Something Went Wrong");
            return false;
        }
    });
});
$(".leave-group").click(function () {
    var group_id = $("#group_id").val();
    var follower_id = $(this).data("follower-id");
    $.ajax({
        url: "{{route('leaveGroup')}}",
        type: 'POST',
        data: {
            group_id,follower_id
        },
        success: function(response) {

            if($(this).data("leave-type") == 'new'){
                var c_t = $("#c_t").text();
                if(c_t==1){
                    $("#c_t_access").attr("href", "javascript:void(0)");
                }
                $("#c_t").text(--c_t);
            }else{
                var m_t = $("#m_t").text();
                if(m_t==1){
                    $("#m_t_access").attr("href", "javascript:void(0)");
                }
                $("#m_t").text(--m_t);
            }
            $("#leave_group_"+follower_id).empty();
            if(response =='admin'){
                toastr.success('Removed Successfully');
                location.reload();
            }else{
                toastr.success('Removed Successfully');
                window.location.href = "{{ route('groups')}}";
            }
            return false;
        },
        error: function(jqXHR, textStatus, errorThrown) {
            toastr.error("Something Went Wrong");
            return false;
        }
    });
});
$(document).on('click','#update-grouptitle-btn',function(e){
    $("#group_title").val($("#hidden_group_title_text").val());
    $("#update-grouptitle-modal").modal('show');
});
$(document).on('click','#update-grouptitle-data',function(e){
    var group_title = $("#group_title").val();
    if(group_title==''){
        toastr.error('group title is required');
        return false;
    }
    MainWaitMe(current_effect);
    var group_id = $("#group_id").val();
    $.ajax({
        type: "POST",
        url:  "{{route('uploadGroupTitle')}}",
        data: {group_id,group_title},
        success: function(response) {
            $("#group_title_text").text(group_title);
            $("#update-grouptitle-modal").modal('hide');
            $('#master-main-div-id').waitMe('hide');
            $("#hidden_group_title_text").val(group_title);
            toastr.success(response);
            return false;
        },
        error: function() {
            toastr.error("Something Went Wrong");
            return false;
        } 
    });
});
$(".groupProfile").change(function(e) {
    var data = new FormData();
    if($(this).data('profile1') =='profile1'){
        data.append('profile_img', $('#profile_img_1')[0].files[0]);
    }
    if($(this).data('profile2') =='profile2'){
        data.append('profile_img', $('#profile_img_2')[0].files[0]);
    }
    data.append('group_id', $("#group_id").val());
    data.append('_token', "{{ csrf_token() }}");
    $.ajax({
        url: "{{route('uploadGroupProfileImage')}}",
        type: 'POST',
        data: data,
        enctype: 'multipart/form-data',
        contentType: false,
        processData: false,
        success: function(response) {
            toastr.success(response);
        },
        error: function() {
            toastr.error("Something Went Wrong");
        }
    });
});
$("#groupCover").change(function(e) {
    var data = new FormData();
    data.append('banner_img', $('#groupCover')[0].files[0]);
    data.append('_token', "{{ csrf_token() }}");
    data.append('group_id', $("#group_id").val());
    $.ajax({
        url: "{{route('uploadGroupCoverImage')}}",
        type: 'POST',
        data: data,
        enctype: 'multipart/form-data',
        contentType: false,
        processData: false,
        success: function(response) {
            toastr.success(response);
        },
        error: function() {
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
        data.append('post_type', $("#group_id").val());
        data.append('_token', "{{ csrf_token() }}");
        MainWaitMe(current_effect);
        $.ajax({
            url: "{{route('createPost')}}",
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
  </script>
@stop