<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Auth;
use Illuminate\Pagination\Paginator;

use App\Models\ServiceCategory;


class ServiceCategoriesController extends Controller
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
				$serviceCategories = ServiceCategory::search($request->search_text)->SimplePaginate(15);
				return View('serviceCategories.pages.index',compact('serviceCategories'));	
				
			}catch(Exception $e){
				return View('serviceCategories.pages.index');
		   } 			
        }else{		
		    try{
				$serviceCategories = ServiceCategory::latest()->simplePaginate(15);//Get all ServiceCategories
				return View('serviceCategories.pages.index',compact('serviceCategories'));

			}catch(Exception $e){
				return View('serviceCategories.pages.index');
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
		return	View('serviceCategories.pages.create');
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
			$serviceCategory = new ServiceCategory();
			$data = $this->validate($request, [
				'name'=>'required|max:15',
			]);
	 
			$serviceCategory->saveServiceCategory($data);
			$response = Response::json(['success' => ['message' => 'ServiceCategory has been created successfully.','data' => $serviceCategory,] ], 201); 

			return  $response;	
			
		}catch(Exception $e){
			
			$response = Response::json(['error' => ['message' => 'ServiceCategory cannot be created, validation error!'] ], 422);
			
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
			$serviceCategory = ServiceCategory::findOrFail($id); //Find ServiceCategory of id = $id
			$status = "200";
			return View('serviceCategories.pages.show',compact('serviceCategory','status'));

			
		}catch(Exception $e){

			$response = Response::json(['error' => ['message' => 'ServiceCategory cannot be found.'] ], 404);
			
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
			$serviceCategory = ServiceCategory::where('id', $id)->first(); //Find the first result where ServiceCategory id = $id
			$status = "200";
			return View('serviceCategories.pages.edit',compact('serviceCategory','status'));
			
		}catch(Exception $e){

			$response = Response::json(['error' => ['message' => 'ServiceCategory cannot be found.'] ], 404);
			
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
			$serviceCategory = new ServiceCategory();
			$data = $this->validate($request, [
				'name'=>'required|max:15',
			]);
		    $data['id'] = $id;
			
			$serviceCategory->updateServiceCategory($data);
			
			$response = Response::json(['success' => ['message' => 'ServiceCategory has been updated.','data' => $data,] ], 200); 
				
			return  $response;	
			
		}catch(Exception $e){
			
			$response = Response::json(['error' => ['message' => 'ServiceCategory cannot be updated, validation error!'] ], 422);
			
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
			$serviceCategory = ServiceCategory::findOrFail($id); //Find ServiceCategory of id = $id
			$serviceCategory->delete();
			
			$response = Response::json(['success' => ['message' => 'ServiceCategory  has been deleted.'] ], 200); 
				
			return  $response;	
			
		}catch(Exception $e){
			
			$response = Response::json(['error' => ['message' => 'ServiceCategory cannot be found.'] ], 404);
			
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
			$serviceCategories = ServiceCategory::latest()->simplePaginate(15);//Get all ServiceCategories

			return View('serviceCategories.pages.search',compact('serviceCategories'));

			return	$response;
			
		}catch(Exception $e){

			$response = Response::json(['error' => ['message' => 'ServiceCategories Results cannot be found.'] ], 404);
			
			return 	$response;
	   }  
    }	
}
