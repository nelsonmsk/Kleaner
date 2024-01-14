<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Response;
use Auth;
use Carbon\Carbon;

use App\Models\MailSubscription;
use App\Models\MailPost;
use App\Models\Message;
use App\Models\Service;
use App\Models\ServiceType;
use App\Models\Booking;
use App\Models\AppDefaults;
use App\Models\User;
use App\Models\Newsletter;


class DashboardController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
      try{

	/** Dashboard Banner Info  **/
		
		 $date = Date("Y-m-d");		  
		 //  Carbon::now()->subMinutes(2)->locale('en_US')->diffForHumans; // '2 minutes ago'
		 
			//Get Booking total count
			$bookingsTotal = Booking::count();
			//Get Booking Update diffInWeeks
			$bookings_update = Booking::max('created_at');	
			$bookings_update_diff  = Carbon::createFromDate($bookings_update)->diffInWeeks();
				if($bookings_update_diff < 2 ){
					$bookings_update_diff2  = Carbon::createFromDate($bookings_update)->diffInDays();
						if($bookings_update_diff2 < 2 ){
							$bookings_update_diff3  = Carbon::createFromDate($bookings_update)->diffInHours();
								if($bookings_update_diff3 < 2 ){
										$bookings_update_diff4  = Carbon::createFromDate($bookings_update)->diffInMinutes();
										$bookingsUpdate = $bookings_update_diff4. ' mins ago';										
								}else{
									$bookingsUpdate = $bookings_update_diff3. ' hours ago';									
								}							
														
						}else{	
							$bookingsUpdate = $bookings_update_diff2. ' days ago';
						}	
				}else{
					$bookingsUpdate = $bookings_update_diff. ' weeks ago';
				}	
			//Get Booking Completed Update diffInWeeks
			$bookings_completed = Booking::where('status', 'completed')
											->max('updated_at');
			$bcompleted_update_diff  = Carbon::createFromDate($bookings_completed)->diffInWeeks();
				if($bcompleted_update_diff < 2 ){
					$bcompleted_update_diff2  = Carbon::createFromDate($bookings_completed)->diffInDays();
						if($bcompleted_update_diff2 < 2 ){
							$bcompleted_update_diff3  = Carbon::createFromDate($bookings_completed)->diffInHours();
								if($bcompleted_update_diff3 < 2 ){
										$bcompleted_update_diff4  = Carbon::createFromDate($bookings_completed)->diffInMinutes();
										$bcompletedUpdate = $bcompleted_update_diff4. ' mins ago';										
								}else{
									$bcompletedUpdate = $bcompleted_update_diff3. ' hours ago';									
								}							
														
						}else{	
							$bcompletedUpdate = $bcompleted_update_diff2. ' days ago';
						}	
				}else{
					$bcompletedUpdate = $bcompleted_update_diff. ' weeks ago';
				}											
			$bookingsActive = Booking::where('status', 'active')
												->whereDate('fromDate', $date)	
												->count();				
			$bookingsProcessing = Booking::where('status', 'processing')
												->whereDate('fromDate', $date)	
												->count();		 


			//No: services in the database
			$servicesTotal = Service::all()	->count();
			//Last services data update diffInDays
			$service_update = Service::max('created_at');												
			$service_update_diff = Carbon::createFromDate($service_update)->diffInWeeks(); 
				if($service_update_diff < 2 ){
					$service_update_diff2  = Carbon::createFromDate($service_update)->diffInDays();
						if($service_update_diff2 < 2 ){
							$service_update_diff3  = Carbon::createFromDate($service_update)->diffInHours();
								if($service_update_diff3 < 2 ){
										$service_update_diff4  = Carbon::createFromDate($service_update)->diffInMinutes();
										$last_service_update = $service_update_diff4. ' mins ago';										
								}else{
									$last_service_update = $service_update_diff3. ' hours ago';									
								}							  							
						}else{	
							$last_service_update = $service_update_diff2. ' days ago';
						}	
				}else{
					$last_service_update = $service_update_diff. ' weeks ago';
				}
	
	
			//Get New Messages Total count
			$messagesTotal = Message::whereDate('created_at', $date)
									->count();		
			//Get Messages Last created time						
			$messages_update = Message::max('created_at');									
			$messages_update_diff  = Carbon::createFromDate($messages_update)->diffInDays();	
				if($messages_update_diff < 2 ){
					$messages_update_diff2  = Carbon::createFromDate($messages_update)->diffInHours();
						if($messages_update_diff2 < 2 ){
							$messages_update_diff3  = Carbon::createFromDate($messages_update)->diffInMinutes();
							$messagesUpdate = $messages_update_diff3. ' mins ago';							
						}else{	
							$messagesUpdate = $messages_update_diff2. ' hours ago';
						}	
				}else{
					$messagesUpdate = $messages_update_diff. ' days ago';
				}


	
			//Get New Subscribers Total count
			$mailSubscriptions_total = MailSubscription::whereDate('created_at', $date)
											->count(); 	
			//Get Last Update time
			$mailSubscriptions_update = MailSubscription::max('created_at');
			$mailSubscriptionsCancelled = MailSubscription::where('status', 'cancelled')
												->whereDate('created_at', $date)											
												->count();									
			$mailSubscriptionsActive = MailSubscription::where('status', 'active')
												->whereDate('created_at', $date)	
												->count();
			//Calculate the % change in the no: of mailsubscriptions
			$d0 = Carbon::now();
			$ms0 = MailSubscription::whereDate('created_at', $d0)
									->count();
			$d1 = Carbon::now()->subDay(1);								
			$ms1 = MailSubscription::whereDate('created_at', $d1)
									->count();						
				if ($ms0 == 0 && $ms1 == 0)	{
					$msChange = 0;
				}else{
					$msChange = ($ms0 /($ms0 + $ms1) ) * 100 ; 									
				}
			//Get MailSubscriptions Last updated time						
			$mailsub_update = MailSubscription::where(function ($query) {
												$query->where('status','processing')
													->orWhere('status', 'active');
												})->max('created_at');									
			$mailsub_update_diff  = Carbon::createFromDate($mailsub_update)->diffInDays();	
				if($mailsub_update_diff < 2 ){
					$mailsub_update_diff2  = Carbon::createFromDate($mailsub_update)->diffInHours();
						if($mailsub_update_diff2 < 2 ){
							$mailsub_update_diff3  = Carbon::createFromDate($mailsub_update)->diffInMinutes();
							$mailsubUpdate = $mailsub_update_diff3. ' mins ago';							
						}else{	
							$mailsubUpdate = $mailsub_update_diff2. ' hours ago';
						}	
				}else{
					$mailsubUpdate = $mailsub_update_diff. ' days ago';
				}				
				
			//Get Newsletters sent to subscribers this month
			$this_month = Carbon::now()->month;
			$newsletters = Newsletter::where('status','sent')
									  ->whereMonth('published_date',$this_month)
									  ->get();
									  
		/** Dashboard Banner Info ends here **/		


		/**Booking Line Chart & MailSubscription Bar Chart **/
			$fDate = Carbon::now();
			$tDate = Carbon::now()->subMonth(5);			
			$bokCompleted = Booking::whereBetween('created_at', [$tDate, $fDate])
						->where('status','completed')
						->count();	
			$bokActive = Booking::whereBetween('fromDate', [$tDate, $fDate])
						->where('status','active')
						->count();	
			$bokProcessing = Booking::whereBetween('fromDate', [$tDate, $fDate])
						->where('status','processing')
						->count();
			$bokCancelled = Booking::whereBetween('fromDate', [$tDate, $fDate])
						->where('status','cancelled')
						->count();	
						

		/** Detailed Report ClientsChart Info  **/
		
			//Get All Service Types 
			$serviceTypes = ServiceType::all();		
			//Get Service Types total count
			$serviceTypesTotal = ServiceType::count();
			//Get ServiceTypesData
			$serviceTypesData = [];	
			$servPercentage = [];
			$serviceColor = [];
			$sColor = ['bg-primary','bg-warning','bg-info','bg-danger','bg-success','bg-primary','bg-warning','bg-info','bg-danger','bg-success'];
			if($serviceTypesTotal != 0 ){
				$i = 0;
				foreach($serviceTypes as $st){					
					$serviceTypesData[$st->name] = Service::where('type', $st->name)
										->count();
					if($serviceTypesTotal == 0 ){
						$servPercentage[$st->name] = 0;
					}else{
						$servPercentage[$st->name] = $serviceTypesData[$st->name] / $servicesTotal * 100;						
					}
					$serviceColor[$st->name] = $sColor[$i];
					$i++;
				}
			}
		
		/** Detailed Report BookingsChart Info  **/
			//Get Booking total count
			$bookingsTotal = Booking::count();	
			//Get All Bookings By Status Type
			$bookingsbyStatus = Booking::select('status')->distinct()->get();
			$bookingsbyStatusTotal = Booking::select('status')->distinct()->count();	
			$bokPercentage = [];			
			$bookingsColor = [];
			$statusNames = [];
			$bookingsperStatus =[];
			$bColor = ['bg-primary','bg-warning','bg-info','bg-danger','bg-success','bg-primary','bg-warning','bg-info','bg-danger','bg-success'];
			if($bookingsTotal != 0 ){
				$i = 0;
				foreach($bookingsbyStatus as $bs){					
					$bookingsperStatus[$bs->status] = Booking::where('status', $bs->status)
										->count();
					if($bookingsTotal == 0 ){
						$bokPercentage[$bs->status] = 0;
					}else{
						$bokPercentage[$bs->status] = $bookingsperStatus[$bs->status] / $bookingsTotal * 100;						
					}										
					$bookingsColor[$bs->status] = $bColor[$i];
					$statusNames[$bs->status] = $bs->status;
					$i++;
				}
			}				

				
			$dashboard = [
				'servicesTotal' => $servicesTotal,
				'last_service_update' => $last_service_update,				
				'messagesTotal' => $messagesTotal,
				'messagesUpdate' => $messagesUpdate,
				'mailSubscriptions_total' => $mailSubscriptions_total,
				'mailSubscriptions_update' => $mailSubscriptions_update,	
				'mailSubscriptionsActive' => $mailSubscriptionsActive,
				'mailsubUpdate' => $mailsubUpdate,
				'bookingsTotal' => $bookingsTotal,
				'bookingsUpdate' => $bookingsUpdate,	
				'bcompletedUpdate' => $bcompletedUpdate,
				'bookingsProcessing' => $bookingsProcessing,
				'msChange' => $msChange,
				'bokCompleted' => $bokCompleted,
				'bokActive' => $bokActive,
				'bokProcessing' => $bokProcessing,
				'bokCancelled' => $bokCancelled,
				'serviceTypesData' => $serviceTypesData,
				'serviceTypesTotal' => $serviceTypesTotal,
				'serviceTypes' => $serviceTypes,
				'servPercentage' => $servPercentage, 
				'serviceColor' => $serviceColor,
				'bookingsTotal' => $bookingsTotal,
				'bookingsbyStatus' => $bookingsbyStatus,
				'bookingsbyStatusTotal' => $bookingsbyStatusTotal,
				'bookingsperStatus' => $bookingsperStatus,
				'bokPercentage' => $bokPercentage, 
				'bookingsColor' => $bookingsColor,
			];
		$status = '200';
			return View('dashboard',compact('dashboard','newsletters','status'));
			
		}catch(Exception $e){

			$response = Response::json(['error' => ['message' => 'Dashboard cannot be found.'] ], 404);	
			return 	$response;
	   } 
   }
   
   
    public function getView()
    {
		try{
			
		/**
		*** Total Bookings Line Chart & Mail Subscriptions Bar Chart ***
		**/
		
			//Get New Subscribers Daily Total count
			$sm = [];
			$d0 = Carbon::now()->month;
			$sm[0] = Carbon::createFromDate($d0)->month;
			$msa0 = MailSubscription::whereMonth('created_at', $sm[0])
									->where('status','active')
									->count();
			$msc0 = MailSubscription::whereMonth('created_at', $sm[0])
									->where('status','cancelled')
									->count();									
			$d1 = Carbon::now()->subMonth(1);			
			$sm[1] = Carbon::createFromDate($d1)->month;			
			$msa1 = MailSubscription::whereMonth('created_at', $sm[1])
									->where('status','active')
									->count();
			$msc1 = MailSubscription::whereMonth('created_at', $sm[1])
									->where('status','cancelled')
									->count();
			$d2 = Carbon::now()->subMonth(2);
			$sm[2] = Carbon::createFromDate($d2)->month;
			$msa2 = MailSubscription::whereMonth('created_at', $sm[2])
									->where('status','active')
									->count();
			$msc2 = MailSubscription::whereMonth('created_at', $sm[2])
									->where('status','cancelled')
									->count();									
			$d3 = Carbon::now()->subMonth(3);
			$sm[3] = Carbon::createFromDate($d3)->month;			
			$msa3 = MailSubscription::whereMonth('created_at', $sm[3])
									->where('status','active')
									->count();
			$msc3 = MailSubscription::whereMonth('created_at', $sm[3])
									->where('status','cancelled')
									->count();									
			$d4 = Carbon::now()->subMonth(4);
			$sm[4] = Carbon::createFromDate($d4)->month;
			$msa4 = MailSubscription::whereMonth('created_at', $sm[4])
									->where('status','active')
									->count();
			$msc4 = MailSubscription::whereMonth('created_at', $sm[4])
									->where('status','cancelled')
									->count();									
			$d5 = Carbon::now()->subMonth(5);	
			$sm[5] = Carbon::createFromDate($d5)->month;			
			$msa5 = MailSubscription::whereMonth('created_at', $sm[5])
									->where('status','active')
									->count();	
			$msc5 = MailSubscription::whereMonth('created_at', $sm[5])
									->where('status','cancelled')
									->count();	
			$mon = [];
			for($p=0; $p < 6; $p++){
				$month = $sm[$p];
			    switch ($month) //make url from form-id 
					{
						case "1":{$mon[$p] = "Jan";}
							break;
						case "2":{$mon[$p] = "Feb";}
							break;
						case "3":{$mon[$p] = "Mar";}
							break;
						case "4":{$mon[$p] = "Apr";}
							break;
						case "5":{$mon[$p] = "May";}
							break;
						case "6":{$mon[$p] = "Jun";}
							break;
						case "7":{$mon[$p] = "Jul";}
							break;
						case "8":{$mon[$p] = "Aug";}
							break;
						case "9":{$mon[$p] = "Sep";}
							break;
						case "10":{$mon[$p] = "Oct";}
							break;
						case "11":{$mon[$p] = "Nov";}
							break;
						case "12":{$mon[$p] = "Dec";}
							break;
					}
			}
			$msData = [
				'sm0' => $mon[0],'sm1' => $mon[1],'sm2' => $mon[2],'sm3' => $mon[3],'sm4' => $mon[4],'sm5' => $mon[5],			
				'msa0' => $msa0,'msa1' => $msa1,'msa2' => $msa2,'msa3' => $msa3,'msa4' => $msa4,'msa5' => $msa5,
				'msc0' => $msc0,'msc1' => $msc1,'msc2' => $msc2,'msc3' => $msc3,'msc4' => $msc4,'msc5' => $msc5,
			];
			  
			//Get Bookings Monthly Total Count by Status			  
			$m0 = Carbon::now()->month;
			$pc0 = Booking::whereMonth('fromDate', $m0)
						->where('status','completed')
						->count();	
			$pi0 = Booking::whereMonth('fromDate', $m0)
						->where('status','active')
						->count();	
			$pp0 = Booking::whereMonth('fromDate', $m0)
						->where('status','processing')
						->count();
			$pa0 = Booking::whereMonth('fromDate', $m0)
						->where('status','cancelled')
						->count();	
						
			$pd1 = Carbon::now()->subMonth(1);
			$m1 = Carbon::createFromDate($pd1)->month;			
			$pc1 = Booking::whereMonth('fromDate', $m1)
						->where('status','completed')
						->count();	
			$pi1 = Booking::whereMonth('fromDate', $m1)
						->where('status','active')
						->count();	
			$pp1 = Booking::whereMonth('fromDate', $m1)
						->where('status','processing')
						->count();	
			$pa1 = Booking::whereMonth('fromDate', $m1)
						->where('status','cancelled')
						->count();	
						
			$pd2 = Carbon::now()->subMonth(2);
			$m2 = Carbon::createFromDate($pd2)->month;			
			$pc2 = Booking::whereMonth('fromDate', $m2)
						->where('status','completed')
						->count();
			$pi2 = Booking::whereMonth('fromDate', $m2)
						->where('status','active')
						->count();
			$pp2 = Booking::whereMonth('fromDate', $m2)
						->where('status','processing')
						->count();
			$pa2 = Booking::whereMonth('fromDate', $m2)
						->where('status','cancelled')
						->count();			
						
			$pd3 = Carbon::now()->subMonth(3);	
			$m3 = Carbon::createFromDate($pd3)->month;			
			$pc3 = Booking::whereMonth('fromDate', $m3)
						->where('status','completed')
						->count();	
			$pi3 = Booking::whereMonth('fromDate', $m3)
						->where('status','active')
						->count();	
			$pp3 = Booking::whereMonth('fromDate', $m3)
						->where('status','processing')
						->count();	
			$pa3 = Booking::whereMonth('fromDate', $m3)
						->where('status','cancelled')
						->count();	
						
			$pd4 = Carbon::now()->subMonth(4);
			$m4 = Carbon::createFromDate($pd4)->month;			
			$pc4 = Booking::whereMonth('fromDate', $m4)
						->where('status','completed')			
						->count();
			$pi4 = Booking::whereMonth('fromDate', $m4)
						->where('status','active')			
						->count();
			$pp4 = Booking::whereMonth('fromDate', $m4)
						->where('status','processing')			
						->count();
			$pa4 = Booking::whereMonth('fromDate', $m4)
						->where('status','cancelled')			
						->count();
						
			$pd5 = Carbon::now()->subMonth(5);	
			$m5 = Carbon::createFromDate($pd5)->month;			
			$pc5 = Booking::whereMonth('fromDate', $m5)
						->where('status','completed')			
						->count();
			$pi5 = Booking::whereMonth('fromDate', $m5)
						->where('status','active')			
						->count();
			$pp5 = Booking::whereMonth('fromDate', $m5)
						->where('status','processing')			
						->count();						
			$pa5 = Booking::whereMonth('fromDate', $m5)
						->where('status','cancelled')			
						->count();						
					
			$pData = [
				'pc0' => $pc0,'pi0' => $pi0,'pp0' => $pp0,'pa0' => $pa0,'m0' => $m0,
				'pc1' => $pc1,'pi1' => $pi1,'pp1' => $pp1,'pa1' => $pa1,'m1' => $m1,
				'pc2' => $pc2,'pi2' => $pi2,'pp2' => $pp2,'pa2' => $pa2,'m2' => $m2,
				'pc3' => $pc3,'pi3' => $pi3,'pp3' => $pp3,'pa3' => $pa3,'m3' => $m3,
				'pc4' => $pc4,'pi4' => $pi4,'pp4' => $pp4,'pa4' => $pa4,'m4' => $m4,
				'pc5' => $pc5,'pi5' => $pi5,'pp5' => $pp5,'pa5' => $pa5,'m5' => $m5,
			];		  
			
			
		/** 
		*** ClientsByLocation Pie Chart & BookingsByType Pie Chart	***
		**/
			/** ServicesByType Pie Chart **/
			
			//Get Service total count
			$servicesTotal = Service::count();	
			//Get All Service Types 
			$serviceTypes = ServiceType::select('name')->get();		
			//Get Service Types total count
			$serviceTypesTotal = ServiceType::count();
			//Get ServiceTypesData
			$serviceTypesData = [];	
			$serviceColor = [];
			$serviceNames = [];
			$pColor = ['#4B49AC','#FFC100','#248AFD','#FF4747','#57B657','#4B49AC','#FFC100','#248AFD','#FF4747','#57B657'];
			if($serviceTypesTotal != 0 ){
				$i = 0;
				foreach($serviceTypes as $st){					
					$serviceTypesData[$i] = Service::where('type', $st->name)
										->count();
					$serviceColor[$i] = $pColor[$i];
					$serviceNames[$i] = $st->name;
					$i++;
				}
			}	
			
			/** bookingsbyStatus Pie Chart **/
			
			//Get Booking total count
			$bookingsTotal = Booking::count();	
			//Get All Bookings By Status Type
			$bookingsbyStatus = Booking::select('status')->distinct()->get();
			$bookingsbyStatusTotal = Booking::select('status')->distinct()->count();	
			$bookingsColor = [];
			$statusNames = [];
			$bColor = ['#4B49AC','#FFC100','#248AFD','#FF4747','#57B657','#4B49AC','#FFC100','#248AFD','#FF4747','#57B657'];
			if($bookingsTotal != 0 ){
				$i = 0;
				foreach($bookingsbyStatus as $bs){					
					$bookingsperStatus[$i] = Booking::where('status', $bs->status)
										->count();
					$bookingsColor[$i] = $bColor[$i];
					$statusNames[$i] = $bs->status;
					$i++;
				}
			}			
			$dcData = [
				'servicesTotal' => $servicesTotal,
				'serviceTypesData' => $serviceTypesData,
				'serviceTypesTotal' => $serviceTypesTotal,
				'serviceTypes' => $serviceTypes,
				'serviceColor' => $serviceColor,
				'serviceNames' => $serviceNames,
				'bookingsTotal' => $bookingsTotal,
				'bookingsbyStatus' => $bookingsperStatus,
				'bookingsbyStatusTotal' => $bookingsbyStatusTotal,
				'bookingsperStatus' => $bookingsperStatus,
				'bookingsColor' => $bookingsColor,				
				'statusNames' => $statusNames,
				
			];			
	
			return $response = Response::json(['msData' => $msData,'pData' => $pData,'dcData' => $dcData], 200);
			  
		}catch(Exception $e){

			$response = Response::json(['error' => ['message' => 'Dashboard cannot be found.'] ], 404);
			return 	$response;
	   }
	}	   

	
	public function getCart()
	{
	 try{
		 
		 $appDefaults = AppDefaults::latest()->first();							//Get the first appDefaults  available for templates					
			$rtemplate = [
				'appDefaults'=>$appDefaults,
			];
			return View('/cart',compact('rtemplate'));
		}catch(Exception $e){
			$response = Response::json(['error' => ['message' => 'Cart cannot be found.'] ], 404);		
			return 	$response;
	   } 	
	}
	
	public function getList()
	{
	 try{
		 
		 $appDefaults = AppDefaults::latest()->first();							//Get the first appDefaults  available for templates					
			$rtemplate = [
				'appDefaults'=>$appDefaults,
			];
			return View('/list',compact('rtemplate'));
		}catch(Exception $e){
			$response = Response::json(['error' => ['message' => 'List cannot be found.'] ], 404);		
			return 	$response;
	   } 	
	}
	public function checkoutCart()
	{
	 try{
			return View('/checkoutCart');
		}catch(Exception $e){
			$response = Response::json(['error' => ['message' => 'checkoutCart cannot be found.'] ], 404);		
			return 	$response;
	   } 	
	}	
	
	public function checkoutList()
	{
	 try{
			return View('/checkoutList');
		}catch(Exception $e){
			$response = Response::json(['error' => ['message' => 'checkoutList cannot be found.'] ], 404);		
			return 	$response;
	   } 	
	}
	public function contract()
	{
	 try{
			return View('/contract');
		}catch(Exception $e){
			$response = Response::json(['error' => ['message' => 'contract cannot be found.'] ], 404);		
			return 	$response;
	   } 	
	}	
}
