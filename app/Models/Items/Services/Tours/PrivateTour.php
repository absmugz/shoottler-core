<?php

namespace App\Models\Items\Services;

use App\Models\Items\Tour;

class PrivateTour extends Tour
{
	protected static $singleTableType = PrivateTour::class;

	protected static $persisted =
		[
		];
	/**
	 * This class is used to group to main types of
	 * Private Tours
	 * @var array
	 */
	protected static $singleTableSubclasses = [

	];
	/**
	 * This Item's name
	 * @return array
	 */
	public function itemName() {
		return ['singular'=>'Private Tour','plural' => 'Private Tours'];
	}
}
