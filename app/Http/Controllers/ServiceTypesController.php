<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Auth;
use Illuminate\Pagination\Paginator;

use App\Models\ServiceType;


class ServiceTypesController extends Controller
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
				$serviceTypes = ServiceType::search($request->search_text)->SimplePaginate(15);
				return View('serviceTypes.pages.index',compact('serviceTypes'));	
				
			}catch(Exception $e){
				return View('serviceTypes.pages.index');
		   } 			
        }else{		
		    try{
				$serviceTypes = ServiceType::latest()->simplePaginate(15);//Get all ServiceTypes
				return View('serviceTypes.pages.index',compact('serviceTypes'));

			}catch(Exception $e){
				return View('serviceTypes.pages.index');
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
		return	View('serviceTypes.pages.create');
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
			$serviceType = new ServiceType();
			$data = $this->validate($request, [
				'name'=>'required|max:15',
				'cost'=>'required|max:12',
			]);
	 
			$serviceType->saveServiceType($data);
			$response = Response::json(['success' => ['message' => 'ServiceType has been created successfully.','data' => $serviceType,] ], 201); 

			return  $response;	
			
		}catch(Exception $e){
			
			$response = Response::json(['error' => ['message' => 'ServiceType cannot be created, validation error!'] ], 422);
			
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
		try{
			$serviceType = ServiceType::findOrFail($id); //Find ServiceType of id = $id
			$status = "200";
			return View('serviceTypes.pages.show',compact('serviceType','status'));

			
		}catch(Exception $e){

			$response = Response::json(['error' => ['message' => 'ServiceType cannot be found.'] ], 404);
			
			return 	$response;
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
			$serviceType = ServiceType::where('id', $id)->first(); //Find the first result where ServiceType id = $id
			$status = "200";
			return View('serviceTypes.pages.edit',compact('serviceType','status'));
			
		}catch(Exception $e){

			$response = Response::json(['error' => ['message' => 'ServiceType cannot be found.'] ], 404);
			
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
			$serviceType = new ServiceType();
			$data = $this->validate($request, [
				'name'=>'required|max:15',
				'cost'=>'required|max:12',
			]);
		    $data['id'] = $id;
			
			$serviceType->updateServiceType($data);
			
			$response = Response::json(['success' => ['message' => 'ServiceType has been updated.','data' => $data,] ], 200); 
				
			return  $response;	
			
		}catch(Exception $e){
			
			$response = Response::json(['error' => ['message' => 'ServiceType cannot be updated, validation error!'] ], 422);
			
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
			$serviceType = ServiceType::findOrFail($id); //Find ServiceType of id = $id
			$serviceType->delete();
			
			$response = Response::json(['success' => ['message' => 'ServiceType  has been deleted.'] ], 200); 
				
			return  $response;	
			
		}catch(Exception $e){
			
			$response = Response::json(['error' => ['message' => 'ServiceType cannot be found.'] ], 404);
			
			return 	$response;		
		}			
    }
	
    /**
     * Search for the specified resource using the given search-text.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */	
    public function search($text)
    {
      try{
			$serviceTypes = ServiceType::latest()->simplePaginate(15);//Get all ServiceTypes

			return View('serviceTypes.pages.search',compact('serviceTypes'));

			return	$response;
			
		}catch(Exception $e){

			$response = Response::json(['error' => ['message' => 'ServiceTypes Results cannot be found.'] ], 404);
			
			return 	$response;
	   }  
    }	
}
