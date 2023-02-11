@extends('front.master')
@section('title') Groups @stop
@section('main-content')
<section class="group-page-sec-1">
	<div class="container-fluid p-0">
		<div class="dashboard-row">
				<div class="gen-chat-wrap w-100">
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

					<!-- <div class="chat-row group-page-wrap row">
					
						<div class="col-lg-12 col-12">
							<div class="top-bar">
								<h1 class="heading">Group</h1>
								<form >
									<div class="form-group-1">
										<input type="search" placeholder="Search Group">
										<a href="#!" class="search-icon"><img src="{{asset('assetsfront/images/search-icon.png')}}"></a>
									</div>
									<div class="form-group-2">
										<label>Order By:</label>
										<select>
											<option>Newest Groups</option>
											<option>Group-2</option>
											<option>Group-3</option>
										</select>
									</div>
								</form>
							</div>
						</div>
					</div> -->
					
					<div class="row group-cards-row mb-4" id="create-group-btn">
						@if($myGroupsCount)
							<h1 class="top-heading">My groups<span><a id="myGroupshref" href="{{route('myGroups')}}"> See All (<span id="myGroupsCount">{{$myGroupsCount}}</span>)</a></span></h1>
						@else
							<p class="top-heading">My groups<span><a href="javascript:void(0)"> See All (0)</a></span></p>
						@endif
						<!-- <span id="create-group-btn"> -->
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
						<!-- </span> -->
					</div>
					<div class="row group-cards-row mb-4">
						@if($friendGroupsCount)
							<h1 class="top-heading">Groups of friends<span><a href="{{route('friendGroups')}}"> See All ({{$friendGroupsCount}})</a></span></h1>
						@else
							<p class="top-heading">Groups of friends<span><a href="javascript:void(0)"> See All (0)</a></span></p>
						@endif
						@forelse($friendGroups as $friendGroup)
							@if(!empty($friendGroup->follower['id']))
								@if($friendGroup->follower->is_active =='active')
									<?php $btn ='<a data-btntype="delete" href="javascript:void(0)"data-groupid="'.$friendGroup->id.'" data-groupprivacy="'.$friendGroup->group_privacy_type.'" class="follow-btn change-group-status-btn">Leave</a>';?>
									<?php $isaccess = true; ?>
								@else
									<?php $btn ='<a data-btntype="delete" data-groupid="'.$friendGroup->id.'" data-groupprivacy="'.$friendGroup->group_privacy_type.'" href="javascript:void(0)" class="follow-btn change-group-status-btn">Pending</a>';?>
									<?php $isaccess = false; ?>
								@endif
							@else
								<?php $btn ='<a href="javascript:void(0)" data-btntype="insert" data-groupid="'.$friendGroup->id.'" data-groupprivacy="'.$friendGroup->group_privacy_type.'" class="follow-btn change-group-status-btn">Follow</a>';?>
								<?php $isaccess = false; ?>
							@endif
						<div class="col-lg-4 col-md-6 col-sm-6 col-12">
							<div class="group-card">
								<div class="img-box">
									<?php $group_profile_img = $friendGroup->group_profile_img??'group_profile_img.png';?>
									<?php $group_cover_img = $friendGroup->group_cover_img??'group_cover_img.png';?>
									@if($isaccess)
									<a id="isaccess{{$friendGroup->id}}" href="{{ route('groupNewsfeed',['id' => $friendGroup->id]) }}"><img src="{{asset('group/cover/'.$group_cover_img)}}" class="img-fluid w-100 group-coverimg" alt="img"></a> 
									@else
									<a id="isaccess{{$friendGroup->id}}" href="javascript:void(0)"><img src="{{asset('group/cover/'.$group_cover_img)}}" class="img-fluid w-100 group-coverimg" alt="img"></a>
									@endif
									<div class="abs-img">
										<a href="javascript:void(0)"><img src="{{asset('group/profile/'.$group_profile_img)}}" class="img-fluid " alt="img"></a> 
									</div>
								</div>
								<div class="text-box">
									<a href="#!" class="heading" title="{{$friendGroup->group_title}}">
										
											<?= strlen($friendGroup->group_title) > 15 ? substr($friendGroup->group_title,0,15)."..." : $friendGroup->group_title ?>
										
										<span>{{$friendGroup->user->first_name." ".$friendGroup->user->last_name}}</span>
									<span style="color:black"><time class="timeago" datetime="{{$friendGroup->created_at}}" title="{{$friendGroup->created_at}}">{{$friendGroup->created_at}}</time></span>	
									</a>
									<div class="action-btns">
										<?php echo $btn; ?>
									</div>
								</div>
							</div>
						</div>
						@empty
						@endforelse
					</div>
					<div class="row group-cards-row mb-4">
						@if($allGroupsCount)
							<h2 class="top-heading">Remaining groups<span><a href="{{route('remainingGroups')}}"> See All ({{$allGroupsCount}})</a></span></h2>
						@else
							<p class="top-heading">Remaining groups<span><a href="javascript:void(0)"> See All (0)</a></span></p>
						@endif
						@forelse($allGroups as $allGroup)
							@if(!empty($allGroup->follower['id']))
								@if($allGroup->follower->is_active =='active')
									<?php $btn ='<a data-btntype="delete" href="javascript:void(0)"data-groupid="'.$allGroup->id.'" data-groupprivacy="'.$allGroup->group_privacy_type.'" class="follow-btn change-group-status-btn">Leave</a>';?>
									<?php $isaccess = true; ?>
								@else
									<?php $btn ='<a data-btntype="delete" data-groupid="'.$allGroup->id.'" data-groupprivacy="'.$allGroup->group_privacy_type.'" href="javascript:void(0)" class="follow-btn change-group-status-btn">Pending</a>';?>
									<?php $isaccess = false; ?>
								@endif
							@else
								<?php $btn ='<a href="javascript:void(0)" data-btntype="insert" data-groupid="'.$allGroup->id.'" data-groupprivacy="'.$allGroup->group_privacy_type.'" class="follow-btn change-group-status-btn">Follow</a>';?>
								<?php $isaccess = false; ?>
							@endif
						<div class="col-lg-4 col-md-6 col-sm-6 col-12">
							<div class="group-card">
								<div class="img-box">
									<?php $group_profile_img = $allGroup->group_profile_img??'group_profile_img.png';?>
									<?php $group_cover_img = $allGroup->group_cover_img??'group_cover_img.png';?>
									@if($isaccess)
									<a id="isaccess{{$allGroup->id}}" href="{{ route('groupNewsfeed',['id' => $allGroup->id]) }}"><img src="{{asset('group/cover/'.$group_cover_img)}}" class="img-fluid w-100 group-coverimg" alt="img"></a> 
									@else
									<a id="isaccess{{$allGroup->id}}" href="javascript:void(0)"><img src="{{asset('group/cover/'.$group_cover_img)}}" class="img-fluid w-100 group-coverimg" alt="img"></a>
									@endif
									<div class="abs-img">
										<a href="javascript:void(0)"><img src="{{asset('group/profile/'.$group_profile_img)}}" class="img-fluid " alt="img"></a> 
									</div>
								</div>
								<div class="text-box">
									<a href="#!" class="heading" title="{{$allGroup->group_title}}">
										
											<?= strlen($allGroup->group_title) > 15 ? substr($allGroup->group_title,0,15)."..." : $allGroup->group_title ?>
										
										<span>{{$allGroup->user->first_name." ".$allGroup->user->last_name}}</span>
									<span style="color:black"><time class="timeago" datetime="{{$allGroup->created_at}}" title="{{$allGroup->created_at}}">{{$allGroup->created_at}}</time></span>	
									</a>
									<div class="action-btns">
										<?php echo $btn; ?>
									</div>
								</div>
							</div>
						</div>
						@empty
						@endforelse
					</div>
				</div>
			
		</div>
	</div>
</section>
@stop
@section('footer-script')
<script>
$(".change-group-status-btn").click(function () {
    var group_id = $(this).data("groupid");
    var group_privacy_type = $(this).data("groupprivacy");
	var btntype = $(this).data("btntype");
    if(group_privacy_type=='public'){
		if(btntype =='insert'){
			$(this).text('Leave');
			$(this).data('btntype','delete');
			var url = '{{ route("groupNewsfeed", ":id") }}';
			url = url.replace(':id', group_id);
			$("#isaccess"+group_id).attr("href", url);
		}else if(btntype =='delete'){
			$(this).text('Follow');
			$(this).data('btntype','insert');
			$("#isaccess"+group_id).attr("href", "javascript:void(0)");
		}
    }else{
		if(btntype =='insert'){
			$(this).text('Pending');
			$(this).data('btntype','delete');
			$("#isaccess"+group_id).attr("href", "javascript:void(0)");
		}else if(btntype =='delete'){
			$(this).text('Follow');
			$(this).data('btntype','insert');
			$("#isaccess"+group_id).attr("href", "javascript:void(0)");
		}
    }
    $.ajax({
        url: "{{route('changeGroupStatus')}}",
        type: 'POST',
        data: {
            group_id,group_privacy_type,btntype
        },
        success: function(response) {
            toastr.success(response);
			return false;
        },
        error: function(jqXHR, textStatus, errorThrown) {
            toastr.error("Something Went Wrong");
			return false;
        }
    });
});
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