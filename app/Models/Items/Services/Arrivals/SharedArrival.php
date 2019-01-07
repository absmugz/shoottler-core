<?php
/**
 * Created by PhpStorm.
 * User: angelformica
 * Date: 9/27/18
 * Time: 3:14 AM
 */

namespace App\Models\Items\Services;

use App\Contracts\Items\Services\SharedServiceContract;
use App\Contracts\SharedArrivalContract;
use App\Models\Items\Arrival;

class SharedArrival extends Arrival implements SharedArrivalContract,SharedServiceContract {

	protected static $singleTableType = SharedArrival::class;

	protected static $persisted =
		[
			'price_per_passenger'
		];
	/**
	 * This class is used to group to main type of
	 * Shared Arrivals
	 * @var array
	 */
	protected static $singleTableSubclasses = [

	];
	/**
	 * This Item's name
	 * @return array
	 */
	public function itemName() {
		return ['singular'=>'Shared Arrival','plural' => 'Shared Arrivals'];
	}
}