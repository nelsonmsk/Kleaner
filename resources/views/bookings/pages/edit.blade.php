@extends('bookings.Index')

@section('body')
  <div class="col-lg-8 col-md-10 col-md-offset-2">
    <div class="card">
	   
	<div class="card-header header-primary">
    <h2><span class="card-category">{{ __('Edit Booking') }} </span>
	<a href="{{config('app.url')}}/bookings" class="btn btn-secondary pull-right">View All</a></h2>
    </div>
	
	<div class="card-body">	
		<form class="form-horizontal singleForm" id="bookings-form2" method="post" action="bookings" data-parsley-validate>
			<div class="form-group">
				<input type="hidden" value="{{csrf_token()}}" name="_token" />	
				<input type="hidden" value="{{$booking->id}}" id="id" name="id" />				
				<input type="hidden" value="{{$booking->user_id}}" name="user_id" />				
				<label for="location" class="col-sm-2 control-label">{{ __('Location') }}</label>
				<div class="col-sm-10">
					<input id="location" type="text"  class="form-control" name="location" value="{{$booking->location}}" required/>
				</div>
			</div>
			<div class="form-group">
				<label for="fromDate" class="col-sm-2 control-label">From Date:</label>
				<div class="col-sm-10">
					<input id="fromDate" type="date"  class="form-control" name="fromDate" value="{{$booking->fromDate}}" required />
				</div>
			</div>
			<div class="form-group">
				<label for="fromTime" class="col-sm-2 control-label">From Time:</label>
				<div class="col-sm-10">
					<input id="fromTime" type="time"  class="form-control" name="fromTime" value="{{$booking->fromTime}}" required />
				</div>
			</div>	
			<div class="form-group">
				<label for="toDate" class="col-sm-2 control-label">To Date:</label>
				<div class="col-sm-10">
					<input id="toDate" type="date"  class="form-control" name="toDate" value="{{$booking->toDate}}" required />
				</div>
			</div>
			<div class="form-group">
				<label for="toTime" class="col-sm-2 control-label">To Time:</label>
				<div class="col-sm-10">
					<input id="toTime" type="time"  class="form-control" name="toTime"  value="{{$booking->toTime}}" required />
				</div>
			</div>
		    <div class="form-group">
				<label for="cost" class="col-sm-2 control-label">{{ __('Cost') }}</label>
				<div class="col-sm-10">
					<input class="form-control" name="cost" id="cost" type="text" value="{{$booking->cost}}" required />
				</div>
			</div>
			<div class="form-group">
				<label for="details" class="col-sm-2 control-label">{{ __('Details') }}</label>
				<div class="col-sm-10">
					<textarea id="details" name="details" class="form-control">{{$booking->details}}</textarea>
				</div>
			</div>
			<div class="form-group">
				<label for="status" class="col-sm-2 control-label">{{ __('Status') }}</label>
				<div class="col-sm-10">
				  <input id="status" type="text"  class="form-control" name="status" value="{{$booking->status}}" required />
				</div>
			</div>		
			<div id="b-element" class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-primary btn-lg col-sm-5" id="save-btn" name="Update">Update <div class="fa fa-save text-white"></div></button>
					<a href="{{url()->previous()}}" class="btn btn-danger btn-lg col-sm-5 col-sm-offset-1" id="cancel" name="cancel">{{ __('Cancel') }} <div class="fa fa-close text-white"></div></a>
				</div>
			</div>
		</form> 
	</div> 
</div>
</div>
@endsection
