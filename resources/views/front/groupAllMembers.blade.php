@extends('front.master')
@section('title') New Requests for groups @stop
@section('main-content')
<section class="group-page-sec-1">
	<div class="container-fluid p-0">
		
		<div class="friend-rqst-box">
					<div class="request-box">
						<div class="top-heading-wrap">
							<!-- <button class="back-btn"><i class="fas fa-chevron-left"></i></button> -->
							<p class="heading">All members of {{$group->group_title}} group <b id="total_count" class="span_number">{{count($members)}}</b></p>
						</div>
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
						<div class="suggestion-inner-box">
                        <input type="hidden" name="group_id" id="group_id" value="{{$group->id??0}}"/>
							<div class="pagination-design">{!! $members->links('pagination::bootstrap-4') !!}</div>
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
</script>
@stop