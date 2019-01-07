<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAmenitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amenities', function (Blueprint $table) {
            $table->increments('id');
	        $table->string('name')->nullable();
	        $table->text('description')->nullable();
            $table->timestamps();
        });

	    Schema::create('amenitytables',function (Blueprint $table){
		    $table->increments('id');
		    $table->integer('amenity_id')->unsigned()->index();
		    $table->morphs('amenitytable');
		    $table->integer('qty')->unsigned()->nullable();
		    $table->boolean('is_Exclusion')->default(0);

		    $table->foreign('amenity_id')->references('id')->on('amenities')->onDelete('cascade');

	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	Schema::dropIfExists('amenitytables');
        Schema::dropIfExists('amenities');
    }
}
