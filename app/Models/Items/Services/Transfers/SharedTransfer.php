<?php

namespace App\Models\Items\Services;

use App\Contracts\Items\Services\SharedServiceContract;
use App\Contracts\SharedTransferContract;
use App\Models\Items\Transfer;

class SharedTransfer extends Transfer implements SharedTransferContract,SharedServiceContract
{

	protected static $singleTableType = SharedTransfer::class;

	protected static $persisted =
		[
			'price_per_passenger'
		];
	/**
	 * This class is used to group to main type of
	 * Shared Transfers
	 * @var array
	 */
	protected static $singleTableSubclasses = [

	];
	/**
	 * This Item's name
	 * @return array
	 */
	public function itemName() {
		return ['singular'=>'Shared Transfer','plural' => 'Shared Transfers'];
	}
}
