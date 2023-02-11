@extends('front.master')
@section('title') Others Events @stop
@section('main-content')
<section class="event-page-sec-1">
	<div class="container-fluid p-0">
		<div class="dashboard-row">
				<div class="gen-chat-wrap w-100">
					<div class="events-page-wrap row">
						<div class="col-lg-12 col-12">
							<div class="about-box event-box">
								<p class="top-heading">Others Events<span ><a href="javascript:void(0)"> (<span id="myGroupsCount">{{count($othersevents)}}</span>)</a></span></p>
								<div class="row">
								@forelse($othersevents as $key =>$myevent)
								<?php $event_cover_img = $myevent->event_cover_img??'event_cover_img.png';?>
								<div class="col-lg-4 col-md-6 col-sm-12 col-12">
									<div class="event-card mb-4">
										<div class="img-box event-box">
											<img src="{{asset('event/cover/'.$event_cover_img)}}" class="img-fluid w-100 group-coverimg" alt="img" >
										</div>
										<div class="text-box">
											<p class="date"><?= date('d', strtotime($myevent->event_date))?><span><?= date('M', strtotime($myevent->event_date))?></span></p>
											<p class="heading">{{$myevent->event_title}}<span><i class="fas fa-map-marker-alt"></i> {{$myevent->event_location}}</span></p>
										</div>
										<div class="see-detail-box">
											<div class="person-icons">
											@forelse($myevent->followers as $k => $follower)
												<?php $p_img =$follower['user']['profile_img']??'profile-1.png';?>
												<img class="view-{{++$k}}" src="{{asset('uploads/profile/'.$p_img)}}" alt="img">
											@empty
											@endforelse
											<p class="view-count"><b>&nbsp;<?= count($myevent->followers)>=3?'+'.count($myevent->totalfollowers)-count($myevent->followers):'' ?></b></p>
											</div>
											@if($myevent->is_follower->follower_id == auth()->user()->id)
											<a href="javascript:void(0)" data-btntype="delete" data-event-id="{{ $myevent->id }}" class="see-events-btn change-event-status-btn">Leave</a>
											@else
											<a href="javascript:void(0)" data-btntype="insert" data-event-id="{{ $myevent->id }}" class="see-events-btn change-event-status-btn">Apply</a>
											@endif
										</div>
									</div>
								</div>
								@empty
								
								@endforelse
								<div class="suggestion-inner-box">
									<div class="pagination-design">{!! $othersevents->links('pagination::bootstrap-4') !!}</div>
								</div>
								</div>
							</div>
						</div>
					</div>

				</div>
		</div>
	</div>
</section>
@stop
@section('footer-script')
<script>
    $(document).on('click', '#create-event-sidebar-btn', function() {
			$('#create-event-modal').modal('show');
	});
	$(".change-event-status-btn").click(function () {
		var event_id = $(this).data("event-id");
		var btntype = $(this).data("btntype");
		if(btntype =='insert'){
			$(this).text('Leave');
			$(this).data('btntype','delete');
		}else if(btntype =='delete'){
			$(this).text('Apply');
			$(this).data('btntype','insert');
		}
		$.ajax({
			url: "{{route('changeEventStatus')}}",
			type: 'POST',
			data: {
				event_id,btntype
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