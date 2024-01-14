@extends('bookings.Index')

@section('body')

<div class="col-lg-12 col-md-12">
    <div class="card">
		<div class="card-header header-primary">
		<h2><span class="card-category">{{ __('Booking') }} {{$booking->id }} </span>
		@if(Auth::user()->type == "Admin")
			<a href="{{config('app.url')}}/bookings" class="btn btn-secondary pull-right">View All</a></h2>
		@else
			<a href="{{config('app.url')}}/services" class="btn btn-secondary pull-right">View All</a></h2>
		@endif
		</div>
	
		<div class="card-body">	
	<section id="step-1" class="section-step step-wrap">
		<div class="container step animated" data-animation="bounceInLeft" data-animation-delay="700">
			<div class="row">
				<!-- Step Description Starts -->
				<div class="col-md-8 step-desc">
					
					<div class="col-md-12 step-details">
							<div class="row form-group row-step"><span class="col-md-3"><b>ID:</b></span><span class="col-md-9 form-control text-left"> {{$booking->id}}</span></div>
							<div class="row form-group row-step"><span class="col-md-3"><b>Location:</b></span><span class="col-md-9 form-control text-left"> {{$booking->location}}</span></div>
							<div class="row form-group row-step"><span class="col-md-3"><b>From Date:</b></span><span class="col-md-3 form-control text-left"> {{$booking->fromDate}}</span>
							<span class="col-md-3"><b>From Time:</b></span><span class="col-md-3 form-control text-left"> {{$booking->fromTime}}</span></div>							
							<div class="row form-group row-step"><span class="col-md-3"><b>To Date:</b></span><span class="col-md-3 form-control text-left"> {{$booking->toDate}}</span>							
							<span class="col-md-3"><b>To Time:</b></span><span class="col-md-3 form-control text-left"> {{$booking->toTime}}</span></div>
							<div class="row form-group row-step"><span class="col-md-3"><b>Cost:</b></span><span class="col-md-9 form-control text-left"> {{$booking->cost}}</span></div>
							<div class="row form-group row-step"><span class="col-md-3"><b>Details:</b></span><span class="col-md-9  text-left">{{$booking->details}}</span></div>
							<div class="row form-group row-step"><span class="col-md-3"><b>Status:</b></span><span class="col-md-9 form-control text-left"> {{$booking->status}}</span></div>			
							@if(Auth::user()->type == "admin")
							<div class="row form-group row-step"><span class="col-md-3"><b>User Id:</b></span><span class="col-md-9 form-control text-left"> {{$booking->user_id}}</span></div>		
							@endif
							<div class="row form-group row-step"><span class="col-md-3"><b>Created:</b></span><span class="col-md-9 form-control text-left">{{$booking->created_at}}</span></div>
							<div class="row form-group row-step"><span class="col-md-3"><b>Updated:</b></span><span class="col-md-9 form-control text-left"> {{$booking->updated_at}}</span></div>							
					</div> <!-- End step-details -->
				</div>
				<!-- Step Description Ends -->
				<div class="col-md-4 step-img">
					<img src="../img/note.png" alt="" /> <!-- Step Photo Here -->
				</div>
			</div>
					<div class="row text-center">
					 <a href="{{url()->previous()}}" id="back-btn" class="btn btn-lg-6 btn-default ">
								<div class="fa fa-arrow-left text-white"></div>  Back</a>	
					@if(Auth::user()->type == "Admin")								
					<a href="bookings/{{$booking->id}}"  id="edit-btn" class="btn btn-md-4 btn-primary ">Edit
								<div class="fa fa-edit text-white"></div> </a>					 
					<a href="bookings/{{$booking->id}}"  id="delete-btn" class="btn btn-md-4 btn-danger" action="bookings">Delete
								<div class="fa fa-trash text-white"></div></a>
					@endif
                  </div>			
		</div>
	</section>
		</div> 		   

    </div>
</div>
@endsection