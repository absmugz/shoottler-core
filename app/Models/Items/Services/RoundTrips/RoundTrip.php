<?php

namespace App\Models\Items;

use App\Contracts\RoundTripContract;
use App\Models\Items\Services\PrivateRoundTrip;
use App\Models\Items\Services\SharedRoundTrip;
use App\Traits\amenitytable;
use App\Traits\hasInstructions;
use App\Traits\isService;

class RoundTrip extends Service implements RoundTripContract
{
	use isService;
	use amenitytable;
	use hasInstructions;

	protected static $singleTableType = RoundTrip::class;

	protected static $persisted =
		[
			'from_zone_id',
			'to_zone_id',
			'distance',
		];
	/**
	 * This class is used to group to main type of
	 * Round Trips
	 * @var array
	 */
	protected static $singleTableSubclasses = [
		PrivateRoundTrip::class,SharedRoundTrip::class
	];

	/**
	 * This Item's name
	 * @return array
	 */
	public function itemName() {
		return ['singular' => 'Round Trip','plural' => 'Round Trips'];
	}
}
