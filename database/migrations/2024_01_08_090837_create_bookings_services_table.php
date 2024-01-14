<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings_services', function (Blueprint $table) {
            $table->bigIncrements('id');        
			$table->unsignedBigInteger('booking_id');
			$table->unsignedBigInteger('service_id');	
            $table->timestamps();			
        });
		Schema::table('bookings_services', function($table) {
			$table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');			
			$table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
		});	
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    Schema::table('profiles', function($table) {	
        $table->dropForeign(['booking_id']);
        $table->dropColumn('booking_id');
		$table->dropForeign(['service_id']);
        $table->dropColumn('service_id');
    });	
        Schema::dropIfExists('bookings_services');
    }
}
