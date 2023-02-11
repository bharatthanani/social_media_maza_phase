@extends('front.master')
@section('title') Friends Groups @stop
@section('main-content')
<section class="group-page-sec-1">
	<div class="container-fluid p-0">
		<div class="dashboard-row">
				<div class="gen-chat-wrap w-100">
				<div class="row group-cards-row mb-4">
						<p class="top-heading">Remaining Groups<span class="span_number">{{count($allGroups)}}</span></p>
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
									<a id="isaccess{{$allGroup->id}}" href="{{ route('groupNewsfeed',['id' => $allGroup->id]) }}"><img src="{{asset('group/cover/'.$group_cover_img)}}" class="img-fluid w-100" alt="img"></a> 
									@else
									<a id="isaccess{{$allGroup->id}}" href="javascript:void(0)"><img src="{{asset('group/cover/'.$group_cover_img)}}" class="img-fluid w-100" alt="img"></a>
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
</script>
@stop