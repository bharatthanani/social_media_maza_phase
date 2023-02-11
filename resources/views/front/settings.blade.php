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

					<div class="chat-row row">
						<div class="col-lg-12 col-12">
							<h1 class="top-heading">Settings</h1>
							<div class="setting-box">
								<div class="row">
									<div class="col-lg-4 col-md-6 col-sm-6 col-12">
										<a href="{{route('editprofile')}}" class="setting-item">
											<span class="setting-type-wrap">
												<span class="icon-box">
													<img src="{{asset('assetsfront/images/setting-icon-1.png')}}">
												</span>
												<h1 class="setting-type">Accounts</h1>
											</span>
											<p>></p>
										</a>
									</div>
									<div class="col-lg-4 col-md-6 col-sm-6 col-12">
										<a href="{{route('privacypolicy')}}" class="setting-item">
											<span class="setting-type-wrap">
												<span class="icon-box">
													<img src="{{asset('assetsfront/images/setting-icon-2.png')}}">
												</span>
												<h1 class="setting-type">Privacy & Security</h1>
											</span>
											<p>></p>
										</a>
									</div>
									<div class="col-lg-4 col-md-6 col-sm-6 col-12">
										<a href="{{route('helpsupport')}}" class="setting-item">
											<span class="setting-type-wrap">
												<span class="icon-box">
													<img src="{{asset('assetsfront/images/setting-icon-5.png')}}">
												</span>
												<h1 class="setting-type">Help & Support</h1>
											</span>
											<p>></p>
										</a>
									</div>
									<div class="col-lg-4 col-md-6 col-sm-6 col-12">
										<a href="{{route('editprofile')}}" class="setting-item mb-0">
											<span class="setting-type-wrap">
												<span class="icon-box">
													<img src="{{asset('assetsfront/images/setting-icon-6.png')}}">
												</span>
												<h1 class="setting-type">About</h1>
											</span>
											<p>></p>
										</a>
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