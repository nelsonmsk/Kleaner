<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Service;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $faker = Faker::create();
 
        // Create 10 Service records
        foreach(range(1,10) as $index)
		{
            Service::create([
                'type' => $faker->word(30),			
                'category' => $faker->word(30),			
                'name' => $faker->word(30),
                'description' => $faker->text(150),
                'details' => $faker->text(250),				
                'cost' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 10000),
                'username' => $faker->userName,				
            ]);
        }
    }
}
