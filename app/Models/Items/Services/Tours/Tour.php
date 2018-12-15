<?php

namespace App\Models\Items;

use App\Contracts\TourContract;
use App\Models\Items\Services\PrivateTour;
use App\Models\Items\Services\SharedTour;
use App\Traits\amenitytable;
use App\Traits\hasInstructions;
use App\Traits\hasItinerary;

class Tour extends Service implements TourContract
{

	use hasItinerary;
	use amenitytable;
	use hasInstructions;

	protected static $singleTableType = Tour::class;

	public static $rules = [
		'from_zone_id' => 'required|exists:zones,id',
		'to_zone_id' => 'required|exists:zones,id'
	];

	protected static $persisted =
		[
			'from_zone_id',
			'to_zone_id'
		];
	/**
	 * This class is used to group to main type of
	 * Tours
	 * @var array
	 */
	protected static $singleTableSubclasses = [
		PrivateTour::class,SharedTour::class
	];
	/**
	 * This Item's name
	 * @return array
	 */
	public function itemName() {
		return ['singular' => 'Tour','plural' => 'Tours'];
	}
}
