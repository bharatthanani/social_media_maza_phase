@extends('front.master')
@section('title') Groups @stop
@section('main-content')
<section class="group-page-sec-1">
	<div class="container-fluid p-0">
		<div class="friend-rqst-box">
			<div class="request-box">
				<div class="top-heading-wrap">
					<button class="back-btn"><i class="fas fa-chevron-left"></i></button>
					<p class="heading">Your Friends <span id="total_count" class="span_number">{{$yourfriends->count()}}</span></p>
				</div>
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
				<div class="suggestion-inner-box">
					<div class="pagination-design">{!! $yourfriends->links('pagination::bootstrap-4') !!}</div>
				</div>
			</div>
		</div>
	</div>
</section>
@stop
@section('footer-script')
<script>
$(".un-friend-btn").click(function () {
    var friend_id = $(this).data("friend-id");
    var status = $(this).data("friend-status");
	var counter = $("#total_count").text();
    $.ajax({
        url: "{{route('unFriend')}}",
        type: 'POST',
        data: {
            friend_id,status
        },
        success: function(response) {
			counter = counter -1;
            $("#total_count").text(counter);
            $("#un_friend_"+friend_id).empty();
            toastr.success(response);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            toastr.error("Something Went Wrong");
        }
    });
});
</script>
@stop