<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->bigIncrements('id'); 
			$table->string('location');
			$table->date('fromDate');
		    $table->time('fromTime');
		    $table->date('toDate');
		    $table->time('toTime');
		    $table->float('cost');
		    $table->text('details');			
		    $table->string('status');	
			$table->unsignedBigInteger('user_id');
            $table->timestamps();
        });
			Schema::table('bookings', function($table) {
			$table->foreign('user_id')->references('id')->on('users');
		});	
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table('bookings', function($table) {
			$table->dropForeign(['user_id']);
			$table->dropColumn('user_id');
		});	
        Schema::dropIfExists('bookings');
    }
}
