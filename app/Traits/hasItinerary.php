<?php
/**
 * Created by PhpStorm.
 * User: angelformica
 * Date: 9/26/18
 * Time: 4:55 PM
 */

namespace App\Traits;

use App\Itinerary;

trait hasItinerary {

	public function itineraries(){
		return $this->hasMany(Itinerary::class);
	}
}