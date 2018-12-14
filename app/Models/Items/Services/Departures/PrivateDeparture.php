<?php
/**
 * Created by PhpStorm.
 * User: angelformica
 * Date: 9/27/18
 * Time: 3:15 AM
 */

namespace App\Models\Items\Services;


use App\Models\Items\Departure;

class PrivateDeparture extends Departure {

	protected static $singleTableType = PrivateDeparture::class;

	protected static $persisted =
		[
		];
	/**
	 * This class is used to group to main type of
	 * Private Departures
	 * @var array
	 */
	protected static $singleTableSubclasses = [

	];
	/**
	 * This Item's name
	 * @return array
	 */
	public function itemName() {
		return ['singular'=>'Private Departure','plural' => 'Private Departures'];
	}
}