@extends('services.Index')

@section('body')

  <div class="col-lg-8 col-md-10 col-md-offset-2">
    <div class="card">
	   
	<div class="card-header header-danger">
    <h2><span class="card-category">{{ __('Edit Service') }} </span>
	<a href="{{config('app.url')}}/services" class="btn btn-secondary pull-right">View All</a></h2>
    </div>
	
	<div class="card-body">	
		<form class="form-horizontal singleForm" id="services-form2" method="post" action="services" data-parsley-validate>
			<div class="form-group">
				<input type="hidden" value="{{csrf_token()}}" name="_token" />	  
				<input type="hidden" id="id" value="{{$service->id}}" name="id" />			   
				<input type="hidden" id="username" value="{{$service->username}}" name="username" />			     
				<label for="type" class="col-sm-2 control-label">Type:</label>
				<div class="col-sm-10">
					<input id="type" type="text"  class="form-control" name="type" value="{{$service->type}}" required />
				</div>
			</div>
			<div class="form-group">
				<label for="category" class="col-sm-2 control-label">Category:</label>
				<div class="col-sm-10">
					<input id="category" type="text"  class="form-control" name="category" value="{{$service->category}}" required />
				</div>
			</div>
			<div class="form-group">
				<label for="name" class="col-sm-2 control-label">Name:</label>
				<div class="col-sm-10">
					<input id="name" type="text"  class="form-control" name="name" value="{{$service->name}}" required />
				</div>
			</div>
			<div class="form-group">
				<label for="description" class="col-sm-2 control-label">Description:</label>
				<div class="col-sm-10">
					<textarea id="description" type="text"  class="form-control" name="description">{{$service->description}}</textarea>
				</div>
			</div>
			<div class="form-group">      
				<label for="details" class="col-sm-2 control-label">Details:</label>
				<div class="col-sm-10">
					<textarea id="details" type="text"  class="form-control" name="details"> {{$service->details}}</textarea>
				</div>
			</div>		  
			<div class="form-group">
				<label for="cost" class="col-sm-2 control-label">Cost:</label>
				<div class="col-sm-10">
					<input id="cost" type="text"  class="form-control" name="cost" value="{{$service->cost}}" required />
				</div>
			</div>  
			<div id="b-element" class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-primary btn-lg col-sm-5" id="save-btn" name="Update">Update <div class="fa fa-save text-white"></div></button>
					<a href="{{url()->previous()}}" class="btn btn-danger btn-lg col-sm-5 col-sm-offset-1" id="cancel" name="cancel">Cancel <div class="fa fa-close text-white"></div></a>
				</div>
			</div>
		</form> 
	</div> 
</div>
</div>
@endsection
