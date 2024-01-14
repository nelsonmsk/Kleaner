<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\ServiceType;

class ServiceTypesTableSeeder extends Seeder
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
            ServiceType::create([		
                'name' => $faker->word(10),	
				'cost' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 10000),	
            ]);
        }
    }
}
