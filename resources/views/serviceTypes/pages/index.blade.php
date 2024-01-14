@extends('serviceTypes.Index')

@section('body')
<div class ="col-lg-12 col-md-12 ">
     <div class="card">
	 
	<div class="card-header header-danger">
    <h2><span class="card-category">{{ __('ServiceTypes') }} </span> 
    <a href="{{config('app.url')}}/serviceTypes/create" class="btn btn-secondary pull-right">Create New</a></h2>
    </div>

	<div class="card-body">
		<div class ="table-responsive" id = "Stable">
			@if($serviceTypes)
				<table class="table table-condensed table-striped" >	
					<thead>
						<tr class="tr-danger">
						  <th>ID</th>
						  <th>Name</th>	
						  <th>Cost</th>							  
						  <th >Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach($serviceTypes as $st)
						<tr>
							<td>{{$st->id}}</td>
							<td>{{$st->name}}</td>	
							<td>{{$st->cost}}</td>								
							<td>
								<a href="serviceTypes/{{$st->id}}"  id="show-btn" class="btn btn-primary ">Show <div class="fa fa-eye text-white"></div></a>
							</td>
						</tr>
						@endforeach	
					</tbody>
					<tfoot>
						<tr>
							<td colspan="1" class="footnotes"></td>
							<td colspan="1" class="footnotes">{{ $serviceTypes->links() }}</td>
							<td colspan="1" class="footnotes"><span>Current Page:{{ $serviceTypes->currentPage()}}</span></td>
						</tr>
					</tfoot>
				</table>
			@else	
				<div class="row">
					<h2>No ServiceTypes Found</h2>
				</div>
			@endif	
		</div>   
	</div>
</div>
</div>
@endsection