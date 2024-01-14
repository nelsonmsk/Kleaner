@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'checkoutCart','titlePage' => __('checkoutCart')])

@section('content')

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container dark-bg">
        <h2>Cart Check-Out</h2>
      </div>
    </section>
	<!-- End Breadcrumbs -->
	<!-- ======= Shopping Cart Section ======= -->
	<section class="h-custom checkout-section" id="cart-checkout" style="background-color: #eee;">
	  <div class="container py-5 ">
		<div class="row d-flex justify-content-center align-items-center h-100">
		  <div class="col">
			<div class="card">
			  <div class="card-body p-4">

				<div class="row checkout">

				  <div class="col-lg-7">
					<h5 class="mb-3"><a href="{{url()->previous()}}" class="checkout-head text-body"><i
						  class="fas fa-long-arrow-alt-left me-2"></i> Back to Cart</a></h5>
					<hr>

					<div class="d-flex justify-content-between align-items-center mb-4">
					  <div>
						<p class="mb-0 checkout-header">Service Booking Form</p>
					  </div>
					</div>
					<div class="card mb-3 checkout-body">
						<form class="form-horizontal singleForm" id="checkoutCart-form" method="post" action="clients" data-parsley-validate>
							<div class="form-group">
								<input type="hidden" value="{{csrf_token()}}" name="_token" />							
								<label for="fromdate" class="col-sm-2 control-label">From Date:</label>
								<div class="col-sm-4">
								  <input id="fromdate" type="date"  class="form-control" name="fromdate"  required >
								</div>
								  <label for="todate" class="col-sm-2 control-label">To Date:</label>
								<div class="col-sm-4">
								  <input id="todate" type="date"  class="form-control" name="todate"  required >
								</div>
							</div>
							<div class="form-group">
								<label for="fromtime" class="col-sm-2 control-label">From Time:</label>
								<div class="col-sm-4">
								  <input id="fromtime" type="time"  class="form-control" name="fromtime"  required >
								</div>
								  <label for="totime" class="col-sm-2 control-label">To Time:</label>
								<div class="col-sm-4">
								  <input id="totime" type="time"  class="form-control" name="totime"  required >
								</div>
							</div>							
							<div class="form-group">	
							  <label class="col-sm-2 control-label">{{ __('Address') }}</label>
							  <div class="col-sm-10">
								  <textarea id="address" name="address" class="form-control" required></textarea>
							</div>
						  </div>
							<div class="form-group">
								<label for="city" class="col-sm-2 control-label">{{ __('City') }}</label>
								<div class="col-sm-10">
								  <input id="city" type="text"  class="form-control" name="city" required>
								</div>
							</div>	
							<hr>
							<div class="form-group">
								<label class="col-sm-12 req-label">{{ __('Special Requests') }}</label>
							</div>								
							<div class="form-group">
							  <label for="requests" class="col-sm-2 control-label"></label>
							  <div class="col-sm-10">
								  <textarea id="requests" name="requests" class="form-control"></textarea>
							  </div>	
						    </div>
							<div id="b-element" class="form-group text-center">
								
								<a href="#"  id="contract-btn" class="btn btn-success text-white "> View Terms & Conditions   <div class="fa fa-list-ul text-white"></div></a>
							</div>	
							<div class="form-group">
							  <label class="control-label col-sm-8 label-mr">
								<input class="form-check-input" type="checkbox" name="terms" {{ old('terms') ? 'checked' : '' }}> {{ __('I accept all of the Terms and Conditions') }}
								<span class="form-check-sign">
								  <span class="check"></span>
								</span>
							  </label>
							</div>
					  </form> 					
					</div>
				  </div>
				  <div class="col-lg-5">

					<div class="card bg-primary text-white rounded-3">
					  <div class="card-body card-info">
						<div class="d-flex align-items-center mb-4">
						  <h5 class="mb-0 card-details">Card Details</h5>
						</div>

						<p class="small mb-2">Card Type</p>
						<a href="#!" type="submit" class="text-white"><i
							class="fab fa-cc-mastercard fa-2x me-2"></i></a>
						<a href="#!" type="submit" class="text-white"><i
							class="fab fa-cc-visa fa-2x me-2"></i></a>
						<a href="#!" type="submit" class="text-white"><i
							class="fab fa-cc-amex fa-2x me-2"></i></a>
						<a href="#!" type="submit" class="text-white"><i class="fab fa-cc-paypal fa-2x"></i></a>

						<form class="mt-4">
						  <div class="form-outline form-white mb-4">
							<input type="text" id="typeName" class="form-control form-control-lg" size="17"
							  placeholder="Cardholder's Name" />
							<label class="form-label" for="typeName">Cardholder's Name</label>
						  </div>

						  <div class="form-outline form-white mb-4">
							<input type="text" id="typeText" class="form-control form-control-lg" size="17"
							  placeholder="1234 5678 9012 3457" minlength="19" maxlength="19" />
							<label class="form-label" for="typeText">Card Number</label>
						  </div>

						  <div class="row mb-4">
							<div class="col-md-6">
							  <div class="form-outline form-white">
								<input type="text" id="typeExp" class="form-control form-control-lg"
								  placeholder="MM/YYYY" size="7" minlength="7" maxlength="7" />
								<label class="form-label" for="typeExp">Expiration</label>
							  </div>
							</div>
							<div class="col-md-6">
							  <div class="form-outline form-white">
								<input type="password" id="typePassword" class="form-control form-control-lg"
								  placeholder="&#9679;&#9679;&#9679;" size="1" minlength="3" maxlength="3" />
								<label class="form-label" for="typePassword">Cvv</label>
							  </div>
							</div>
						  </div>

						</form>

						<hr class="my-4">

						<div class="d-flex justify-content-between">
						  <p class="mb-2">Subtotal</p>
						  <p class="mb-2 cart-subtotal"></p>
						</div>

						<div class="d-flex justify-content-between">
						  <p class="mb-2">Delivery</p>
						  <p class="mb-2 cart-delivery"></p>
						</div>

						<div class="d-flex justify-content-between mb-4">
						  <p class="mb-2">Total(Incl. taxes)</p>
						  <p class="mb-2 cart-totalinc"></p>
						</div>

						<button type="button" type="submit" id="btn-process-checkout" item="cart" class="btn btn-info btn-block btn-lg">
						  <div class="d-flex justify-content-between">
							<span>Process <i class="fas fa-long-arrow-alt-right ms-2"></i></span>
						  </div>
						</button>

					  </div>
					</div>

				  </div>

				</div>

			  </div>
			</div>
		  </div>
		</div>
	  </div>
	</section>
<!-- End Shopping Cart Section --> 
@endsection 