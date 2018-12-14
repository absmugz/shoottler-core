<?php

namespace App\Models\Items;

use App\Contracts\TransferContract;
use App\Models\Items\Services\PrivateTransfer;
use App\Models\Items\Services\SharedTransfer;
use App\Traits\Amenitytable;
use App\Traits\hasInstructions;

class Transfer extends Service implements TransferContract
{
	use amenitytable;
	use hasInstructions;

	protected static $singleTableType = Transfer::class;

	protected static $persisted =
		[
			'from_zone_id',
			'to_zone_id',
			'distance',
			'discountRT'
		];
	/**
	 * This class is used to group to main type of
	 * Transfers
	 * @var array
	 */
	protected static $singleTableSubclasses = [
		PrivateTransfer::class,SharedTransfer::class
	];

	/**
	 * This Item's name
	 * @return array
	 */
	public function itemName() {
		return ['singular' => 'Transfer','plural' => 'Transfers'];
	}
}
