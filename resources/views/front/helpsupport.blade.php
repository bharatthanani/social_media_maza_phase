@extends('front.master')
@section('title') Messages @stop
@section('main-content')
<section class="event-page-sec-1">
	<div class="container-fluid p-0">
		
        <div class="help-support-box">
					<h1 class="top-heading">How can we help you?</h1>
					<form>
						<div class="form-group">
							<input type="search" placeholder="Search">
							<a href="#!" class="search-icon"><img src="{{asset('assetsfront/images/search-icon.png')}}"></a>
						</div>
					</form>

					<div class="text-box">
						<h1 class="heading">What's New</h1>

						<div class="accordion" id="accordionFlushExample">
							@forelse($records as $record)
							<div class="accordion-item">
								<h2 class="accordion-header">
									<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-{{$record->id}}" aria-expanded="false" aria-controls="faq-{{$record->id}}">
										<p class="question">{{$record->title??""}}</p>
									</button>
								</h2>
								<div id="faq-{{$record->id}}" class="body-styling accordion-collapse collapse"  data-bs-parent="#accordionFlushExample">
									<div class="accordion-body"><p class="tagline">{{$record->description??""}}</p></div>
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