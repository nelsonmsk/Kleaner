<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Response;
use Illuminate\Pagination\Paginator;


use App\Models\GalleryImage;
use App\Models\Booking;
use App\Models\Profile;
use App\Models\Feature;
use App\Models\Banner;
use App\Models\Service;
use App\Models\serviceCategory;
use App\Models\serviceType;
use App\Models\AppDefaults;

class TemplateController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
      try{
		 
		 $appDefaults = AppDefaults::latest()->first();					//Get the appDefaults
		 $profiles = Profile::whereBetween('id', [1, 4])->get();		//Get 4 Profiles available with pageId 1-4
		 $services = Service::all();
		 $features = Feature::whereBetween('pageId',[1,3])->get();		 
		 $banners = Banner::whereBetween('pageId',[1,4])->get();
		 $serviceTypes = ServiceType::whereBetween('id',[1,5])->get();	
		 $serviceCategories = ServiceCategory::whereBetween('id',[1,5])->get();
		 
		 $brandImage = GalleryImage::where('ref_class', 'AppDefaults')
										->latest()
										->get();
		 $aboutImage = GalleryImage::where('ref_class', 'About')
										->latest()
										->get();										
		 $servicesImages = GalleryImage::where('ref_class', 'Services')
										->latest()
										->simplePaginate(2);										
		 $bannersImages = GalleryImage::where('ref_class', 'Banners')
										->latest()
										->simplePaginate(12);	
		$featuresImages = GalleryImage::where('ref_class', 'Features')
										->latest()
										->simplePaginate(12);
		 $carouselImages = GalleryImage::where('ref_class', 'Carousel')
										->latest()
										->simplePaginate(12);
		 $clientsLogos = GalleryImage::where('ref_class', 'Clients')
										->latest()
										->simplePaginate(5);										
			$rtemplate = [
				'appDefaults'=>$appDefaults,
				'profiles' => $profiles,
				'services' => $services,
				'features' =>$features,				
				'banners'=>$banners,
				'serviceTypes'=>$serviceTypes,
				'serviceCategories'=>$serviceCategories,
				'brandImage'=>$brandImage,
				'aboutImage'=>$aboutImage,				
				'servicesImages'=>$servicesImages,				
				'featuresImages'=>$featuresImages,
				'bannersImages'=>$bannersImages,
				'carouselImages'=>$carouselImages,
				'clientsLogos'=>$clientsLogos,				
			];
			$status = "200";
			return View('/Welcome',compact('rtemplate','status'));
		}catch(Exception $e){
			$response = Response::json(['error' => ['message' => 'Templates cannot be found.'] ], 404);		
			return 	$response;
	   } 
 
   }
   
   
   
	public function getTemplate()
	{
	 try{
		 
		 $appDefaults = AppDefaults::latest()->first();							//Get the first appDefaults  available for templates				
				
			$rtemplate = [
				'appDefaults'=>$appDefaults,
			];
			
		return $response = Response::json(['rtemplate' => $rtemplate ], 200);
		
		}catch(Exception $e){

			$response = Response::json(['error' => ['message' => 'Templates cannot be found.'] ], 404);
				
			return 	$response;
		} 	
	}
	
}
