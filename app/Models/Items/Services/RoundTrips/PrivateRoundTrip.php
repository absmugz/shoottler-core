<?php

namespace App\Models\Items\Services;

use App\Contracts\PrivateRoundTripContract;
use App\Models\Items\RoundTrip;

class PrivateRoundTrip extends RoundTrip implements PrivateRoundTripContract
{
	protected static $singleTableType = PrivateRoundTrip::class;

	protected static $persisted =
		[
		];
	/**
	 * This class is used to group to main type of
	 * Private Round Trips
	 * @var array
	 */
	protected static $singleTableSubclasses = [

	];
	/**
	 * This Item's name
	 * @return array
	 *
	 */
	public function itemName() {
		return ['singular'=>'Private Round Trip','plural' => 'Private Round Trips'];
	}
}
