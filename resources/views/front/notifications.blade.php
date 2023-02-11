@extends('front.master')
@section('title') Messages @stop
@section('main-content')
<section class="event-page-sec-1">
	<div class="container-fluid p-0">
		<div class="dashboard-row">
        <div class="gen-chat-wrap">
					<div class="row">
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
					</div>

					<div class="chat-row notification-page-wrap row">
						<div class="col-lg-12 col-12">
							<h1 class="top-heading">Notification</h1>
							<div class="notification-item">
								<a href="#!" class="notification-box">
									<div class="img-box">
										<img src="{{asset('assetsfront/images/chat-box-img.png')}}" alt="img" class="img-fluid profile-img">
										<div class="abs-icon">
											<img src="{{asset('assetsfront/images/notification-abs-img.png')}}" alt="img">
										</div>
									</div>
									<div class="text-box">
										<h1 class="heading">Adward Douglas</h1>
										<p class="desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor...</p>
										<p class="date-time"><span>Mon</span> at <span>12:30 PM</span> </p>
									</div>
								</a>
								<div class="detail-last-seen">
									<p><span class="online-icon"></span> 01 (min) ago</p>
									<a href="#!" class="see-detail-btn see-more-btn" ><i class="fas fa-ellipsis-v"></i>
										<div class="other-options" >
											<span><button>Move to trash</button></span>	
										</div>
									</a>
								</div>
							</div>

							<div class="notification-item">
								<a href="#!" class="notification-box">
									<div class="img-box">
										<img src="{{asset('assetsfront/images/chat-box-img.png')}}" alt="img" class="img-fluid profile-img">
										<div class="abs-icon">
											<img src="{{asset('assetsfront/images/notification-abs-img.png')}}" alt="img">
										</div>
									</div>
									<div class="text-box">
										<h1 class="heading">Adward Douglas</h1>
										<p class="desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor...</p>
										<p class="date-time"><span>Mon</span> at <span>12:30 PM</span> </p>
									</div>
								</a>
								<div class="detail-last-seen">
									<p><span class="online-icon"></span> 01 (min) ago</p>
									<a href="#!" class="see-detail-btn see-more-btn" ><i class="fas fa-ellipsis-v"></i>
										<div class="other-options" >
											<span><button>Move to trash</button></span>	
										</div>
									</a>
								</div>
							</div>
							<div class="notification-item">
								<a href="#!" class="notification-box">
									<div class="img-box">
										<img src="{{asset('assetsfront/images/chat-box-img.png')}}" alt="img" class="img-fluid profile-img">
										<div class="abs-icon">
											<img src="{{asset('assetsfront/images/notification-abs-img-1.png')}}" alt="img">
										</div>
									</div>
									<div class="text-box">
										<h1 class="heading">Adward Douglas</h1>
										<p class="desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor...</p>
										<p class="date-time"><span>Mon</span> at <span>12:30 PM</span> </p>
									</div>
								</a>
								<div class="detail-last-seen">
									<p><span class="online-icon"></span> 01 (min) ago</p>
									<a href="#!" class="see-detail-btn see-more-btn" ><i class="fas fa-ellipsis-v"></i>
										<div class="other-options" >
											<span><button>Move to trash</button></span>	
										</div>
									</a>
								</div>
							</div>

							<div class="notification-item">
								<a href="#!" class="notification-box">
									<div class="img-box">
										<img src="{{asset('assetsfront/images/chat-box-img.png')}}" alt="img" class="img-fluid profile-img">
										<div class="abs-icon">
											<img src="{{asset('assetsfront/images/notification-abs-img.png')}}" alt="img">
										</div>
									</div>
									<div class="text-box">
										<h1 class="heading">Adward Douglas</h1>
										<p class="desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor...</p>
										<p class="date-time"><span>Mon</span> at <span>12:30 PM</span> </p>
									</div>
								</a>
								<div class="detail-last-seen">
									<p><span class="online-icon"></span> 01 (min) ago</p>
									<a href="#!" class="see-detail-btn see-more-btn" ><i class="fas fa-ellipsis-v"></i>
										<div class="other-options" >
											<span><button>Move to trash</button></span>	
										</div>
									</a>
								</div>
							</div>

							<div class="notification-item">
								<a href="#!" class="notification-box">
									<div class="img-box">
										<img src="{{asset('assetsfront/images/chat-box-img.png')}}" alt="img" class="img-fluid profile-img">
										<div class="abs-icon">
											<img src="{{asset('assetsfront/images/notification-abs-img.png')}}" alt="img">
										</div>
									</div>
									<div class="text-box">
										<h1 class="heading">Adward Douglas</h1>
										<p class="desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor...</p>
										<p class="date-time"><span>Mon</span> at <span>12:30 PM</span> </p>
									</div>
								</a>
								<div class="detail-last-seen">
									<p><span class="online-icon"></span> 01 (min) ago</p>
									<a href="#!" class="see-detail-btn see-more-btn" ><i class="fas fa-ellipsis-v"></i>
										<div class="other-options" >
											<span><button>Move to trash</button></span>	
										</div>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
		</div>
	</div>
</section>
@stop