<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Service extends Model
{
    use HasFactory;
	use Searchable;
	
	protected $fillable = ['type','category','name','description','details','cost','username'];

	public function saveService($data)
	{
		$this->type = $data['type'];
		$this->category = $data['category'];
		$this->name = $data['name'];
		$this->description = $data['description'];
		$this->details = $data['details'];		
		$this->cost = $data['cost'];	
		$this->username = auth()->user()->name;	
		$this->save();
			return 1;
	}

	public function updateService($data)
	{
		$sv = $this::find($data['id']);
		$sv->type = $data['type'];
		$sv->category = $data['category'];
		$sv->name = $data['name'];
		$sv->description = $data['description'];
		$sv->details = $data['details'];		
		$sv->cost = $data['cost'];	
		$sv->username = auth()->user()->name;	
		$sv->save();
			return 1;
	}

	/**
     * Get the bookings that the Service belongs to.
     */
    public function bookings()
    {
		//return $this->belongsToMany(Booking::class)->withTimestamps();
        return $this->belongsToMany(Booking::class,'bookings_services','service_id','booking_id');
    }
	
    /**
     * Get the index name for the model.
    */
    public function searchableAs()
    {
        return 'service_index';
    }	
}
