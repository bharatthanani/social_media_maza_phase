@extends('front.master')
@section('title') My Groups @stop
@section('main-content')
<section class="group-page-sec-1">
	<div class="container-fluid p-0">
		<div class="dashboard-row">
				<div class="gen-chat-wrap w-100">
					<div class="row group-cards-row mb-4">
						<p class="top-heading">My Groups<span class="span_number" id="myGroupsCount">{{count($myGroups)}}</span></p>
						@forelse($myGroups as $myGroup)
						<div class="col-lg-4 col-md-6 col-sm-6 col-12" id="removeitem_{{$myGroup->id}}">
							<div class="group-card">
								<div class="img-box">
									<?php $group_profile_img = $myGroup->group_profile_img??'group_profile_img.png';?>
									<?php $group_cover_img = $myGroup->group_cover_img??'group_cover_img.png';?>
									<a href="{{ route('groupNewsfeed',['id' => $myGroup->id]) }}"><img src="{{asset('group/cover/'.$group_cover_img)}}" class="img-fluid w-100 group-coverimg" alt="img"></a> 
									<div class="abs-img">
										<a href="javascript:void(0)"><img src="{{asset('group/profile/'.$group_profile_img)}}" class="img-fluid " alt="img"></a> 
									</div>
								</div>
								<div class="text-box">
									<a href="#!" class="heading" title="{{$myGroup->group_title}}">
										
											<?= strlen($myGroup->group_title) > 15 ? substr($myGroup->group_title,0,15)."..." : $myGroup->group_title ?>
										
										<span>{{$myGroup->user->first_name." ".$myGroup->user->last_name}}</span>
									<span style="color:black"><time class="timeago" datetime="{{$myGroup->created_at}}" title="{{$myGroup->created_at}}">{{$myGroup->created_at}}</time></span>	
									</a>
									<div class="action-btns">
									<a data-btntype="delete" data-groupid="{{$myGroup->id}}" data-groupprivacy="{{$myGroup->group_privacy_type}}" href="javascript:void(0)" class="follow-btn mygroup-delete-btn">Delete</a>
									</div>
								</div>
							</div>
						</div>
						@empty
						<a href="javascript:void(0)" id="create-group-sidebar-btn"><i class="far fa-file-alt me-2"></i>Create Group</a>
						@endforelse
						
						<div class="pagination-design">{!! $myGroups->links('pagination::bootstrap-4') !!}</div>
						
					</div>
				</div>
			
		</div>
	</div>
</section>
@stop
@section('footer-script')
<script>
$(".mygroup-delete-btn").click(function () {
    var group_id = $(this).data("groupid");
    $.ajax({
        url: "{{route('deleteMygroup')}}",
        type: 'POST',
        data: {
            group_id
        },
        success: function(response) {
			var myGroupsCount = $("#myGroupsCount").text();
			if(myGroupsCount==1){
				$("#myGroupsCount").text(0);
				$("#myGroupshref").attr("href", "javascript:void(0)");
				$("#create-group-btn").empty();
				$("#create-group-btn").html('<a href="javascript:void(0)" id="create-group-sidebar-btn"><i class="far fa-file-alt me-2"></i>Create Group</a>');
			}else{
				myGroupsCount = --myGroupsCount;
				$("#myGroupsCount").text(myGroupsCount);
			}
			$("#removeitem_"+group_id).empty();
            toastr.success(response);
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