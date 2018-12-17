<?php
/**
 * Created by PhpStorm.
 * User: angelformica
 * Date: 9/27/18
 * Time: 3:12 AM
 */

namespace App\Models\Items;

use App\Contracts\ArrivalContract;
use App\Models\Items\Services\PrivateArrival;
use App\Models\Items\Services\SharedArrival;
use App\Traits\amenitytable;
use App\Traits\hasInstructions;
use App\Traits\isService;

class Arrival extends Service implements ArrivalContract {

	use isService;
	use hasInstructions;
	use amenitytable;

	protected static $singleTableType = Arrival::class;

	public static $rules = [
		'to_zone_id' => 'required|exists:zones,id'
	];

	protected static $persisted =
		[
			'to_zone_id',
		];
	/**
	 * This class is used to group to main type of
	 * Transfers
	 * @var array
	 */
	protected static $singleTableSubclasses = [
		PrivateArrival::class,SharedArrival::class
	];

	/**
	 * This Item's name
	 * @return array
	 */
	public function itemName() {
		return ['singular' => 'Arrival','plural' => 'Arrivals'];
	}
}