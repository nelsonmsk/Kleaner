<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;

use Illuminate\Http\Request;
use Response;
use Auth;
use Illuminate\Pagination\Paginator;

class BookingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index(Request $request)
    {
		if($request->has('search_text')){			
			try{	
				//search the bookings using the search_text
				$bookings = Booking::Search($request->search_text)->simplePaginate(15); 	
				$status = "200";
				return view('bookings.pages.index',compact('bookings','status'));
				
			}catch(Exception $e){
				return view('bookings.pages.index');
			}
		}else{
			if(Auth::user()->isAdmin()){
				try{
					//Get all bookings
					$bookings = Booking::latest()->simplePaginate(15); //Get all bookings
					$status = "200";				
					return view('bookings.pages.index',compact('bookings','status'));					
				}catch(Exception $e){
					return view('bookings.pages.index');
				}
			}else{
				try{
					$user = Auth::user();
					$bookings = $user->bookings()->latest()->simplePaginate(15) ; //Get all bookings by user
					$status = "200";				
					return view('bookings.pages.index',compact('bookings','status'));					
				}catch(Exception $e){
					return view('bookings.pages.index');
				}
			}			
		}			
   }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
			return View('bookings.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		try{
			//Get the user who made the booking
			$user = Auth::user();
			$data = $this->validate($request, [
				'location'=>'required|max:60',
				'fromDate'=>'required|date|before:toDate',			
				'fromTime'=>'required',
				'toDate'=>'required|date|after:fromDate',			
				'toTime'=>'required',
				'cost'=>'required|max:12',		
				'details'=>'required|max:150',
				'status'=>'required|max:30',	
			]);
			$Booking = new booking($data);
		    //save the booking
			$user->bookings()->save($Booking);
			//get assigned id of this booking
			$booking = $user->bookings()->latest();
			if($request->serviceIds){
				$ids = $request->serviceIds;
				//attach to the pivot table
				$booking->services()->attach($ids);
			}
			$response = Response::json(['success' => ['message' => 'Booking has been created successfully.','data' => $booking,] ], 201); 
			return  $response;	
		}catch(Exception $e){
			$response = Response::json(['error' => ['message' => 'Booking cannot be created, validation error!'] ], 422);
			return 	$response;		
		}	
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		if(Auth::user()->isAdmin()){		
			try{
				$booking = Booking::findOrFail($id); //Find Booking of id = $id
				$status = "200";
				return View('bookings.pages.show',compact('booking','status'));
			}catch(Exception $e){
				$response = Response::json(['error' => ['message' => 'Booking cannot be found.'] ], 404);
				return 	$response;
		   }
		}else{
			try{
				$user = Auth::user();
				$booking = $user->bookings()->find($id); //Find Booking of id = $id
				$status = "200";
				return View('bookings.pages.show',compact('booking','status'));
			}catch(Exception $e){
				$response = Response::json(['error' => ['message' => 'Booking cannot be found.'] ], 404);
				return 	$response;
		   }
		}
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		try{		
			$booking = Booking::where('id', $id)->first(); //Find the first result where Booking id = $id
			$status = "200";
			return View('bookings.pages.edit',compact('booking','status'));
		}catch(Exception $e){
			$response = Response::json(['error' => ['message' => 'Booking cannot be found.'] ], 404);
			return 	$response;
	   }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		try{
			$data = $this->validate($request, [
				'location'=>'required|max:60',
				'fromDate'=>'required|date|before:toDate',			
				'fromTime'=>'required',
				'toDate'=>'required|date|after:fromDate',			
				'toTime'=>'required',
				'cost'=>'required|max:12',		
				'details'=>'required|max:150',
				'status'=>'required|max:30', 
				'user_id'=>'required',
			]);
		    $data['id'] = $id;		
			//Get the user who made the booking
			$user = User::find($id);			
			//save the booking
			$user->bookings()->fill($data)->save;
			//get assigned id of this booking
			$booking = $user->bookings()->latest();
			if($request->serviceIds){
				//attach to the pivot table
				$ids = $request->serviceIds;			
				$booking->services()->updatedExistingPivot($ids);
			}
			$status = "200";
			$response = Response::json(['success' => ['message' => 'Booking has been updated.','data' => $booking,] ], 'status'); 
			return  $response;	
		}catch(Exception $e){
			$response = Response::json(['error' => ['message' => 'Booking cannot be updated, validation error!'] ], 422);
			return 	$response;		
		}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {		
		try{
			$booking = Booking::findOrFail($id); //Find Booking of id = $id
			//detach all the services from the booking
			$booking->services()->detach();
			$booking->delete();	
			$status = "200";
			$response = Response::json(['success' => ['message' => 'Booking has been deleted.'] ], 'status'); 
			return  $response;		
		}catch(Exception $e){
			$response = Response::json(['error' => ['message' => 'Booking cannot be found.'] ], 404);
			return 	$response;		
		}
    }
}
