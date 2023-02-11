@extends('front.master')
@section('title') Groups @stop
@section('main-content')
<section class="group-page-sec-1">
	<div class="container-fluid p-0">
		
		<div class="friend-rqst-box">
					<div class="request-box">
						<div class="top-heading-wrap">
							<button class="back-btn"><i class="fas fa-chevron-left"></i></button>
							<p class="heading">People you may know <b id="total_count" class="span_number">{{$allSuggestions->count()}}</b></p>
						</div>
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
						<div class="suggestion-inner-box">
							<div class="pagination-design">{!! $allSuggestions->links('pagination::bootstrap-4') !!}</div>
						</div>
					</div>
				</div>
		
	</div>
</section>
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
</script>
@stop