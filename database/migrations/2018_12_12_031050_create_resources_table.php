<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resources', function (Blueprint $table) {
            $table->increments('id');
	        $table->integer('company_id')->unsigned()->index();
	        $table->integer('area_id')->unsigned()->nullable()->index();
	        $table->string('type');
	        $table->string('name')->unique();
	        $table->string('description')->nullable();
	        $table->integer('capacity');
	        //Vehicle
	        $table->string('make')->nullable();
	        $table->string('model')->nullable();
	        $table->string('year')->nullable();

	        $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resources');
    }
}
