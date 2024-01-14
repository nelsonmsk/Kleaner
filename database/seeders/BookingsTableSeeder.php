<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Booking;

class BookingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
 
        // Create 10 Booking records
        foreach(range(1,10) as $index)
		{
            Booking::create([ 
				'location'=> $faker->address(),
                'fromDate' => $faker->date(),
                'fromTime' => $faker->time(),
                'toDate' => $faker->date(),
                'toTime' => $faker->time(),
                'cost' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 10000),
                'details' => $faker->text(150),				
                'status' => $faker->word(10),				
                'user_id' => $faker->numberBetween($min = 1, $max = 10),				
            ]);
        }
    
    }
}