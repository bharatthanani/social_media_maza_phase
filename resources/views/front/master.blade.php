
<!DOCTYPE html>
<html
dir="ltr"
  lang="en-US"
  class="no-js"
>
<head>
	<meta charset="utf-8">
	<title>Maze Phaze</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="icon" href="{{asset('assetsfront/images/favicon.png')}}" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<link rel="stylesheet" href="{{asset('assetsfront/css/bootstrap.min.css')}}" />
	<link rel="stylesheet" href="{{asset('assetsfront/css/stellarnav.min.css')}}" />
	<link rel="stylesheet" href="{{asset('assetsfront/css/font-awesome.css')}}">
	<link rel="stylesheet" href="{{asset('assetsfront/css/swiper-bundle.min.css')}}">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="{{asset('assetsfront/css/jquery.fancybox.min.css')}}" />
	<link rel="stylesheet" href="{{asset('assetsfront/css/style.css')}}" />
	<link rel="stylesheet" href="{{asset('assetsfront/css/responsive.css')}}" />
	<link rel="stylesheet" href="{{asset('assetsfront/css/waitMe.css')}}" />
	<link rel="stylesheet" href="{{asset('assetsfront/css/toastr.min.css')}}" />
	<link rel="stylesheet" href="{{asset('assetsfront/css/image-uploader.css')}}" />
</head>
<style>
  .pagination-design{
    display: flex;
    justify-content: center;
  }
  .pagination-design .page-item.active .page-link {
    background-color: #ff9d1c !important;
    border-color: #ff9d1c !important;
    color: #000 !important;
  }
</style>
@yield('header-script')
<body>
	<header>
		<!-- RESPONSIVE NAVIGATION -->
		<div class="container-fluid p-0">
			<div class="header-row">
				<div class="logo-col">
					<a href="{{route('news-feed')}}" class="log-box">
						<img src="{{asset('assetsfront/images/header-logo.png')}}" class="img-fluid" alt="img">
					</a>
				</div>
				<div class="navigation-col">
					<div class="navigation-wrap">
						<div id="main-nav" class="stellarnav custom-nav right-col">
							<ul>
								<li><a href="{{route('news-feed')}}" class="nav-icon first-icon"><img src="{{asset('assetsfront/images/nav-icon-1.png')}}" alt="img"></a></li>
								<li><a href="{{route('groups')}}" class="nav-icon"><img src="{{asset('assetsfront/images/nav-icon-2.png')}}" alt="img"></a></li>
								<li><a href="{{route('messages')}}" class="nav-icon"><img src="{{asset('assetsfront/images/nav-icon-3.png')}}" alt="img"></a></li>
								<li><a href="{{route('events')}}" class="nav-icon"><img src="{{asset('assetsfront/images/nav-icon-4.png')}}" alt="img"></a></li>
								<li><a href="{{route('settings')}}" class="nav-icon"><img src="{{asset('assetsfront/images/nav-icon-5.png')}}" alt="img"></a></li>
								<!--<li>-->
								<!--	<a href="{{route('notifications')}}" class="nav-icon notification-icon">-->
								<!--		<img src="{{asset('assetsfront/images/nav-icon-6.png')}}" alt="img">-->
									
								<!--	</a>-->
								<!--</li>-->
								<li><a href="{{route('logout')}}" class="nav-icon"><img src="{{asset('assetsfront/images/logout.png')}}" alt="img"></a></li>
							</ul>

							<div class="left-col">
								<form>
									<div class="form-group">
										<input type="search" name="" placeholder="Search" readonly>
										<a href="" class="search-icon"><img src="{{asset('assetsfront/images/search-icon.png')}}"></a>
									</div>
								</form>
								<div class="user-detail">
									<a href="{{route('editprofile')}}" class="name">{{ auth()->user()->first_name." ".auth()->user()->last_name }}<span>Professional</span></a>
									<a href="" class="profile-img-box">
										<form method="POST" enctype="multipart/form-data">
											@csrf
											<?php $p_img = auth()->user()->profile_img??'profile-1.png';?>
											<img  id="profile_image" src="{{asset('uploads/profile/'.$p_img)}}" class="img-fluid" alt="img">
											<label class="abs-icon"> <i class="fas fa-camera"></i>
												<input type="file" id="profile_img_1" class="dpimage" data-profile1="profile1" name="dpimage" size="80" onchange="document.getElementById('profile_image').src = window.URL.createObjectURL(this.files[0])">
											</label>
										</form>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- RESPONSIVE NAVIGATION -->
	</header>

<section class="dashboard-sec">
	<div class="container-fluid p-0" id="master-main-div-id">
		<div class="dashboard-row">
			<div class="dashboard-left-col">
				<button class="side-bar-toggle-btn"><i class="fas fa-th-large"></i>	</button>
				<ul>
					<li class="dashboard-tabs-btn">
						<a href="{{route('news-feed')}}" ><i class="fas fa-book me-2"></i>News Feed</a>
					</li>
					<li class="dashboard-tabs-btn">
						<a href="{{route('privacypolicy')}}" ><i class="far fa-file-alt me-2"></i>Privacy Policy</a>
					</li>
					<li class="dashboard-tabs-btn">
						<a href="javascript:void(0)" id="create-group-sidebar-btn"><i class="far fa-file-alt me-2"></i>Create Group</a>
					</li>

					<li class="dashboard-tabs-btn">
						<a href="#create-event-modal" class="" data-bs-toggle="modal"  role="button" ><i class="far fa-file-alt me-2"></i>Create Event</a>
					</li>

					<!--<li class="dashboard-tabs-btn">-->
					<!--	<a href="#single-event-modal" class="" data-bs-toggle="modal"  role="button" ><i class="far fa-file-alt me-2"></i>Single Event</a>-->
					<!--</li>-->
				</ul>
			</div>
			<div class="dashboard-right-col">
                @yield('stories')
				@yield('main-content')
			</div>
		</div>
	</div>
	<button class="agent-chat-btn"><i class="fas fa-comments"></i></button>
</section>	
<!-- SHARE POST MODAL -->

<div class="modal fade gen-modal" id="share-post-modal" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
                    <h1 class="heading">Share Post</h1>
                </div>
                <div class="modal-body p-0">
                    <form action="">
                        <ul class="list-unstyled">
                            <li class="form-group">
                                <textarea>Write Something about this......</textarea>
                                <button class="share-btn">Share Now</button>
                            </li>
                            <li class="form-group">
                                <a href="#!" class="share-option"><span><i class="fas fa-plus-circle"></i></i></span> Share to Your Story</a>
                            </li>
                            <li class="form-group">
                               <a href="#!" class="share-option"><span><i class="fas fa-user"></i></span> Share in Private</a>
                           </li>
                           <li class="form-group">
                               <a href="#!" class="share-option"><span><i class="fab fa-whatsapp"></i></span> Share to WhatsApp</a>
                           </li>
                           <li class="form-group">
                               <a href="#!" class="share-option"><span><i class="fas fa-users"></i></span> Share to Group</a>
                           </li>
                       </ul>
                   </form>
               </div>
           </div>
       </div>
   </div>

   <!-- SHARE POST MODAL -->

    <!-- CREATE GROUP MODAL -->

    <div class="modal fade gen-modal group-modal" id="create-group-modal" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
                    <h1 class="top-heading">Create Your Own Group</h1>
                </div>
                <div class="modal-body p-0">
                    <form action="{{route('createGroup')}}" id="groupForm" class="chat-row" enctype="multipart/form-data" method="POST">
                      @csrf
                      <div class="chat-box">
                        <div class="img-box-wrap">
                          <img id="group_img"src="{{asset('uploads/profile/profile-1.png')}}" class="img-fluid w-100" alt="img">
                          <label class="add-story"> <i class="fas fa-camera"></i>
                            <input type="file" name="group_profile_img" size="80"  onchange="document.getElementById('group_img').src = window.URL.createObjectURL(this.files[0])">
                          </label>
                        </div>
                        <button type="button" class="avatar-upgrade">
                          <label class="add-story"> Upload cover image
                            <input type="file" size="80" name="group_cover_img">
                          </label>
                        </button>
                      </div>
                      <div class="form-group">
                        <label>Group Title</label>
                        <input type="text" name="group_title">
                      </div>
                      <div class="form-group">
                        <label>Privacy Type</label>
                        <select name="group_privacy_type">
                          <option value="public">Public</option>
                          <option value="private">Private</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <button type="submit" class="create-btn">Create Group</button>
                      </div>
                   </form>
               </div>
           </div>
       </div>
   </div>

   <!-- CREATE GROUP MODAL -->


  <!-- CREATE EVENT MODAL -->

    <div class="modal fade gen-modal group-modal event-modal" id="create-event-modal" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
                    <h1 class="top-heading">Add New Event</h1>
                </div>
                <div class="modal-body p-0">
                  <form action="{{url('createEvent')}}" id="eventForm" class="chat-row row" enctype="multipart/form-data" method="POST">
                    @csrf
                  <div class="col-lg-6 col-md-6 col-12">
                    <div class="form-group">
                      <label>Event Name</label>
                      <input type="text" id="event_title" name="event_title">
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-12">
                    <div class="form-group">
                      <label>Event Location</label>
                      <input type="text" id="event_location" name="event_location">
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-12">
                    <div class="form-group">
                      <label>Event Date</label>
                      <input type="date" id="event_date" name="event_date">
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-12">
                    <div class="form-group">
                      <label for="event_cover_img">Event Cover Image</label>
                      <input type="file" name="event_cover_img" id="event_cover_img" style="display: block;">
                    </div>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="create-btn">Create</button>
                  </div>
                </form>
               </div>
           </div>
       </div>
   </div>

   <!-- CREATE EVENT MODAL -->


   <!-- SINGLE EVENT MODAL -->

    <div class="modal fade gen-modal group-modal single-event-modal" id="single-event-modal" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
                </div>
                <div class="modal-body p-0 single-group">
                  <div class="event-banner">
                    <img src="{{asset('assetsfront/images/event-banner.png')}}" class="w-100">
                  </div>
                  <div class="top-bar">
                    <div class="left-text-box">
                      <p class="event-date">Jun <span>08</span></p>
                      <div class="text-box pt-1">
                        <h1 class="heading">Lorem Ipsum Dummy Text Sit Amet ipsum  -Jipsum Dummy Next</h1>
                        <p class="location"><i class="fas fa-map-marker-alt"></i> Green Wich Village, New York</p>
                        <p class="desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris. </p>
                      </div>
                    </div>
                    
                    <div class="right-text-box">
                      <div class="person-icons">
                        <a href="#!" class="view-member"><i class="fas fa-ellipsis-h"></i></a>
                        <img class="view-1" src="{{asset('assetsfront/images/members-img-1.png')}}" alt="img">
                        <img class="view-2" src="{{asset('assetsfront/images/members-img-2.png')}}" alt="img">
                        <img class="view-3" src="{{asset('assetsfront/images/members-img-3.png')}}" alt="img">
                      </div>
                      <div class="action-btns">
                        <button class="invite-btn">invite Your Friends +</button>
                        <button class="invite-btn apply-btn ms-2">Apply</button> 
                      </div>
                    </div>
                  </div>

                  <div class="map-row row mt-5">
                    <div class="col-lg-12 col-12">
                      <h1 class="map-heading">Venue Location</h1>
                      <div class="location-map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12093.141477713638!2d-74.0094569128294!3d40.73374581927084!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c259940c3213a7%3A0x8882c42182df455f!2sGreenwich%20Village%2C%20New%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2s!4v1640080300058!5m2!1sen!2s" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                      </div>
                    </div>
                  </div>
                </div>
           </div>
       </div>
   </div>

   <!-- SINGLE EVENT MODAL -->
<script src="{{asset('assetsfront/js/bootstrap.min.js')}}"></script> 
<script src="{{asset('assetsfront/js/jquery-3.5.1.min.js')}}"></script>
<script src="{{asset('assetsfront/js/stellarnav.min.js')}}"></script>
<script src="{{asset('assetsfront/js/swiper-bundle.min.js')}}"></script>
<script src="{{asset('assetsfront/js/jquery.fancybox.min.js')}}"></script> 
<script src="{{asset('assetsfront/js/chart.js')}}"></script>
<script src="{{asset('assetsfront/js/custom.js')}}"></script>
<script src="{{asset('assetsfront/js/toastr.min.js')}}"></script> 
<script src="{{asset('assetsfront/js/image-uploader.js')}}"></script>
<script src="{{asset('assetsfront/js/waitMe.js')}}"></script> 
<script src="{{asset('assetsfront/js/jquery.validate.min.js')}}"></script> 
<script src="{{asset('assetsfront/js/additional-methods.min.js')}}"></script>
<script src="{{asset('assetsfront/js/jquery.timeago.min.js')}}"></script>
<script src="{{asset('assetsfront/stories/dist/zuck.min.js')}}"></script>
<script src="{{asset('assetsfront/stories/demo/script.js')}}"></script>

@yield('footer-script')
<script>
  	$('.input-images2').imageUploader(); // this is for story only
    $(document).on('click', '#create-group-sidebar-btn', function() {
			$('#create-group-modal').modal('show');
		});
    $(document).on('click', '#closeStoryModal', function() {
			$('.story_model').modal('hide');
		});
		// Story Modal
		$(document).on('click', '#storyfile', function() {
			$('.story_model').modal('show');
		});
    $(document).on('click', '#closeStoryModal', function() {
			$('.story_model').modal('hide');
		});
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	var swiper = new Swiper(".mySwiper", {
        spaceBetween: 30,
        centeredSlides: true,
        autoplay: {
          delay: 2500,
          disableOnInteraction: false,
        },
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
      });
	$('.input-images').imageUploader();
	jQuery("time.timeago").timeago();
	var current_effect = 'roundBounce';
	function MainWaitMe(current_effect) {
		$('#master-main-div-id').waitMe({
			effect: current_effect,
			text: 'Please wait ...',
			bg: 'rgba(255,255,255,0.7)',
			color: '#000',
		});
	}
	$(".dpimage").change(function(e) {
		var data = new FormData();
		if($(this).data('profile1') =='profile1'){
			data.append('profile_img', $('#profile_img_1')[0].files[0]);
		}
		if($(this).data('profile2') =='profile2'){
			data.append('profile_img', $('#profile_img_2')[0].files[0]);
		}
		data.append('_token', "{{ csrf_token() }}");
		$.ajax({
			url: 'uploadProfileImage',
			type: 'POST',
			data: data,
			enctype: 'multipart/form-data',
			contentType: false,
			processData: false,
			success: function(response) {
				toastr.success(response);
			},
			error: function() {
				toastr.error("Something Went Wrong");
			}
		});
	});
	$("#banner_img_file").change(function(e) {
		var data = new FormData();
		data.append('banner_img', $('#banner_img_file')[0].files[0]);
		data.append('_token', "{{ csrf_token() }}");
		$.ajax({
			url: 'uploadBannerImage',
			type: 'POST',
			data: data,
			enctype: 'multipart/form-data',
			contentType: false,
			processData: false,
			success: function(response) {
				toastr.success(response);
			},
			error: function() {
				toastr.error("Something Went Wrong");
			}
		});
	});

  $('form[id="groupForm"]').validate({
      rules: {
          group_title: {
              required: true,
          }
      },
      messages: {
        group_title: {
            required: "<span style='color:red'>This field is required</span>",
        },
      },
      submitHandler: function(form) {
          form.submit();
      }
  });
  $('form[id="eventForm"]').validate({
      rules: {
          event_title: {
              required: true,
          },
          event_location: {
              required: true,
          },
          event_date: {
              required: true,
          }
      },
      messages: {
        event_title: {
            required: "<span style='color:red'>This field is required</span>",
        },
        event_location: {
            required: "<span style='color:red'>This field is required</span>",
        },
        event_date: {
            required: "<span style='color:red'>This field is required</span>",
        },
      },
      submitHandler: function(form) {
          form.submit();
      }
  });
</script>
<script>
$(document).ready(function() {
    var type = "{{ Session::get('alert') }}";
    switch (type) {
        case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;

        case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;

        case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;

        case 'error':
            toastr.error("{{ Session::get('message') }}");
            break;
    }
});
</script>

</body>
</html>
