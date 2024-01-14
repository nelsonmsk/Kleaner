<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\ServiceCategory;

class ServiceCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {	 
         $faker = Faker::create();
 
        // Create 10 ProjectType records
        foreach(range(1,10) as $index)
		{
            ServiceCategory::create([		
                'name' => $faker->word(10),			
            ]);
        }
	}
}
