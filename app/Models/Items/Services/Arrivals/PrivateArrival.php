<?php
/**
 * Created by PhpStorm.
 * User: angelformica
 * Date: 9/27/18
 * Time: 3:13 AM
 */

namespace App\Models\Items\Services;

use App\Contracts\PrivateArrivalContract;
use App\Models\Items\Arrival;

class PrivateArrival extends Arrival implements PrivateArrivalContract {

	protected static $singleTableType = PrivateArrival::class;

	protected static $persisted =
		[
		];
	/**
	 * This class is used to group to main type of
	 * Private Arrivals
	 * @var array
	 */
	protected static $singleTableSubclasses = [

	];
	/**
	 * This Item's name
	 * @return array
	 */
	public function itemName() {
		return ['singular'=>'Private Arrival','plural' => 'Private Arrivals'];
	}
}