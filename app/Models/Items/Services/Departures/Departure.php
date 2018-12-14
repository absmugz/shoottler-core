<?php
/**
 * Created by PhpStorm.
 * User: angelformica
 * Date: 9/27/18
 * Time: 3:15 AM
 */

namespace App\Models\Items;

use App\Contracts\DepartureContract;
use App\Models\Items\Services\PrivateDeparture;
use App\Models\Items\Services\SharedDeparture;
use App\Traits\amenitytable;
use App\Traits\hasInstructions;
use App\Traits\isService;

class Departure extends Service implements DepartureContract {

	use isService;
	use hasInstructions;
	use amenitytable;

	protected static $singleTableType = Departure::class;

	protected static $persisted =
		[
			'from_zone_id',
			'distance',
		];
	/**
	 * This class is used to group to main type of
	 * Transfers
	 * @var array
	 */
	protected static $singleTableSubclasses = [
		PrivateDeparture::class,SharedDeparture::class
	];

	/**
	 * This Item's name
	 * @return array
	 */
	public function itemName() {
		return ['singular' => 'Departure','plural' => 'Departures'];
	}

}