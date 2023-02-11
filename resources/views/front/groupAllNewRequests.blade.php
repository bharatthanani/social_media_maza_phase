@extends('front.master')
@section('title') New Requests for groups @stop
@section('main-content')
<section class="group-page-sec-1">
	<div class="container-fluid p-0">
		
		<div class="friend-rqst-box">
					<div class="request-box">
						<div class="top-heading-wrap">
							<!-- <button class="back-btn"><i class="fas fa-chevron-left"></i></button> -->
							<p class="heading">New Requests for {{$group->group_title}} group <b id="total_count" class="span_number">{{count($confirmRequests)}}</b></p>
						</div>
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
						<div class="suggestion-inner-box">
                        <input type="hidden" name="group_id" id="group_id" value="{{$group->id??0}}"/>
							<div class="pagination-design">{!! $confirmRequests->links('pagination::bootstrap-4') !!}</div>
						</div>
					</div>
				</div>
		
	</div>
</section>
@stop
@section('footer-script')
<script>
$(".confirm-group-request").click(function () {
    var group_id = $("#group_id").val();
    var follower_id = $(this).data("follower-id");
    var counter = $("#total_count").text();
    $.ajax({
        url: "{{route('confirmGroupRequest')}}",
        type: 'POST',
        data: {
            group_id,follower_id
        },
        success: function(response) {
            counter = counter -1;
            $("#total_count").text(counter);
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
    var counter = $("#total_count").text();
    $.ajax({
        url: "{{route('leaveGroup')}}",
        type: 'POST',
        data: {
            group_id,follower_id
        },
        success: function(response) {
            if(response =='admin'){
                counter = counter -1;
                $("#total_count").text(counter);
                $("#leave_group_"+follower_id).empty();
                toastr.success('Removed Successfully');
            }
            return false;
        },
        error: function(jqXHR, textStatus, errorThrown) {
            toastr.error("Something Went Wrong");
            return false;
        }
    });
});
</script>
@stop