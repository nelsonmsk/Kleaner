<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class ServiceType extends Model
{
    use HasFactory;
	use Searchable;
	
	protected $fillable = ['name'];

	public function saveServiceType($data)
	{
		$this->name = $data['name'];	
		$this->save();
			return 1;
	}

	public function updateServiceType($data)
	{
		$sv = $this::find($data['id']);
		$sv->name = $data['name'];	
		$sv->save();
			return 1;
	}
	
    /**
     * Get the index name for the model.
    */
    public function searchableAs()
    {
        return 'serviceType_index';
    }	
}
