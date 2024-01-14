@extends('services.Index')

@section('body')
<div class ="col-lg-12 col-md-12 ">
    <div class="card">
	 
		<div class="card-header header-primary">
			<h2><span class="card-category">{{ __('Services') }} </span> 
			@if(Auth::user()->type == "admin")
				<a href="{{config('app.url')}}/services/create" class="btn btn-secondary pull-right">Upload New</a></h2>
			@endif
		</div>

		<div class="card-body">
			<!--------------- Screenshot --------------->
			<div id="gallery" class="section section-padding">
				<div id="screenshot" class="container">
					<section class="pt-6" id="pricingTable">
						<div class="container pricing">
						  <div class="row">
							<div class="col-lg-8 col-xxl-8 text-center mx-auto">
							  <h2>Choose Your Ideal Service Package <div class="header-strips-two"></div></h2>
							  <p class="mb-4">Get the best cleaning services at the price you can afford</p>
							</div>
						  </div>		  
						  <div class="row">
						  @if($serviceTypes->count() != 0)
							  @foreach($serviceTypes as $st)
								<div class="col-sm-6 col-xl-3 mb-3">
								  <div class="card card-span py-4 border-top border-4 border-primary">
									<div class="card-body">
									<a href=""  id="show-btn" class="service-link">
									  <div class="text-center"><span class="flaticon-accounting-1"></span>
										<h5 class="my-3">{{$st->name}}</h5>
										<p>Packages</p>
										<ol class="list-styled">
										@if($services->count() != 0)
										    @foreach($services as $sv)
												@if($serviceCategories->count() != 0)
													@foreach($serviceCategories as $sc)
														@if($sv->type == $st->name && $sv->category ==  $sc->name )
															@if($sv->type == $st->name && $sv->type == "Single")
																<li>{{$sv->name}} <b>${{$sv->cost}}</b> 
																	<a href="#" id="additem-btn" class="btn btn-sm-3 btn-success" item="{{$sv}}"> Add
																	<div class="fa fa-shopping-cart text-white"></div></a></li>	
															@else
																<li>{{$sv->name}}</li><br/>
															@endif
														@endif
													@endforeach
												@else													
														@if($sv->type == $st->name && $sv->type == "Single")
															<li>{{$sv->name}}  <b>${{$sv->cost}}</b></li>
														@else
															<li>{{$sv->name}}</li><br/>
														@endif													
												@endif
											@endforeach
										@endif
										</ol>
									  </div>
									</a>
									</div>
									<div class="border-top bg-white text-center pt-3 pb-0">
									  <div class="d-flex justify-content-center">
									  @if($st->name == 'Single')
										<h3 class="fw-normal">$-.-- </h3>
									  @else
										<h3 class="fw-normal">$ {{$st->cost}}
											<a href="#" id="additem-btn" class="btn btn-md-3 btn-success" item="{{$st}}"}"> Add to Cart
													<div class="fa fa-shopping-cart text-white"></div></a>	</h3>								
									  @endif
									  </div>
									</div>
								  </div>
								</div>								
							  @endforeach
						
						  @else
							<div class="col-sm-6 col-xl-3 mb-3">
							  <div class="card card-span py-4  border-top border-4 border-primary">
								<div class="card-body">
								<a href="services/1"  id="show-btn" class="service-link">
								  <div class="text-center"><span class="flaticon-accountant"></span>
									<h5 class="my-3">SINGLE</h5>
									<p>Separate Single Services</p>
									<ol class="list-styled">
									  <li>Basic House Cleaning <b>$45</b></li>
									  <li>Deep Cleaning <b>$90</b></li>
									  <li>Window Cleaning <b>$60</b></li>
									  <li>Carpet Cleaning <b>$60</b></li>
									  <li>Upholstery Cleaning <b>$86</b></li>									  
									  <li>Pressure Washing <b>$90</b></li>
									  <li>Laundry <b>$40</b></li>
									  <li>Pool Cleaning <b>$65</b></li>
									  <li>Pest Control <b>$95</b></li>									  									  
									  <li>Disinfection &amp Sanitization <b>$50</b></li>									  
									</ol>
								  </div>
								  </a>
								</div>
								<div class="border-top bg-white text-center pt-3 pb-0">
								  <div class="d-flex justify-content-center">
									<h3 class="fw-normal">$--.--</h3>
								  </div>
								</div>
							  </div>
							</div>
							<div class="col-sm-6 col-xl-3 mb-3">
							  <div class="card card-span py-4 border-top border-4 border-primary">
								<div class="card-body">
								  <div class="text-center"><span class="flaticon-accounting-1"></span>
									<h5 class="my-3">BASIC</h5>
									<p>Residential Package</p>
									<ol class="list-styled">
									  <li>Basic House Cleaning </li>
									  <li>Window Cleaning </li>
									  <li>Laundry </li>
									  <li>Disinfection &amp Sanitization </li>									  
									</ol>
								  </div>
								</div>
								<div class="border-top bg-white text-center pt-3 pb-0">
								  <div class="d-flex justify-content-center">
									<h3 class="fw-normal">$399.99</h3>
								  </div>
								</div>
							  </div>
							</div>
							<div class="col-sm-6 col-xl-3 mb-3">
							  <div class="card card-span py-4 border-top border-4 border-primary">
								<div class="card-body">
								  <div class="text-center"><span class="flaticon-wealth"></span>
									<h5 class="my-3">ULTIMATE</h5>
									<p>Residential &amp Commercial Packages</p>
									<ol class="list-styled">
									  <li>Basic House Cleaning </li>
									  <li>Deep Cleaning </li>
									  <li>Window Cleaning </li>
									  <li>Carpet Cleaning </li>
									  <li>Upholstery Cleaning </li>
									  <li>Laundry </li>
									  <li>Pool Cleaning </li>									  
									  <li>Disinfection &amp Sanitization </li>									  
									</ol>
								  </div>
								</div>
								<div class="border-top bg-white text-center pt-3 pb-0">
								  <div class="d-flex justify-content-center">
									<h3 class="fw-normal">$1299.99</h3>
								  </div>
								</div>
							  </div>
							</div>
							<div class="col-sm-6 col-xl-3 mb-3">
							  <div class="card card-span py-4 border-top border-4 border-primary">
								<div class="card-body">
								  <div class="text-center"><span class="flaticon-budget"></span>
									<h5 class="my-3">PREMIUM</h5>
									<p>Commercial Package</p>
									<ol class="list-styled">
									  <li>Deep Cleaning </li>
									  <li>Window Cleaning </li>
									  <li>Carpet Cleaning </li>
									  <li>Upholstery Cleaning </li>									  
									  <li>Pressure Washing </li>
									  <li>Pest Control </li>
									  <li>Disinfection &amp Sanitazation </li>									  
									</ol>
								  </div>
								</div>
								<div class="border-top bg-white text-center pt-3 pb-0">
								  <div class="d-flex justify-content-center">
									<h3 class="fw-normal">$1999.99</h3>
								  </div>
								</div>
							  </div>
							</div>
							@endif
						  </div>
						</div>
						<!-- end of .container-->
					</section>
				</div>
			</div>
        <!-- Screenshot end -->
		</div>
	</div>
</div>
@endsection