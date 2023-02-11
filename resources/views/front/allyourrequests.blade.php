@extends('front.master')
@section('title') Groups @stop
@section('main-content')
<section class="group-page-sec-1">
	<div class="container-fluid p-0">
		<div class="friend-rqst-box">
			<div class="request-box">
				<div class="top-heading-wrap">
					<button class="back-btn"><i class="fas fa-chevron-left"></i></button>
					<p class="heading">Your Sending Requests <b id="total_count" class="span_number">{{$yourrequests->count()}}</b></p>
				</div>
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
				<div class="suggestion-inner-box">
					<div class="pagination-design">{!! $yourrequests->links('pagination::bootstrap-4') !!}</div>
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
	var counter = $("#total_count").text();
    if(status){
        $(this).text('Add Friend');
        $(this).data('friend-status',0); 
		counter = parseInt(counter) -1;
        $("#total_count").text(counter);
    }else{
		counter = parseInt(counter) +1;
        $("#total_count").text(counter);
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
            toastr.success(response);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            toastr.error("Something Went Wrong");
        }
    });
});
</script>
@stop