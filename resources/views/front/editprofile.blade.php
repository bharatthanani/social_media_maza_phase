@extends('front.master')
@section('title') Messages @stop
@section('main-content')
<div class="profile-banner edit-profile-banner">
	<?php $p_b_img = auth()->user()->banner_img??'profile-banner-demo.png';?>
	<?php $p_img_2 = auth()->user()->profile_img??'profile-2.png';?>
	<img id="banner_img" src="{{asset('uploads/banner/'.$p_b_img)}}" alt="banner" class="banner img-fluid">
	<div class="profile-img-box">
		<a href="#!"><img id="pr_img" src="{{asset('uploads/profile/'.$p_img_2)}}"></a> 
		<label class="abs-icon"> <i class="fas fa-camera"></i>
			<form method="POST" enctype="multipart/form-data">
			@csrf
			<input type="file" id="profile_img_2" class="dpimage" data-profile2="profile2" name="dpimage" size="80" onchange="document.getElementById('pr_img').src = window.URL.createObjectURL(this.files[0])">
			</form>
		</label>
	</div>
	<label class="edit-btn"> Edit Cover
		<form method="POST" enctype="multipart/form-data">
			@csrf
		<input type="file" id="banner_img_file" size="80" onchange="document.getElementById('banner_img').src = window.URL.createObjectURL(this.files[0])">
		</form>
	</label>
	<!-- for responsive screen  -->
	<label class="edit-btn-2"> <i class="fas fa-camera"></i>
		<input type="file" size="80" >
	</label>
	<!-- for responsive screen  -->
</div>

<section class="edit-profile-sec">
	<div class="container">
		<div class="row edit-profile-row">
			<div class="col-lg-6 col-md-12 mb-md-5">
				<div class="left-edit-box">
					<h1 class="top-heading">Edit Profile</h1>	
					<form class="row" method="POST" id="updateProfile" enctype="multipart/form-data">
						@csrf
						<div class="col-lg-6 col-12">
							<div class="form-group">
								<label for="first_name">First Name</label>
								<input type="name" name="first_name" id="first_name" placeholder="Enter First Name" value="{{ auth()->user()->first_name??''}}"> 
							</div>
						</div>
						<div class="col-lg-6 col-12">
							<div class="form-group">
								<label for="last_name">Last Name</label>
								<input type="name" name="last_name" id="last_name" placeholder="Enter Last Name" value="{{ auth()->user()->last_name??''}}">
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label for="email">Email</label>
								<input type="email" name="email" id="email" placeholder="Enter Your Email" value="{{ auth()->user()->email??''}}">
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label for="contact_num">Contact Number</label>
								<input type="tel" name="contact_num" id="contact_num" placeholder="Enter Your Contact Number" value="{{ auth()->user()->contact_num??''}}">
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label for="address">Address</label>
								<input type="text" name="address" id="address" placeholder="Enter Your Address" value="{{ auth()->user()->address??''}}">
							</div>
						</div>
						<div class="col-6">
							<div class="form-group">
								<label for="state">State</label>
								<select name="state" id="state">
									@forelse($states as $state)
									<option <?= auth()->user()->state==$state->id?'selected':''?> value="{{$state->id}}">{{$state->name??""}}</option>
									@empty
									@endforelse
								</select>
							</div>
						</div>
						<div class="col-6">
							<div class="form-group">
							<label for="city">City</label>
							<input type="text" name="city" id="city" placeholder="Enter Your City" value="{{ auth()->user()->city??''}}">
							</div>
						</div>
						<div class="col-12">
							<div class="form-group" id="updateProfileBtn">
								<button type="submit" class="save-btn">Save Changes</button>
							</div>
						</div>
					</form>

					<div class="row">
						<div class="col-lg-6 col-md-12 col-12 mb-4">
							<div class="left-detail-box">
								<h1 class="heading">About</h1>
								<ul class="list-unstyled">
									<li>Function: <span id="about_function_span">{{$about->about_function??""}}</span></li>
									<li>Company: <span id="company_span">{{$about->company??""}}</span></li>
									<li>Web: <span id="web_span">{{$about->web??""}}</span></li>
									<li>Member of: <span id="member_span">{{$about->member??""}}</span></li>
									<li>Joining Date: <span id="joining_date_span">{{$about->joining_date??''}}</span></li>
								</ul>
								<button class="edit-btn" id="user-about-info-btn"><i class="far fa-edit"></i></button>
							</div>
						</div>
						<div class="col-lg-6 col-md-12 col-12 mb-4">
							<div class="left-detail-box">
								<h1 class="heading">Education and Employment:</h1>
								<ul class="list-unstyled">
									<li>Education: <span id="education_span">{{$education->education??""}}</span></li>
									<li>Institution:<span id="institution_span">{{$education->institution??""}}</span></li>
									<li>Employment: <span id="employment_span">{{$education->employment??""}}</span></li>
									<li>Year: <span id="year_span">{{$education->year??""}}</span></li>
								</ul>
								<button class="edit-btn" id="user-education-info-btn"><i class="far fa-edit"></i></button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-12">
				<div class="right-edit-box">
					<h1 class="top-heading">Edit About</h1>	
					
					<form class="edit-about">
						<h1 class="sub-heading">Hobbies and Interests</h1>
						<div class="form-group">
							<label id="hobbies_label">My Hobbies:</label>
							<textarea name="hobbies" id="hobbies" class="hobbies-interests" disabled>{{$hobbiesInterest->hobbies??""}}</textarea>
							<button type="button" fieldId="hobbies" mylabel="hobbies_label" class="edit-btn open-about-modal-btn"><i class="far fa-edit"></i></button>
						</div>
						<div class="form-group">
							<label id="music_label">Favourite Music Bands/Artists:</label>
							<textarea name="music" id="music" class="hobbies-interests" disabled>{{$hobbiesInterest->music??""}}</textarea>
							<button type="button" fieldId="music" mylabel="music_label" class="edit-btn open-about-modal-btn"><i class="far fa-edit"></i></button>
						</div>
						<div class="form-group">
							<label id="tv_label">Favourite TV Shows:</label>
							<textarea name="tv" id="tv" class="hobbies-interests" disabled>{{$hobbiesInterest->tv??""}}</textarea>
							<button type="button" fieldId="tv" mylabel="tv_label" class="edit-btn open-about-modal-btn"><i class="far fa-edit"></i></button>
						</div>
						<div class="form-group">
							<label id="books_label">Favourite Books:</label>
							<textarea name="books" id="books" class="hobbies-interests" disabled>{{$hobbiesInterest->books??""}}</textarea>
							<button type="button" fieldId="books" mylabel="books_label" class="edit-btn open-about-modal-btn"><i class="far fa-edit"></i></button>
						</div>
						<div class="form-group">
							<label id="movies_label">Favourite Movies:</label>
							<textarea name="movies" id="movies" class="hobbies-interests" disabled>{{$hobbiesInterest->movies??""}}</textarea>
							<button type="button" fieldId="movies" mylabel="movies_label" class="edit-btn open-about-modal-btn"><i class="far fa-edit"></i></button>
						</div>
						<div class="form-group">
							<label id="activities_label">Other Activities:</label>
							<textarea name="activities" id="activities" class="hobbies-interests" disabled>{{$hobbiesInterest->activities??""}}</textarea>
							<button type="button" fieldId="activities" mylabel="activities_label" class="edit-btn open-about-modal-btn"><i class="far fa-edit"></i></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Edit hobbies_interests Modal -->
<div class="modal fade" id="update-about-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Hobbies and Interests</h5>
      </div>
      <div class="modal-body">
        <form method="POST">
			@csrf
          <!-- <div class="form-group">
            <label for="recipient-name" class="col-form-label">Recipient:</label>
            <input type="text" class="form-control" id="recipient-name">
          </div> -->
          <div class="form-group">
            <label for="message-text" class="col-form-label" id="hobbies_interests_title"></label>
            <textarea class="form-control" name="hobbies_interests" id="hobbies_interests" rows="3"></textarea>
			<input type="hidden" name="column_name" id="column_name" value="">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" id="about-close-btn" class="btn btn-secondary">Close</button>
        <button type="button" class="create-btn" id="update-about-data">Save Changes</button>
      </div>
    </div>
  </div>
</div>
<!-- Edit About Modal -->
<div class="modal fade" id="user-about-info-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit About</h5>
      </div>
      <div class="modal-body">
        <form method="POST">@csrf
          <div class="form-group">
            <label for="about_function" class="col-form-label">Function:</label>
            <input type="text" class="form-control" name="about_function" id="about_function">
          </div>
          <div class="form-group">
            <label for="company" class="col-form-label">Company:</label>
            <input type="text" class="form-control" name="company" id="company">
          </div>
		  <div class="form-group">
            <label for="web" class="col-form-label">Web:</label>
            <input type="url" class="form-control" name="web" id="web">
          </div>
		  <div class="form-group">
            <label for="member" class="col-form-label">Member of:</label>
            <input type="text" class="form-control" name="member" id="member">
          </div>
		  <div class="form-group">
            <label for="joining_date" class="col-form-label">Joining Date:</label>
            <input type="date" class="form-control" name="joining_date" id="joining_date">
			<input type="hidden" name="about_user_id" id="about_user_id" value="{{auth()->user()->id}}">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" id="close-about-info-btn" class="btn btn-secondary">Close</button>
        <button type="button" class="create-btn" id="update-about-info-btn">Save Changes</button>
      </div>
    </div>
  </div>
</div>

<!-- Edit About Modal -->
<div class="modal fade" id="user-education-info-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Education and Employment</h5>
      </div>
      <div class="modal-body">
        <form method="POST">@csrf
          <div class="form-group">
            <label for="education" class="col-form-label">Education:</label>
            <input type="text" class="form-control" name="education" id="education">
          </div>
          <div class="form-group">
            <label for="institution" class="col-form-label">Institution:</label>
            <input type="text" class="form-control" name="institution" id="institution">
          </div>
		  <div class="form-group">
            <label for="employment" class="col-form-label">Employment:</label>
            <input type="text" class="form-control" name="employment" id="employment">
          </div>
		  <div class="form-group">
            <label for="year" class="col-form-label">Year:</label>
            <input type="date" class="form-control" name="year" id="year">
			<input type="hidden" name="education_user_id" id="education_user_id" value="{{auth()->user()->id}}">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" id="close-education-info-btn" class="btn btn-secondary">Close</button>
        <button type="button" class="create-btn" id="update-education-info-btn">Save Changes</button>
      </div>
    </div>
  </div>
</div>
@stop
@section('footer-script')
<script>
	function profileWaitMe(current_effect) {
		$('#updateProfileBtn').waitMe({
			effect: current_effect,
			text: 'Please wait ...',
			bg: 'rgba(255,255,255,0.7)',
			color: '#000',
		});
	}
	$('form[id="updateProfile"]').validate({
        rules: {
            first_name: {
                required: true,
            },
            email: {
                required: true,
                email: true,
            }
        },
        messages: {
            first_name: {
                required: "<span style='color:red'>This field is required</span>",
            },
            email: {
                required: "<span style='color:red'>This field is required</span>",
                email: "<span style='color:red'>Please enter a valid email address</span>",
            }
        },
        submitHandler: function(form) {
		   var data = new FormData(form);
		   profileWaitMe(current_effect);
		   if(!$("#first_name").val()){
				data.append('first_name', $("#first_name").val());
		   }
		   if(!$("#last_name").val()){
				data.append('last_name', $("#last_name").val());
		   }
		   if(!$("#email").val()){
				data.append('email', $("#email").val());
		   }
		   if(!$("#contact_num").val()){
				data.append('contact_num', $("#contact_num").val());
		   }
		   if(!$("#address").val()){
				data.append('address', $("#address").val());
		   }
		   if(!$("#state").val()){
				data.append('state', $("#state").val());
		   }
		   if(!$("#city").val()){
				data.append('city', $("#city").val());
		   }
		   $.ajax({
				url: 'uploadUserData',
				type: 'POST',
				data: data,
				enctype: 'multipart/form-data',
				contentType: false,
				processData: false,
				success: function(response) {
					toastr.success(response);
					$('#updateProfileBtn').waitMe('hide');
					console.log(response);
				},
				error: function() {
					toastr.error("Something Went Wrong");
				} 
			});
			
        }
    });
	$(document).on('click','.open-about-modal-btn',function(e){
		$("#hobbies_interests").val($("#"+$(this).attr('fieldId')).val());
		$("#column_name").val($(this).attr('fieldId'));
		$("#hobbies_interests_title").text($("#"+$(this).attr('mylabel')).text());
		$("#update-about-modal").modal('show');
	});
	$(document).on('click','#about-close-btn',function(){
		$("#update-about-modal").modal('hide');
	});
	$(document).on('click','#update-about-data',function(e){
		MainWaitMe(current_effect);
		var data = {
			column_name: $("#column_name").val(),
			hobbies_interests: $("#hobbies_interests").val(),
			_token: "{{ csrf_token() }}",
		};
		$.ajax({
			type: "POST",
			url: "uploadAboutData",
			data: data,
			success: function(response) {
				$("#update-about-modal").modal('hide');
				$('#master-main-div-id').waitMe('hide');
				$("#"+$("#column_name").val()).val($("#hobbies_interests").val());
				toastr.success(response);
				console.log(response);
			},
			error: function() {
				toastr.error("Something Went Wrong");
			} 
		});
	});
	$(document).on('click','#user-about-info-btn',function(e){
		MainWaitMe(current_effect);
		$("#about_function").val($("#about_function_span").text());
		$("#company").val($("#company_span").text());
		$("#web").val($("#web_span").text());
		$("#member").val($("#member_span").text());
		$("#joining_date").val($("#joining_date_span").text());
		$('#master-main-div-id').waitMe('hide');
		$("#user-about-info-modal").modal('show');
	});
	$(document).on('click','#close-about-info-btn',function(e){
		$("#user-about-info-modal").modal('hide');
	});
	$(document).on('click','#update-about-info-btn',function(e){
		MainWaitMe(current_effect);
		var data = new FormData();
		if($("#about_function").val()){

			data.append('about_function', $("#about_function").val());
		}
		if($("#company").val()){
			data.append('company', $("#company").val());
		}
		if($("#web").val()){
			data.append('web', $("#web").val());
		}
		if($("#member").val()){
			data.append('member', $("#member").val());
		}
		if($("#joining_date").val()){
			data.append('joining_date', $("#joining_date").val());
		}
		data.append('user_id', $("#about_user_id").val());
		data.append('_token', "{{ csrf_token() }}");
		$.ajax({
			type: "POST",
			url: "uploadUserAboutSection",
			data: data,
			contentType: false,
			processData: false,
			success: function(response) {
				$("#about_function_span").text($("#about_function").val());
				$("#company_span").text($("#company").val());
				$("#web_span").text($("#web").val());
				$("#member_span").text($("#member").val());
				$("#joining_date_span").text($("#joining_date").val());
				$("#user-about-info-modal").modal('hide');
				$('#master-main-div-id').waitMe('hide');
				toastr.success(response);
				console.log(response);
			},
			error: function() {
				toastr.error("Something Went Wrong");
			} 
		});
	});
	$(document).on('click','#user-about-info-btn',function(e){
		MainWaitMe(current_effect);

		$("#about_function").val($("#about_function_span").text());
		$("#company").val($("#company_span").text());
		$("#web").val($("#web_span").text());
		$("#member").val($("#member_span").text());
		$("#joining_date").val($("#joining_date_span").text());

		$('#master-main-div-id').waitMe('hide');
		$("#user-about-info-modal").modal('show');
		
	});
	$(document).on('click','#user-education-info-btn',function(e){
		MainWaitMe(current_effect);
		$("#education").val($("#education_span").text());
		$("#institution").val($("#institution_span").text());
		$("#employment").val($("#employment_span").text());
		$("#year").val($("#year_span").text());
		$('#master-main-div-id').waitMe('hide');
		$("#user-education-info-modal").modal('show');
	});
	$(document).on('click','#close-education-info-btn',function(e){
		$("#user-education-info-modal").modal('hide');
	});
	$(document).on('click','#update-education-info-btn',function(e){
		MainWaitMe(current_effect);
		var data = new FormData();
		if($("#education").val()){

			data.append('education', $("#education").val());
		}
		if($("#institution").val()){
			data.append('institution', $("#institution").val());
		}
		if($("#employment").val()){
			data.append('employment', $("#employment").val());
		}
		if($("#year").val()){
			data.append('year', $("#year").val());
		}
		data.append('user_id', $("#education_user_id").val());
		data.append('_token', "{{ csrf_token() }}");
		$.ajax({
			type: "POST",
			url: "uploadUserEducationSection",
			data: data,
			contentType: false,
			processData: false,
			success: function(response) {
				$("#education_span").text($("#education").val());
				$("#institution_span").text($("#institution").val());
				$("#employment_span").text($("#employment").val());
				$("#year_span").text($("#year").val());
				$("#user-education-info-modal").modal('hide');
				$('#master-main-div-id').waitMe('hide');
				toastr.success(response);
				console.log(response);
			},
			error: function() {
				toastr.error("Something Went Wrong");
			} 
		});
	});
</script>
@stop