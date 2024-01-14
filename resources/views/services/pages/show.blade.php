@extends('services.Index')

@section('body')

<div class="col-lg-8 col-md-10 col-md-offset-2">
    <div class="card">
		<div class="card-header header-primary">
		<h2><span class="card-category">{{ __('Service Booking Form') }}</span>
		<a href="{{config('app.url')}}/services" class="btn btn-secondary pull-right">View All</a></h2>
		</div>
	
		<div class="card-body">	
			<div class="animated" data-animation="bounceInLeft" data-animation-delay="700">					
				<form class="form-horizontal singleForm" id="bookings-form1" method="post" action="bookings" data-parsley-validate>
					<div class="form-group">
						<input type="hidden" value="{{csrf_token()}}" name="_token" />
						<input type="hidden" value="active" id="status" name="status" />		
						<input type="hidden" value="{{$id}}" id="service_id" name="service_id" />
						<label for="location" class="col-sm-2 control-label">{{ __('Location') }}</label>
						<div class="col-sm-10">
							<input id="location" type="text"  class="form-control" name="location"  required />
						</div>
					</div>
					<div class="form-group">
						<label for="fromDate" class="col-sm-2 control-label">From Date:</label>
						<div class="col-sm-4">
							<input id="fromDate" type="date"  class="form-control" name="fromDate" required />
						</div>
						<label for="fromTime" class="col-sm-2 control-label">From Time:</label>
						<div class="col-sm-4">
							<input id="fromTime" type="time"  class="form-control" name="fromTime"  required />
						</div>
					</div>	
					<div class="form-group">
						<label for="toDate" class="col-sm-2 control-label">To Date:</label>
						<div class="col-sm-4">
							<input id="toDate" type="date"  class="form-control" name="toDate" required />
						</div>
						<label for="toTime" class="col-sm-2 control-label">To Time:</label>
						<div class="col-sm-4">
							<input id="toTime" type="time"  class="form-control" name="toTime"  required />
						</div>
					</div>
					<div class="form-group">
						<label for="details" class="col-sm-2 control-label">{{ __('Details') }}</label>
						<div class="form-group col-sm-10 text-left">
						@if($typename != "Singles")
							@if($services->count() != 0)
								@foreach($services as $sv)
								<label class="col-sm-4 control-label">{{$sv->name}} ${{$sv->cost}}</label>
								<div class="col-sm-2">
									<input id="details[]" type="checkbox" name="details[]" class="form-control" value="{{$sv->name}}" />
								</div>
								@endforeach
							@endif
						@else	
							@if($services->count() != 0)
								@foreach($services as $sv)
									
									<span class="col-md-3 text-left"> {{$sv->name}}</span>
									
								@endforeach
							@endif								
						@endif
						</div>
					</div>
					<div class="form-group">
						<label for="cost" class="col-sm-2 control-label">{{ __('Cost') }}</label>
						<div class="col-sm-10">
							<input class="form-control" name="cost" id="cost" type="text" required />
						</div>
					</div>							
				  <div id="b-element" class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
					  <button type="submit" class="btn btn-lg col-sm-3 btn-success" id="save-btn" name="Save">Save <div class="fa fa-save text-white"></div></button>
					  <a href="{{url()->previous()}}" class="btn btn-danger col-sm-3" id="cancel" name="cancel">{{ __('Cancel') }} <div class="fa fa-close text-white"></div></a>
					  <a href="services/{{$service->id}" id="edit-btn" class="btn col-sm-3 btn-primary ">
								 Ts &amp Cs <div class="fa fa-edit text-white"></div> </a>			 

					</div>
				  </div>
				</form> 
				<div class="row text-center">

                </div>			
		    </div>
		</div> 		   

    </div>
</div>
@endsection