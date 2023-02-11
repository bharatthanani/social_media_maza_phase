@extends('front.master')
@section('title') Groups @stop
@section('main-content')
<section class="group-page-sec-1">
	<div class="container-fluid p-0">
		
		<div class="friend-rqst-box">
					<div class="request-box">
						<div class="top-heading-wrap">
							<button class="back-btn"><i class="fas fa-chevron-left"></i></button>
							<p class="heading">Friend Requests <b id="total_count" class="span_number">{{count($confirmRequests)}}</b></p>
						</div>
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
						<div class="suggestion-inner-box">
							<div class="pagination-design">{!! $confirmRequests->links('pagination::bootstrap-4') !!}</div>
						</div>
					</div>
				</div>
		
	</div>
</section>
@stop
@section('footer-script')
<script>
$(".accept-friendrequest-btn").click(function () {
    var friend_id = $(this).data("friend-id");
    var status = $(this).data("friend-status");
    var counter = $("#total_count").text();
    $.ajax({
        url: "{{route('acceptFriendrequest')}}",
        type: 'POST',
        data: {
            friend_id,status
        },
        success: function(response) {
            counter = counter -1;
            $("#total_count").text(counter);
            $("#confirmRequest_"+friend_id).empty();
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
    var counter = $("#total_count").text();
    $.ajax({
        url: "{{route('confirmRequestDelete')}}",
        type: 'POST',
        data: {
            friend_id,status
        },
        success: function(response) {
            counter = counter -1;
            $("#total_count").text(counter);
            $("#confirmRequest_"+friend_id).empty();
            toastr.success(response);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            toastr.error("Something Went Wrong");
        }
    });
});
</script>
@stop