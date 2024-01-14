<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;



class DatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *

     * @return void
     */


    public function run()
    {


	$this->call([
		UsersTableSeeder::class,
		AppDefaultsTableSeeder::class,
		BannersTableSeeder::class,	
		ClientsReportsTableSeeder::class,
		ClientsTableSeeder::class,	
		FeaturesTableSeeder::class,	
		GalleryImagesTableSeeder::class,		
		MailPostsTableSeeder::class,
		MailSubscriptionsTableSeeder::class,		
		MessagesReportsTableSeeder::class,
		MessagesTableSeeder::class,
		NewslettersTableSeeder::class,
		//ProfilesTableSeeder::class,
		ServicesTableSeeder::class,
		ServiceCategoriesTableSeeder::class,
		ServiceTypesTableSeeder::class,		
		SubsReportsTableSeeder::class,
		UsersReportsTableSeeder::class,
	
	]);
    }

}
