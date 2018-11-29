<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('companies', function (Blueprint $table) {
		    $table->increments('id');

		    $table->string('name');
		    $table->string('brand')->nullable();

		    $table->string('website');
		    $table->string('facebook')->nullable();
		    $table->string('google_plus')->nullable();
		    $table->string('tripadvisor')->nullable();

		    $table->timestamps();
	    });

	    Schema::create('company_user',function (Blueprint $table){
		    $table->increments('id');

		    $table->integer('company_id')->unsigned()->index();
		    $table->integer('user_id')->unsigned()->index();

		    $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
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
    	Schema::dropIfExists('company_user');
        Schema::dropIfExists('companies');
    }
}
