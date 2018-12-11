<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    factory(\App\Models\User\User::class, 5)->create()->each(function ($user){
	    	$i = random_int(0,4);
		    $user->companies()->attach(factory(\App\Models\Company\Company::class,$i)->create());
	    });
    }
}
