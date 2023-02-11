@extends('front.master')
@section('title') Messages @stop
@section('main-content')
<section class="dashboard-sec">
	<div class="container-fluid p-0">
		<div class="dashboard-row">
			<div class="privacy-policy">
				<h1 class="heading">Privacy Policy</h1>
				<div class="text-box">
					<h1 class="sub-heading"> <i class="fas fa-circle"></i> {{$record->heading_1??""}}</h1>
					<p class="desc">{{$record->heading_1_des??""}}</p>
				</div>
				<div class="text-box">
					<h1 class="sub-heading"> <i class="fas fa-circle"></i> {{$record->heading_2??""}}</h1>
					<p class="desc">{{$record->heading_2_des??""}}</p>
				</div>
				<button class="act-btn">Understood</button>
			</div>
		</div>
	</div>
</section>
@stop