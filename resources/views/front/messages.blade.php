@extends('front.master')
@section('title') Messages @stop
@section('main-content')
<style>
    .right-chat-box .chat-box-header .chat-person, .chat-page-chat-box .chat-box-header .chat-person img {
        max-width: 70px;
        object-fit: cover;
        object-position: center;
        border-radius: 50%;
    }
</style>
<section class="chat-page-sec-1">
	<div class="container-fluid p-0">
		<div class="dashboard-row">
				<div class="gen-chat-wrap w-100">
					<div class="chat-row last-chatting-box row">
						<div class="col-lg-4 col-12">
							<form>
								<div class="form-group">
									<input type="search" name="" placeholder="Search" readonly>
									<a href="#!" class="search-icon"><img src="{{asset('assetsfront/images/search-icon.png')}}"></a>
								</div>
							</form>
							<div class="chatting-box">
							@forelse($friends as $friend)
							<a href="javascript:void(0)" class="chatting-item friends" friend_id="{{$friend->id}}">
								<div class="img-box">
									<?php $p_img = $friend->profile_img??'profile-1.png';?>
									<img src="{{asset('uploads/profile/'.$p_img)}}" alt="img" class="img-fluid">
									<div class="onlines-abs-icon">
									</div>
								</div>
								<div class="text-box">
									<p class="heading"><?= strlen($friend->first_name.' '.$friend->last_name) > 40 ? substr($friend->first_name.' '.$friend->last_name,0,40)."..." : $friend->first_name.' '.$friend->last_name ?></p>
								</div>
								<div class="chat-detail">
								</div>
							</a>
							@empty
							@endforelse
							</div>
						</div>
						<div class="col-lg-8 col-12">
							

							<div class="chat-page-chat-box">
								<div class="chat-box-header">
										<a href="javascript:void(0)" class="chat-person" id="receiver_profile">
											<?php $p_img = auth()->user()->profile_img??'profile-1.png';?>
											<img src="{{asset('uploads/profile/'.$p_img)}}" class="img-fluid" alt="img"> 
											<p class="name">{{ auth()->user()->first_name." ".auth()->user()->last_name }}</p>
										</a>
										<div class="icon-box">
											<!-- <a href="#!"><img src="{{asset('assetsfront/images/right-chat-icon-1.png')}}" class="img-fluid"></a>
											<a href="#!"><img src="{{asset('assetsfront/images/right-chat-icon-2.png')}}" class="img-fluid"></a>
											<a href="settings.php" target="_blank"><img src="{{asset('assetsfront/images/right-chat-icon-3.png')}}" class="img-fluid"></a>
											<a href="#!" class="chat-close"><img src="{{asset('assetsfront/images/right-chat-icon-4.png')}}" class="img-fluid"></a> -->
										</div>
								</div>
								<div class="chat-box-body">
									<div class="messages-box" id="receiver_id_msg">
									<div class="text-center mt-4">Please Click on friend to view chat</div>
									</div>
									<div class="sender-message-box" style="display: none;" id="send_msg_div">
										
										<div class="wrtie-message">
											<form>
												<div class="form-group">
													<input type="hidden" name="receiver_id" id="receiver_id" value="" />
													<textarea cols="3" rows="0" id="sntMsg" placeholder="Type a message"></textarea>
													<a href="javascript:void(0)" class="send-btn" id="add_message">
														<i class="fas fa-paper-plane"></i>
													</a>
												</div>
											</form>
										</div>
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
$('.friends').on('click', function(e) {
	$("#receiver_id").val($(this).attr('friend_id'));
	var receiver_id = $("#receiver_id").val();
	$.ajax({
		url: 'ViewMessages',
		type: 'GET',
		data: {
			receiver_id
		},
		success: function(response) {
			var APP_URL = "<?php echo url('/').'/public'; ?>";
			var profile_image = APP_URL + '/uploads/profile' + "/" + (response.receiver.profile_img ? response.receiver.profile_img : 'profile-1.png');
			var divsToAppend_profile = "";
			divsToAppend_profile += '<img src="' + profile_image + '" alt="icon" class="img-fluid">';
			divsToAppend_profile += '<p class="name">' + response.receiver.first_name + ' ' + response.receiver.last_name + '</p>';
			$("#receiver_profile").empty();
			$("#receiver_profile").html(divsToAppend_profile);
			// console.log(response.view_chats);
			$('#receiver_id_msg').empty();
			if (response.view_chats) {
				console.log(response.view_chats);
				jQuery.each(response.view_chats, function(index, item) {

					console.log(item);

					var image = APP_URL + '/uploads/profile' + "/" + (item.profile_img ? item.profile_img : 'profile-1.png');
					var divsToAppend = "";
					if (response.sender_id == item.sender_id) {
						divsToAppend += '<div class="message sender">';
						divsToAppend += '<div class="img-box">';
						divsToAppend += '<img src="' + image + '" alt="icon" class="profile-img">';
						divsToAppend += '</div>';
						divsToAppend += '<p class="message-content">' + item.message + '</p>';
						divsToAppend += '</div>';
						$('#receiver_id_msg').append(divsToAppend);
					} else {
						divsToAppend += '<div class="message receiver">';
						divsToAppend += '<div class="img-box">';
						divsToAppend += '<img src="' + image + '" alt="icon" class="profile-img">';
						divsToAppend += '</div>';
						divsToAppend += '<p class="message-content">' + item.message + '</p>';
						divsToAppend += '</div>';
						$('#receiver_id_msg').append(divsToAppend);
					}
				});
			}
			$("#send_msg_div").show();
		},
		error: function(jqXHR, textStatus, errorThrown) {
			toastr.error("Something Went Wrong");
		}
	});
});
$("#add_message").click(function() {
	var message = $("#sntMsg").val();
	if (message == "") {
	    toastr.error("Please Type Message");
		return false;
	}
	var receiver_id = $("#receiver_id").val();
	$.ajax({
		url: 'SendMessage',
		type: 'GET',
		data: {
			receiver_id,
			message
		},
		success: function(response) {
			var divsToAppend = "";
			var APP_URL = "<?php echo url('/').'/public'; ?>";
			var image = APP_URL + '/uploads/profile' + "/" + (response.profile_img ? response.profile_img : 'profile-1.png');
			var divsToAppend = "";
			divsToAppend += '<div class="message sender">';
			divsToAppend += '<div class="img-box">';
			divsToAppend += '<img src="' + image + '" alt="icon" class="profile-img">';
			divsToAppend += '</div>';
			divsToAppend += '<p class="message-content">' + response.message + '</p>';
			divsToAppend += '</div>';
			$('#receiver_id_msg').append(divsToAppend);
			$('#receiver_id_msg').scrollTop($('#receiver_id_msg')[0].scrollHeight);
			$("#sntMsg").val('');
		},
		error: function(jqXHR, textStatus, errorThrown) {
			toastr.error("Something Went Wrong");
		}
	});
});
setInterval(ajaxCall, 2000);
function ajaxCall() {
	var receiver_id = $("#receiver_id").val();
	if (!receiver_id) {
		return false;
	}
	$.ajax({
		url: 'ViewMessages',
		type: 'GET',
		data: {
			receiver_id
		},
		success: function(response) {
			var APP_URL = "<?php echo url('/').'/public'; ?>";
			var profile_image = APP_URL + '/uploads/profile' + "/" + (response.receiver.profile_img ? response.receiver.profile_img : 'profile-1.png');
			var divsToAppend_profile = "";
			divsToAppend_profile += '<img src="' + profile_image + '" alt="icon" class="img-fluid">';
			divsToAppend_profile += '<p class="name">' + response.receiver.first_name + ' ' + response.receiver.last_name + '</p>';
			$("#receiver_profile").empty();
			$("#receiver_profile").html(divsToAppend_profile);
			// console.log(response.view_chats);
			$('#receiver_id_msg').empty();
			if (response.view_chats) {
				console.log(response.view_chats);
				jQuery.each(response.view_chats, function(index, item) {

					console.log(item);

					var image = APP_URL + '/uploads/profile' + "/" + (item.profile_img ? item.profile_img : 'profile-1.png');
					var divsToAppend = "";
					if (response.sender_id == item.sender_id) {
						divsToAppend += '<div class="message sender">';
						divsToAppend += '<div class="img-box">';
						divsToAppend += '<img src="' + image + '" alt="icon" class="profile-img">';
						divsToAppend += '</div>';
						divsToAppend += '<p class="message-content">' + item.message + '</p>';
						divsToAppend += '</div>';
						$('#receiver_id_msg').append(divsToAppend);
					} else {
						divsToAppend += '<div class="message receiver">';
						divsToAppend += '<div class="img-box">';
						divsToAppend += '<img src="' + image + '" alt="icon" class="profile-img">';
						divsToAppend += '</div>';
						divsToAppend += '<p class="message-content">' + item.message + '</p>';
						divsToAppend += '</div>';
						$('#receiver_id_msg').append(divsToAppend);
					}
				});
			}
			$("#send_msg_div").show();
			$('#receiver_id_msg').scrollTop($('#receiver_id_msg')[0].scrollHeight);
		},
		error: function(jqXHR, textStatus, errorThrown) {
			toastr.error("Something Went Wrong");
		}
	});
}
</script>
@stop