@extends('bookings.Index')

@section('body')
<div class ="col-lg-12 col-md-12 ">
     <div class="card">
	 
	<div class="card-header header-primary">
		<h2><span class="card-category">{{ __('Bookings') }} </span>
		@if(Auth::user()->type == "Admin")	
		<a href="{{ config('app.url') }}/bookings/create" class="btn btn-secondary pull-right">Create New</a>
		@endif
		</h2>
    </div>

	<div class="card-body">
		<div class =" table-responsive" id = "Rtable">
			<table class="table table-condensed table-striped" >
				<thead>
					<tr class="tr-dark">
					  <th>ID</th>
					  <th>Location</th>
					  <th>From Date</th>
					  <th>From Time</th>
					  <th>To Date</th>
					  <th>To Time</th>	
					  <th>Cost</th>
					  <th>Status</th>
						@if(Auth::user()->type == "Admin")	  
					  <th>User Id</th>
						@endif
					  <th>Actions</th>
					</tr>
				</thead>
				<tbody>
				@if($bookings)
					@foreach($bookings as $bk)
					<tr>
						<td>{{$bk->id}}</td>
						<td>{{$bk->location}}</td>
						<td>{{$bk->fromDate}}</td>
						<td>{{$bk->fromTime}}</td>
						<td>{{$bk->toDate}}</td>
						<td>{{$bk->toTime}}</td>
						<td>{{$bk->cost}}</td>
						<td>{{$bk->status}}</td>	
						@if(Auth::user()->type == "Admin")
						<td>{{$bk->user_id}}</td>		
						@endif
						<td>
							<a href="bookings/{{$bk->id}}"  id="show-btn" class="btn btn-primary ">Show <div class="fa fa-eye text-white"></div></a>
						</td>
					</tr>
					@endforeach
				@else
					<tr>
						<td colspan="10"><p class="errortext">No record present</p></td>
					</tr>
				@endif
				</tbody>
				<tfoot>
					<tr>
						<td colspan="2" class="footnotes"></td>
						<td colspan="4" class="footnotes">{{ $bookings? $bookings->links():'' }}</td>
						<td colspan="2" class="footnotes"><span>Current Page:{{ $bookings? $bookings->currentPage():''}}</span></td>
					</tr>
				</tfoot>
			</table>
		</div>   
	</div>
</div>
</div>
@endsection