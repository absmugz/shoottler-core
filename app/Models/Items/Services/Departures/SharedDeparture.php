<?php
/**
 * Created by PhpStorm.
 * User: angelformica
 * Date: 9/27/18
 * Time: 3:17 AM
 */

namespace App\Models\Items\Services;

use App\Contracts\Items\Services\SharedServiceContract;
use App\Contracts\SharedDepartureContract;
use App\Models\Items\Departure;

class SharedDeparture extends Departure implements SharedDepartureContract,SharedServiceContract {

	protected static $singleTableType = SharedDeparture::class;

	protected static $persisted =
		[
			'price_per_passenger'
		];
	/**
	 * This class is used to group to main type of
	 * Shared Departures
	 * @var array
	 */
	protected static $singleTableSubclasses = [

	];
	/**
	 * This Item's name
	 * @return array
	 */
	public function itemName() {
		return ['singular'=>'Shared Departure','plural' => 'Shared Departures'];
	}
}