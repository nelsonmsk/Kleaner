<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Booking extends Model
{
    use HasFactory;
	use Searchable;
	
	protected $fillable = ['location','fromDate','fromTime','toDate','toTime','cost','details','status','user_id'];

	public function saveBooking($data)
	{
		$this->location = $data['location'];
		$this->fromDate = $data['fromDate'];
		$this->fromTime = $data['fromTime'];
		$this->toDate = $data['toDate'];
		$this->toTime = $data['toTime'];		
		$this->cost = $data['cost'];
		$this->details = $data['details'];
		$this->status = $data['status'];			
		$this->user_id = auth()->user()->id;	
		$this->save();
			return 1;
	}

	public function updateBooking($data)
	{
		$bk = $this::find($data['id']);
		$bk->location = $data['location'];
		$bk->fromDate = $data['fromDate'];
		$bk->fromTime = $data['fromTime'];	
		$bk->toDate = $data['toDate'];
		$bk->toTime = $data['toTime'];		
		$bk->cost = $data['cost'];
		$bk->details = $data['details'];
		$bk->status = $data['status'];		
		$bk->user_id = $data['user_id'];	
		$bk->save();
			return 1;
	}

    /**
     * Get the user that owns the booking.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
	
	/**
     * Get the services that belong to the booking.
     */
    public function services()
    {
       return $this->belongsToMany(Service::class,'bookings_services','booking_id','service_id');
    }

    /**
     * Get the index name for the model.
    */
    public function searchableAs()
    {
        return 'booking_index';
    }	

}