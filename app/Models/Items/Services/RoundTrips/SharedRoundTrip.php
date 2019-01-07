<?php

namespace App\Models\Items\Services;

use App\Contracts\Items\Services\SharedServiceContract;
use App\Contracts\SharedRoundTripContract;
use App\Models\Items\RoundTrip;

class SharedRoundTrip extends RoundTrip implements SharedRoundTripContract,SharedServiceContract
{
	protected static $singleTableType = SharedRoundTrip::class;

	protected static $persisted =
		[
			'price_per_passenger'
		];
	/**
	 * This class is used to group to main type of
	 * Shared Round Trips
	 * @var array
	 */
	protected static $singleTableSubclasses = [

	];
	/**
	 * This Item's name
	 * @return array
	 */
	public function itemName() {
		return ['singular'=>'Shared Round Trip','plural'=>'Shared Round Trips'];
	}
}
