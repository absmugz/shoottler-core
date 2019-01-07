<?php
use Faker\Generator as Faker;

$factory->define(\App\Models\Company\Company::class, function (Faker $faker) {
	return [
		'name' => $faker->company,
		'brand' => $faker->company,
		'website' => $faker->url,
		'facebook' => $faker->url,
		'google_plus' => $faker->url,
		'tripadvisor' => $faker->url
	];
});