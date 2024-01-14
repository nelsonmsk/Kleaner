@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">
          <div class="card card-chart">
            <div class="dashboard-card-header card-header-danger">
				<h2>Bookings</h2>
            </div>
            <div class="dashboard-card-body">
              <p class="card-title">Total Bookings.<span class="badge badge-lg header-danger">+ {{$dashboard ?  $dashboard['bookingsTotal']:'0'}}</span></p></br>		  		  
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">Last Updated: </i><span class="tr-danger">  {{$dashboard ?  $dashboard['bookingsUpdate']:'0 weeks ago'}}</span>
              </div>
            </div>			
          </div>
        </div>	  
        <div class="col-md-3 col-sm-3">
          <div class="card card-chart">
            <div class="dashboard-card-header card-header-dark">
              <h2>Services</h2>
            </div>
            <div class="dashboard-card-body">
              <p class="card-title">New Services.<span class="badge badge-lg header-dark">+  {{$dashboard ?  $dashboard['servicesTotal']:'0'}}</span></p></br>
           </div>
			<div class="card-footer">
              <div class="stats">
                <i class="material-icons">Last Updated: </i><span class="tr-dark"> {{$dashboard ?  $dashboard['last_service_update']:'0 days ago'}}</span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-5">
          <div class="card card-chart">
            <div class="dashboard-card-header card-header-primary">
				<h2>Messages</h2>
            </div>
            <div class="dashboard-card-body">
              <p class="card-title">New Messages<span class="badge badge-lg header-primary">+ {{$dashboard ?  $dashboard['messagesTotal']:'0'}} </span></p></br>
			  </div>
			<div class="card-footer">
              <div class="stats">
                <i class="material-icons">Last Received:</i> <span class="tr-primary"> {{$dashboard ?  $dashboard['messagesUpdate']:'0 days ago'}} </span>
              </div>
            </div>  
          </div>
        </div>
        <div class="col-md-3 col-sm-5">
          <div class="card card-chart">
            <div class="dashboard-card-header card-header-success">
				<h2>Promotions</h2>
            </div>
            <div class="dashboard-card-body">
              <p class="card-title">Promotions:<span class="badge badge-lg header-success">+ {{$dashboard ?  $dashboard['mailSubscriptions_total']:'0'}} </span></p></br>
			</div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">Updated:</i> <span class="tr-success"> {{$dashboard ?  $dashboard['mailSubscriptions_update']:'0'}}</span>
              </div>
            </div>			
          </div>
        </div>
    </div>
	  
	  
	   <div class="row ">
        <div class="col-md-4">
          <div class="card card-chart">
            <div class="dashboard-card-header card-header-primary">
              <div class="ct-chart" id="dailySalesChart"></div>
            </div>
	             <div class="dashboard-card-body">
              <h4 class="card-title">Total Messages</h4>
              <p class="card-category text-default">
                <span class=""><i class="fa fa-long-arrow-up"></i>  {{$dashboard ?  $dashboard['msChange']:'0'}} </span>% increase in today messages.</p>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">access_time:</i> updated {{$dashboard ?  $dashboard['mailsubUpdate']:'0 minutes ago'}}
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card card-chart">
            <div class="dashboard-card-header card-header-dark">
              <div class="ct-chart" id="websiteViewsChart"></div>
            </div>
            <div class="dashboard-card-body">
              <h4 class="card-title">Avaliable Services</h4>
              <p class="card-category  text-default">Last Campaign Performance</p>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">access_time:</i>updated  {{$dashboard ?  $dashboard['last_service_update']:'0 days ago'}}
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card card-chart">
            <div class="dashboard-card-header card-header-danger">
              <div class="ct-chart" id="completedTasksChart"></div>
            </div>
            <div class="dashboard-card-body">
              <h4 class="card-title">Completed 	Bookings</h4>
              <p class="card-category  text-default">Last Campaign Performance</p>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">access_time:</i> campaign sent {{$dashboard ?  $dashboard['bcompletedUpdate']:'0 days ago'}} 
              </div>
            </div>
          </div>
        </div>
    </div> 
	  
	    
    </div>  
  </div>
@endsection

@push('js')
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();
    });
  </script>
@endpush