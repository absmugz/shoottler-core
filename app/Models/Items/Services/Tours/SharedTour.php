<?php

namespace App\Models\Items\Services;

use App\Contracts\Items\Services\SharedServiceContract;
use App\Contracts\SharedTourContract;
use App\Models\Items\Tour;

class SharedTour extends Tour implements SharedTourContract,SharedServiceContract
{
	protected static $singleTableType = SharedTour::class;

	protected static $persisted =
		[
			'price_per_passenger'
		];
	/**
	 * This class is used to group to main type of
	 * Shared Tours
	 * @var array
	 */
	protected static $singleTableSubclasses = [

	];
	/**
	 * This Item's name
	 * @return array
	 */
	public function itemName() {
		return ['singular'=>'Shared Tour','plural' => 'Shared Tours'];
	}
}
